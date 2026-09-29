<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

new class extends Component
{
    // === Tab State ===
    public string $activeTab = 'change_password';

    // === Change Password (for currently logged-in user) ===
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    // === Create New Admin Account ===
    public string $new_name = '';
    public string $new_email = '';
    public string $new_acc_password = '';
    public string $new_acc_password_confirmation = '';

    // === Edit User Password (modal) ===
    public ?int $editing_user_id = null;
    public string $editing_user_name = '';
    public string $edit_password = '';
    public string $edit_password_confirmation = '';
    public bool $showEditModal = false;

    // === Delete confirmation ===
    public ?int $deleting_user_id = null;
    public bool $showDeleteModal = false;
    public string $deleting_user_name = '';

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetValidation();
    }

    // =========================================================
    // CHANGE OWN PASSWORD
    // =========================================================
    public function changePassword(): void
    {
        $this->validate([
            'current_password'          => 'required|string',
            'new_password'              => ['required', 'confirmed', Password::min(8)],
            'new_password_confirmation' => 'required|string',
        ]);

        $user = Auth::user();

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }

        $user->update(['password' => Hash::make($this->new_password)]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->dispatch('toast', message: 'Password berhasil diperbarui!', type: 'success');
    }

    // =========================================================
    // CREATE NEW ADMIN ACCOUNT
    // =========================================================
    public function createAccount(): void
    {
        $this->validate([
            'new_name'                         => 'required|string|max:255',
            'new_email'                        => 'required|email|unique:users,email|max:255',
            'new_acc_password'                 => ['required', 'confirmed', Password::min(8)],
            'new_acc_password_confirmation'    => 'required|string',
        ]);

        User::create([
            'name'     => $this->new_name,
            'email'    => $this->new_email,
            'password' => Hash::make($this->new_acc_password),
            'is_admin' => true,
        ]);

        $this->reset(['new_name', 'new_email', 'new_acc_password', 'new_acc_password_confirmation']);

        $this->dispatch('toast', message: 'Akun admin baru berhasil dibuat!', type: 'success');
    }

    // =========================================================
    // EDIT OTHER USER PASSWORD (modal)
    // =========================================================
    public function openEditModal(int $userId): void
    {
        $user = User::findOrFail($userId);
        $this->editing_user_id   = $user->id;
        $this->editing_user_name = $user->name;
        $this->edit_password     = '';
        $this->edit_password_confirmation = '';
        $this->showEditModal     = true;
        $this->resetValidation();
    }

    public function closeEditModal(): void
    {
        $this->showEditModal    = false;
        $this->editing_user_id  = null;
        $this->reset(['edit_password', 'edit_password_confirmation']);
    }

    public function saveEditPassword(): void
    {
        $this->validate([
            'edit_password'              => ['required', 'confirmed', Password::min(8)],
            'edit_password_confirmation' => 'required|string',
        ]);

        $user = User::findOrFail($this->editing_user_id);
        $user->update(['password' => Hash::make($this->edit_password)]);

        $this->closeEditModal();
        $this->dispatch('toast', message: "Password untuk {$user->name} berhasil diperbarui!", type: 'success');
    }

    // =========================================================
    // DELETE USER
    // =========================================================
    public function confirmDelete(int $userId): void
    {
        // Prevent deleting yourself
        if ($userId === Auth::id()) {
            $this->dispatch('toast', message: 'Anda tidak dapat menghapus akun Anda sendiri.', type: 'error');
            return;
        }
        $user = User::findOrFail($userId);
        $this->deleting_user_id   = $user->id;
        $this->deleting_user_name = $user->name;
        $this->showDeleteModal    = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal  = false;
        $this->deleting_user_id = null;
    }

    public function deleteUser(): void
    {
        if ($this->deleting_user_id === Auth::id()) {
            $this->dispatch('toast', message: 'Anda tidak dapat menghapus akun Anda sendiri.', type: 'error');
            $this->cancelDelete();
            return;
        }
        User::findOrFail($this->deleting_user_id)->delete();
        $name = $this->deleting_user_name;
        $this->cancelDelete();
        $this->dispatch('toast', message: "Akun {$name} telah dihapus.", type: 'success');
    }

    public function render()
    {
        return view('components.admin.⚡user-management.user-management', [
            'users' => User::orderBy('created_at', 'asc')->get(),
        ]);
    }
};

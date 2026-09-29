<div class="space-y-8 max-w-5xl">

    {{-- ===================== PAGE HEADER ===================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-heading font-bold text-foreground">User Management</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Kelola akun admin, ubah password, dan tambah pengguna baru.</p>
        </div>
    </div>

    {{-- ===================== TAB NAVIGATION ===================== --}}
    <div class="flex flex-wrap gap-2 border-b border-border/60 pb-0">
        <button
            wire:click="switchTab('change_password')"
            class="flex items-center gap-2 px-5 py-2.5 rounded-t-xl font-body text-sm font-semibold transition-all border-b-2 -mb-px
                   {{ $activeTab === 'change_password' ? 'border-primary text-primary bg-primary/5' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Ubah Password Saya
        </button>
        <button
            wire:click="switchTab('all_users')"
            class="flex items-center gap-2 px-5 py-2.5 rounded-t-xl font-body text-sm font-semibold transition-all border-b-2 -mb-px
                   {{ $activeTab === 'all_users' ? 'border-primary text-primary bg-primary/5' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Semua User Admin
        </button>
        <button
            wire:click="switchTab('create_account')"
            class="flex items-center gap-2 px-5 py-2.5 rounded-t-xl font-body text-sm font-semibold transition-all border-b-2 -mb-px
                   {{ $activeTab === 'create_account' ? 'border-primary text-primary bg-primary/5' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-border' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
            Buat Akun Baru
        </button>
    </div>

    {{-- ===================== TAB: CHANGE OWN PASSWORD ===================== --}}
    @if ($activeTab === 'change_password')
    <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <div>
                <h2 class="text-xl font-heading font-bold text-foreground">Ubah Password Akun Anda</h2>
                <p class="text-xs text-muted-foreground font-body mt-0.5">
                    Login sebagai: <span class="font-semibold text-foreground">{{ Auth::user()->name }}</span>
                    <span class="text-muted-foreground/60 mx-1">·</span>
                    <span class="font-mono text-[11px]">{{ Auth::user()->email }}</span>
                </p>
            </div>
        </div>

        <form wire:submit.prevent="changePassword" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            <div class="space-y-2 md:col-span-2">
                <label for="current_password" class="text-sm font-semibold font-body text-foreground">Password Saat Ini *</label>
                <input
                    type="password"
                    id="current_password"
                    wire:model="current_password"
                    autocomplete="current-password"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('current_password') border-rose-400 @enderror"
                    placeholder="••••••••"
                >
                @error('current_password') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="new_password" class="text-sm font-semibold font-body text-foreground">Password Baru *</label>
                <input
                    type="password"
                    id="new_password"
                    wire:model="new_password"
                    autocomplete="new-password"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('new_password') border-rose-400 @enderror"
                    placeholder="Min. 8 karakter"
                >
                @error('new_password') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="new_password_confirmation" class="text-sm font-semibold font-body text-foreground">Konfirmasi Password Baru *</label>
                <input
                    type="password"
                    id="new_password_confirmation"
                    wire:model="new_password_confirmation"
                    autocomplete="new-password"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                    placeholder="Ulangi password baru"
                >
            </div>

            <div class="md:col-span-2 flex justify-end pt-2 border-t border-border/50">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 rounded-2xl font-body text-sm font-semibold shadow-md shadow-primary/20"
                >
                    <svg wire:loading.remove wire:target="changePassword" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span wire:loading wire:target="changePassword" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- ===================== TAB: ALL USERS ===================== --}}
    @if ($activeTab === 'all_users')
    <div class="bg-card border border-border/60 shadow-sm rounded-3xl overflow-hidden">
        <div class="px-6 sm:px-8 py-6 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center text-accent shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">Daftar User Admin</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">{{ $users->count() }} akun admin terdaftar dalam sistem.</p>
                </div>
            </div>
            <button
                wire:click="switchTab('create_account')"
                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-primary-foreground font-body text-sm font-semibold hover:bg-primary/90 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                Tambah User
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm font-body">
                <thead class="bg-muted/40 border-b border-border/60">
                    <tr>
                        <th class="text-left px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">Nama</th>
                        <th class="text-left px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">Email</th>
                        <th class="text-left px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">Role</th>
                        <th class="text-left px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">Dibuat</th>
                        <th class="text-right px-6 py-3.5 text-xs font-bold uppercase tracking-wider text-muted-foreground">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/40">
                    @foreach($users as $user)
                    <tr class="hover:bg-muted/20 transition-colors {{ $user->id === Auth::id() ? 'bg-primary/[0.03]' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center font-heading font-bold text-primary text-sm shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-foreground">{{ $user->name }}</p>
                                    @if ($user->id === Auth::id())
                                        <span class="text-[10px] font-bold text-primary bg-primary/10 px-1.5 py-0.5 rounded-full uppercase tracking-wider">Anda</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-muted-foreground font-mono text-xs">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_admin)
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider bg-accent/10 text-accent px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                                    Administrator
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider bg-muted text-muted-foreground px-2.5 py-1 rounded-full">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-muted-foreground text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button
                                    wire:click="openEditModal({{ $user->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-muted/60 hover:bg-primary/10 text-muted-foreground hover:text-primary text-xs font-semibold transition-all"
                                    title="Ganti Password"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    Reset PW
                                </button>
                                @if($user->id !== Auth::id())
                                <button
                                    wire:click="confirmDelete({{ $user->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-muted/60 hover:bg-rose-50 text-muted-foreground hover:text-rose-600 text-xs font-semibold transition-all"
                                    title="Hapus User"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    Hapus
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    {{-- ===================== TAB: CREATE ACCOUNT ===================== --}}
    @if ($activeTab === 'create_account')
    <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 shrink-0 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
            </div>
            <div>
                <h2 class="text-xl font-heading font-bold text-foreground">Buat Akun Admin Baru</h2>
                <p class="text-xs text-muted-foreground font-body mt-0.5">Akun yang dibuat akan mendapatkan akses penuh ke Admin Console.</p>
            </div>
        </div>

        <form wire:submit.prevent="createAccount" class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            <div class="space-y-2">
                <label for="new_name" class="text-sm font-semibold font-body text-foreground">Nama Lengkap *</label>
                <input
                    type="text"
                    id="new_name"
                    wire:model="new_name"
                    autocomplete="off"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('new_name') border-rose-400 @enderror"
                    placeholder="Nama lengkap admin baru"
                >
                @error('new_name') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="new_email" class="text-sm font-semibold font-body text-foreground">Email *</label>
                <input
                    type="email"
                    id="new_email"
                    wire:model="new_email"
                    autocomplete="off"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('new_email') border-rose-400 @enderror"
                    placeholder="admin@example.com"
                >
                @error('new_email') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="new_acc_password" class="text-sm font-semibold font-body text-foreground">Password *</label>
                <input
                    type="password"
                    id="new_acc_password"
                    wire:model="new_acc_password"
                    autocomplete="new-password"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('new_acc_password') border-rose-400 @enderror"
                    placeholder="Min. 8 karakter"
                >
                @error('new_acc_password') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="new_acc_password_confirmation" class="text-sm font-semibold font-body text-foreground">Konfirmasi Password *</label>
                <input
                    type="password"
                    id="new_acc_password_confirmation"
                    wire:model="new_acc_password_confirmation"
                    autocomplete="new-password"
                    class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                    placeholder="Ulangi password"
                >
            </div>

            {{-- Info box --}}
            <div class="md:col-span-2 flex items-start gap-3 p-4 rounded-2xl bg-amber-50 dark:bg-amber-500/10 border border-amber-200/60 dark:border-amber-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500 shrink-0 mt-0.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                <p class="text-xs text-amber-700 dark:text-amber-400 font-body leading-relaxed">
                    <strong>Perhatian:</strong> Akun admin baru memiliki akses penuh ke semua fitur Admin Console termasuk pengaturan, data booking, dan manajemen konten. Pastikan hanya memberikan akses kepada orang yang berwenang.
                </p>
            </div>

            <div class="md:col-span-2 flex justify-end pt-2 border-t border-border/50">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-emerald-600 text-white hover:bg-emerald-700 h-12 px-8 rounded-2xl font-body text-sm font-semibold shadow-md shadow-emerald-600/20"
                >
                    <svg wire:loading.remove wire:target="createAccount" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    <span wire:loading wire:target="createAccount" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Buat Akun Admin
                </button>
            </div>
        </form>
    </div>
    @endif


    {{-- ===================== MODAL: EDIT PASSWORD ===================== --}}
    @if ($showEditModal)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        x-data
        x-init="$el.querySelector('input')?.focus()"
    >
        <div class="bg-card border border-border/60 rounded-3xl shadow-2xl w-full max-w-md p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-heading font-bold text-foreground">Reset Password User</h3>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">
                        Ubah password untuk: <span class="font-semibold text-foreground">{{ $editing_user_name }}</span>
                    </p>
                </div>
                <button wire:click="closeEditModal" class="p-2 rounded-xl hover:bg-muted text-muted-foreground hover:text-foreground transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="space-y-2">
                    <label for="edit_password" class="text-sm font-semibold font-body text-foreground">Password Baru *</label>
                    <input
                        type="password"
                        id="edit_password"
                        wire:model="edit_password"
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12 @error('edit_password') border-rose-400 @enderror"
                        placeholder="Min. 8 karakter"
                    >
                    @error('edit_password') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="edit_password_confirmation" class="text-sm font-semibold font-body text-foreground">Konfirmasi Password *</label>
                    <input
                        type="password"
                        id="edit_password_confirmation"
                        wire:model="edit_password_confirmation"
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Ulangi password baru"
                    >
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button
                    type="button"
                    wire:click="closeEditModal"
                    class="flex-1 h-11 rounded-2xl border border-border font-body text-sm font-semibold text-muted-foreground hover:bg-muted/60 transition-colors"
                >
                    Batal
                </button>
                <button
                    type="button"
                    wire:click="saveEditPassword"
                    wire:loading.attr="disabled"
                    class="flex-1 h-11 rounded-2xl bg-primary text-primary-foreground font-body text-sm font-semibold hover:bg-primary/90 transition-colors inline-flex items-center justify-center gap-2 shadow-md shadow-primary/20"
                >
                    <span wire:loading wire:target="saveEditPassword" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Simpan Password
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- ===================== MODAL: DELETE CONFIRM ===================== --}}
    @if ($showDeleteModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-card border border-border/60 rounded-3xl shadow-2xl w-full max-w-sm p-6 sm:p-8 space-y-5 text-center">
            <div class="w-14 h-14 rounded-2xl bg-rose-100 dark:bg-rose-500/10 flex items-center justify-center text-rose-500 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-heading font-bold text-foreground">Hapus Akun?</h3>
                <p class="text-sm text-muted-foreground font-body mt-1">
                    Akun <span class="font-semibold text-foreground">{{ $deleting_user_name }}</span> akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="flex gap-3">
                <button
                    type="button"
                    wire:click="cancelDelete"
                    class="flex-1 h-11 rounded-2xl border border-border font-body text-sm font-semibold text-muted-foreground hover:bg-muted/60 transition-colors"
                >
                    Batal
                </button>
                <button
                    type="button"
                    wire:click="deleteUser"
                    wire:loading.attr="disabled"
                    class="flex-1 h-11 rounded-2xl bg-rose-600 text-white font-body text-sm font-semibold hover:bg-rose-700 transition-colors inline-flex items-center justify-center gap-2"
                >
                    <span wire:loading wire:target="deleteUser" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    @endif

</div>

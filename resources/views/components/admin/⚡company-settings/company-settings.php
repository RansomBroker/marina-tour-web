<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    public string $company_name = '';
    public ?string $company_tagline = '';
    public ?string $company_email = '';
    public ?string $company_address = '';
    public ?string $company_about = '';
    public ?string $working_hours = '';
    public ?string $google_maps_embed = '';

    // Logo management
    public ?string $current_logo = null;
    public $new_logo = null;

    protected array $rules = [
        'company_name' => 'required|string|max:255',
        'company_tagline' => 'nullable|string|max:255',
        'company_email' => 'nullable|email|max:255',
        'company_address' => 'nullable|string|max:500',
        'company_about' => 'nullable|string|max:500',
        'working_hours' => 'nullable|string|max:255',
        'google_maps_embed' => 'nullable|string',
        'new_logo' => 'nullable|image|max:2048', // 2MB max
    ];

    public function mount(): void
    {
        $this->company_name = (string) (Setting::get('company_name', 'Smith Bali Travel'));
        $this->company_tagline = (string) (Setting::get('company_tagline', 'Your Trusted Bali Travel Partner'));
        $this->company_email = (string) (Setting::get('company_email', 'info@smithbalitravel.com'));
        $this->company_address = (string) (Setting::get('company_address', 'Jl. Raya Ubud, Gianyar, Bali - Indonesia'));
        $this->company_about = (string) (Setting::get('company_about', 'Your trusted Bali travel partner. Curated tours and personalized experiences across the Island of the Gods.'));
        $this->working_hours = (string) (Setting::get('working_hours', 'Daily 8:00 AM – 9:00 PM (Bali Time)'));
        $this->google_maps_embed = (string) (Setting::get('google_maps_embed', ''));
        $this->current_logo = Setting::get('company_logo');
    }

    public function save(): void
    {
        $this->validate();

        // Handle logo upload
        if ($this->new_logo) {
            // Remove old logo file if exists
            if ($this->current_logo && Storage::disk('public')->exists($this->current_logo)) {
                Storage::disk('public')->delete($this->current_logo);
            }

            $path = $this->new_logo->store('images/logos', 'public');
            Setting::set('company_logo', $path);
            $this->current_logo = $path;
            $this->new_logo = null;
        }

        Setting::set('company_name', $this->company_name);
        Setting::set('company_tagline', $this->company_tagline);
        Setting::set('company_email', $this->company_email);
        Setting::set('company_address', $this->company_address);
        Setting::set('company_about', $this->company_about);
        Setting::set('working_hours', $this->working_hours);
        Setting::set('google_maps_embed', $this->google_maps_embed);

        $this->dispatch('toast', 
            message: 'Company profile and logo updated successfully!', 
            type: 'success'
        );
    }

    public function removeLogo(): void
    {
        if ($this->current_logo && Storage::disk('public')->exists($this->current_logo)) {
            Storage::disk('public')->delete($this->current_logo);
        }

        Setting::set('company_logo', null);
        $this->current_logo = null;
        $this->new_logo = null;

        $this->dispatch('toast', 
            message: 'Company logo removed. Reverted to default text branding.', 
            type: 'success'
        );
    }

    public function render()
    {
        return view('components.admin.⚡company-settings.company-settings');
    }
};

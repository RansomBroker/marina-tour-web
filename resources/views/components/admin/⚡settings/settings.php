<?php

use Livewire\Component;
use App\Models\Setting;

new class extends Component
{
    public string $whatsapp_number = '';
    public string $admin_email = '';
    public string $company_name = '';
    public string $company_email = '';
    public string $company_address = '';
    public string $working_hours = '';
    public string $google_maps_embed = '';

    protected array $rules = [
        'whatsapp_number' => 'required|string|max:50',
        'admin_email' => 'required|email|max:255',
        'company_name' => 'required|string|max:255',
        'company_email' => 'nullable|email|max:255',
        'company_address' => 'nullable|string|max:500',
        'working_hours' => 'nullable|string|max:255',
        'google_maps_embed' => 'nullable|string',
    ];

    public function mount(): void
    {
        $this->whatsapp_number = Setting::get('whatsapp_number', '6281234567890');
        $this->admin_email = Setting::get('admin_email', 'Kadekekahospitality@gmail.com');
        $this->company_name = Setting::get('company_name', 'Smith Bali Travel');
        $this->company_email = Setting::get('company_email', 'info@smithbalitravel.com');
        $this->company_address = Setting::get('company_address', 'Bali, Indonesia');
        $this->working_hours = Setting::get('working_hours', 'Daily 8:00 AM – 9:00 PM (Bali Time)');
        $this->google_maps_embed = Setting::get('google_maps_embed', '');
    }

    public function save(): void
    {
        $this->validate();

        // Sanitize WhatsApp number (strip spaces, dashes, plus signs)
        $cleanWa = preg_replace('/[^0-9]/', '', $this->whatsapp_number);

        Setting::set('whatsapp_number', $cleanWa);
        Setting::set('admin_email', $this->admin_email);
        Setting::set('company_name', $this->company_name);
        Setting::set('company_email', $this->company_email);
        Setting::set('company_address', $this->company_address);
        Setting::set('working_hours', $this->working_hours);
        Setting::set('google_maps_embed', $this->google_maps_embed);

        $this->whatsapp_number = $cleanWa;

        $this->dispatch('toast', 
            message: 'Website configuration updated successfully!', 
            type: 'success'
        );

        session()->flash('success', 'Website configuration updated successfully!');
    }

    public function render()
    {
        return view('components.admin.⚡settings.settings');
    }
};

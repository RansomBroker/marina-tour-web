<?php

use Livewire\Component;
use App\Models\Setting;

new class extends Component
{
    public string $whatsapp_number = '';
    public string $whatsapp_default_message = '';

    protected array $rules = [
        'whatsapp_number' => 'required|string|max:50',
        'whatsapp_default_message' => 'nullable|string|max:500',
    ];

    public function mount(): void
    {
        $this->whatsapp_number = (string) (Setting::get('whatsapp_number', '6281234567890'));
        $this->whatsapp_default_message = (string) (Setting::get('whatsapp_default_message', 'Hello Smith Travel Bali, I would like to inquire about your tour packages.'));
    }

    public function save(): void
    {
        $this->validate();

        $cleanWa = preg_replace('/[^0-9]/', '', $this->whatsapp_number);

        Setting::set('whatsapp_number', $cleanWa);
        Setting::set('whatsapp_default_message', $this->whatsapp_default_message);

        $this->whatsapp_number = $cleanWa;

        $this->dispatch('toast', 
            message: 'WhatsApp configuration updated successfully!', 
            type: 'success'
        );
    }

    public function render()
    {
        return view('components.admin.⚡whatsapp-settings.whatsapp-settings');
    }
};

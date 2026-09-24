<?php

use Livewire\Component;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $whatsapp_number = '';
    public string $message = '';
    public bool $isSuccess = false;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'whatsapp_number' => 'required|string|max:50',
        'message' => 'required|string',
    ];

    public function submitInquiry(): void
    {
        $this->validate();

        $inquiry = Inquiry::create([
            'tour_package_id' => null,
            'name' => $this->name,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Send email to admin
        try {
            $adminEmail = \App\Models\Setting::get('admin_email', env('ADMIN_EMAIL', 'Kadekekahospitality@gmail.com'));
            $mailContent = "New Inquiry Received!\n\n" .
                          "• Inquiry ID: #{$inquiry->id}\n" .
                          "• Customer Name: {$this->name}\n" .
                          "• WhatsApp: {$this->whatsapp_number}\n" .
                          "• Email: {$this->email}\n\n" .
                          "Message:\n" .
                          "{$this->message}\n\n" .
                          "Please review this inquiry in your Admin Console dashboard.";

            Mail::raw($mailContent, function ($msg) use ($adminEmail) {
                $msg->to($adminEmail)
                    ->subject("New General Inquiry");
            });
        } catch (\Exception $e) {
            Log::error("Failed to send contact inquiry email: " . $e->getMessage());
        }

        $this->dispatch('toast', 
            message: 'Your inquiry has been submitted successfully!', 
            type: 'success'
        );

        $this->isSuccess = true;
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->reset([
            'name', 'email', 'whatsapp_number', 'message'
        ]);
    }

    public function render()
    {
        return view('components.public.⚡contact-us.contact-us');
    }
};
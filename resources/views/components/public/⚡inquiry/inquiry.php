<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\TourPackage;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public bool $isOpen = false;
    public bool $isSuccess = false;

    // Package details
    public ?int $packageId = null;
    public string $packageName = '';

    // Form fields
    public string $name = '';
    public string $whatsapp_number = '';
    public string $email = '';
    public string $message = '';

    protected array $rules = [
        'name' => 'required|string|max:255',
        'whatsapp_number' => 'required|string|max:50',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ];

    #[On('open-inquiry-modal')]
    public function openModal(string $slug): void
    {
        $this->resetForm();
        $package = TourPackage::where('slug', $slug)->first();
        if ($package) {
            $this->packageId = $package->id;
            $this->packageName = $package->name;
            $this->isOpen = true;
        }
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->isSuccess = false;
        $this->resetForm();
    }

    public function resetForm(): void
    {
        $this->reset([
            'packageId', 'packageName', 'name', 'whatsapp_number', 'email', 'message', 'isSuccess'
        ]);
    }

    public function submitInquiry(): void
    {
        $this->validate();

        $inquiry = Inquiry::create([
            'tour_package_id' => $this->packageId,
            'name' => $this->name,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Send email to admin
        try {
            $adminEmail = \App\Models\Setting::get('admin_email', env('ADMIN_EMAIL', 'Kadekekahospitality@gmail.com'));
            $mailContent = "New Tour Package Inquiry Received!\n\n" .
                          "• Inquiry ID: #{$inquiry->id}\n" .
                          "• Tour Package: {$this->packageName}\n" .
                          "• Customer Name: {$this->name}\n" .
                          "• WhatsApp: {$this->whatsapp_number}\n" .
                          "• Email: {$this->email}\n\n" .
                          "Message:\n" .
                          "{$this->message}\n\n" .
                          "Please review this inquiry in your Admin Console dashboard.";

            Mail::raw($mailContent, function ($msg) use ($adminEmail) {
                $msg->to($adminEmail)
                    ->subject("New Inquiry: {$this->packageName}");
            });
        } catch (\Exception $e) {
            // Log error but do not fail the submission
            Log::error("Failed to send inquiry email: " . $e->getMessage());
        }

        // Send toast message
        $this->dispatch('toast', 
            message: 'Inquiry submitted successfully! We will contact you soon.', 
            type: 'success'
        );

        $this->isSuccess = true;
    }
};

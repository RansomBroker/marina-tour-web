<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\TourPackage;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\NewBookingAdminNotification;
use App\Mail\BookingCustomerConfirmation;

new class extends Component
{
    public bool $isOpen = false;
    public bool $isSuccess = false;
    
    // Auto-populated fields
    public ?int $packageId = null;
    public string $packageName = '';
    public float $packagePrice = 0.00;
    public float $totalPrice = 0.00;

    // Form fields
    public string $full_name = '';
    public string $whatsapp_number = '';
    public string $email = '';
    public string $travel_date = '';
    public int $number_of_pax = 1;
    public string $pickup_location = '';
    public string $special_request = '';

    // Success details
    public string $bookingCode = '';
    public string $whatsappUrl = '';

    protected array $rules = [
        'full_name' => 'required|string|max:255',
        'whatsapp_number' => 'required|string|max:50',
        'email' => 'required|email|max:255',
        'travel_date' => 'required|date|after_or_equal:today',
        'number_of_pax' => 'required|integer|min:1',
        'pickup_location' => 'required|string',
        'special_request' => 'nullable|string',
    ];

    #[On('open-booking-modal')]
    public function openModal(string $slug): void
    {
        $this->resetForm();
        $package = TourPackage::where('slug', $slug)->first();
        if ($package) {
            $this->packageId = $package->id;
            $this->packageName = $package->name;
            $this->packagePrice = (float) $package->price;
            $this->calculateTotal();
            $this->isOpen = true;
        }
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->isSuccess = false;
        $this->resetForm();
    }

    public function updatedNumberOfPax(): void
    {
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->totalPrice = $this->packagePrice * max(1, $this->number_of_pax);
    }

    public function resetForm(): void
    {
        $this->reset([
            'packageId', 'packageName', 'packagePrice', 'totalPrice',
            'full_name', 'whatsapp_number', 'email', 'travel_date',
            'number_of_pax', 'pickup_location', 'special_request',
            'isSuccess', 'bookingCode', 'whatsappUrl'
        ]);
        $this->number_of_pax = 1;
    }

    public function submitBooking(): void
    {
        $this->validate();

        // Create booking code
        $this->bookingCode = 'BK-' . strtoupper(Str::random(8));

        $booking = Booking::create([
            'booking_code' => $this->bookingCode,
            'tour_package_id' => $this->packageId,
            'full_name' => $this->full_name,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'travel_date' => $this->travel_date,
            'number_of_pax' => $this->number_of_pax,
            'pickup_location' => $this->pickup_location,
            'special_request' => $this->special_request,
            'total_price' => $this->totalPrice,
            'deposit_amount' => 0,
            'remaining_balance' => $this->totalPrice,
            'payment_status' => 'unpaid',
            'status' => 'new',
        ]);

        // Send Email Notification to Admin & Confirmation to Customer
        try {
            $adminEmail = \App\Models\Setting::get('admin_email', env('ADMIN_EMAIL', 'Kadekekahospitality@gmail.com'));
            
            // 1. Send notification to Admin
            Mail::to($adminEmail)->send(new NewBookingAdminNotification($booking));

            // 2. Send confirmation to Customer
            Mail::to($booking->email)->send(new BookingCustomerConfirmation($booking));
        } catch (\Exception $e) {
            Log::error("Failed to send booking emails: " . $e->getMessage());
        }

        // Send a toast notification
        $this->dispatch('toast', 
            message: 'Booking request submitted successfully! Confirmation email has been sent.', 
            type: 'success'
        );

        // Prepare WhatsApp Pre-filled message
        $waMessage = "Hi Smith Bali Travel! I would like to book a tour:\n\n" .
                     "• Booking Code: {$this->bookingCode}\n" .
                     "• Package Name: {$this->packageName}\n" .
                     "• Travel Date: {$this->travel_date}\n" .
                     "• Number of Pax: {$this->number_of_pax} Person(s)\n" .
                     "• Total Price: IDR " . number_format($this->totalPrice, 0, ',', '.') . "\n" .
                     "• Full Name: {$this->full_name}\n" .
                     "• WhatsApp: {$this->whatsapp_number}\n" .
                     "• Email: {$this->email}\n" .
                     "• Pickup Location: {$this->pickup_location}";
                     
        if (!empty($this->special_request)) {
            $waMessage .= "\n• Special Request: {$this->special_request}";
        }

        $waMessage .= "\n\nPlease process my booking. Thank you!";
        $targetWa = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '6281234567890'));
        $this->whatsappUrl = "https://wa.me/{$targetWa}?text=" . urlencode($waMessage);

        $this->isSuccess = true;

        // Redirect to WhatsApp
        $this->dispatch('open-new-tab', url: $this->whatsappUrl);
    }
};

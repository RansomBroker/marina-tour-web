<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $paymentStatusFilter = '';
    
    // Viewing and editing details in modal
    public ?Booking $selectedBooking = null;
    public bool $isDetailOpen = false;

    // Editable fields in detail modal
    public string $editStatus = '';
    public string $editPaymentStatus = '';
    public float $editDepositAmount = 0.00;
    public float $editRemainingBalance = 0.00;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'paymentStatusFilter' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPaymentStatusFilter(): void
    {
        $this->resetPage();
    }

    public function viewDetails(int $id): void
    {
        $this->selectedBooking = Booking::with('package')->find($id);
        if ($this->selectedBooking) {
            $this->editStatus = $this->selectedBooking->status;
            $this->editPaymentStatus = $this->selectedBooking->payment_status ?? 'unpaid';
            $this->editDepositAmount = (float) ($this->selectedBooking->deposit_amount ?? 0);
            $this->editRemainingBalance = (float) ($this->selectedBooking->remaining_balance ?? max(0, (float)$this->selectedBooking->total_price - $this->editDepositAmount));
            $this->isDetailOpen = true;
        }
    }

    public function updatedEditDepositAmount(): void
    {
        if ($this->selectedBooking) {
            $total = (float) $this->selectedBooking->total_price;
            $deposit = max(0, (float) $this->editDepositAmount);
            $this->editRemainingBalance = max(0, $total - $deposit);

            // Smart suggestion for payment status if still default unpaid
            if ($deposit >= $total && $this->editPaymentStatus === 'unpaid') {
                $this->editPaymentStatus = 'fully_paid';
            } elseif ($deposit > 0 && $deposit < $total && $this->editPaymentStatus === 'unpaid') {
                $this->editPaymentStatus = 'deposit_paid';
            }
        }
    }

    public function saveBookingChanges(): void
    {
        if (!$this->selectedBooking) {
            return;
        }

        $this->validate([
            'editStatus' => 'required|string',
            'editPaymentStatus' => 'required|string',
            'editDepositAmount' => 'required|numeric|min:0',
        ]);

        $total = (float) $this->selectedBooking->total_price;
        $deposit = max(0, (float) $this->editDepositAmount);
        $remaining = max(0, $total - $deposit);

        $this->selectedBooking->update([
            'status' => $this->editStatus,
            'payment_status' => $this->editPaymentStatus,
            'deposit_amount' => $deposit,
            'remaining_balance' => $remaining,
        ]);

        $this->editRemainingBalance = $remaining;

        $this->dispatch('toast', 
            message: "Booking #{$this->selectedBooking->booking_code} updated successfully.", 
            type: 'success'
        );

        // Refresh selectedBooking
        $this->selectedBooking->refresh();
    }

    public function closeDetails(): void
    {
        $this->isDetailOpen = false;
        $this->selectedBooking = null;
    }

    public function updateBookingStatus(int $id, string $status): void
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->update(['status' => $status]);
            
            $label = Booking::bookingStatuses()[$status] ?? ucfirst($status);
            $this->dispatch('toast', 
                message: "Booking #{$booking->booking_code} status set to {$label}", 
                type: 'success'
            );

            if ($this->selectedBooking && $this->selectedBooking->id === $id) {
                $this->selectedBooking->status = $status;
                $this->editStatus = $status;
            }
        }
    }

    public function updatePaymentStatus(int $id, string $paymentStatus): void
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->update(['payment_status' => $paymentStatus]);
            
            $label = Booking::paymentStatuses()[$paymentStatus] ?? ucfirst($paymentStatus);
            $this->dispatch('toast', 
                message: "Booking #{$booking->booking_code} payment status set to {$label}", 
                type: 'success'
            );

            if ($this->selectedBooking && $this->selectedBooking->id === $id) {
                $this->selectedBooking->payment_status = $paymentStatus;
                $this->editPaymentStatus = $paymentStatus;
            }
        }
    }

    public function deleteBooking(int $id): void
    {
        $booking = Booking::find($id);
        if ($booking) {
            $code = $booking->booking_code;
            $booking->delete();
            
            if ($this->selectedBooking && $this->selectedBooking->id === $id) {
                $this->closeDetails();
            }

            $this->dispatch('toast', 
                message: "Booking #{$code} deleted successfully.", 
                type: 'success'
            );
        }
    }

    public function render()
    {
        $query = Booking::with('package')->latest();

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('booking_code', 'like', '%' . $this->search . '%')
                  ->orWhere('full_name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('whatsapp_number', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->paymentStatusFilter)) {
            $query->where('payment_status', $this->paymentStatusFilter);
        }

        return view('components.admin.⚡bookings.bookings', [
            'bookings' => $query->paginate(10),
            'bookingStatuses' => Booking::bookingStatuses(),
            'paymentStatuses' => Booking::paymentStatuses(),
        ]);
    }
};

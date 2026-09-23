<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    
    // Viewing details
    public ?Booking $selectedBooking = null;
    public bool $isDetailOpen = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function viewDetails(int $id): void
    {
        $this->selectedBooking = Booking::with('package')->find($id);
        if ($this->selectedBooking) {
            $this->isDetailOpen = true;
        }
    }

    public function closeDetails(): void
    {
        $this->isDetailOpen = false;
        $this->selectedBooking = null;
    }

    public function updateStatus(int $id, string $status): void
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->update(['status' => $status]);
            
            $this->dispatch('toast', 
                message: "Booking #{$booking->booking_code} status updated to " . ucfirst($status), 
                type: 'success'
            );
        }
    }

    public function deleteBooking(int $id): void
    {
        $booking = Booking::find($id);
        if ($booking) {
            $code = $booking->booking_code;
            $booking->delete();
            
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

        return view('components.admin.⚡bookings.bookings', [
            'bookings' => $query->paginate(10)
        ]);
    }
};

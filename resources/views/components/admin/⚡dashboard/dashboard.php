<?php

use Livewire\Component;
use App\Models\Booking;
use App\Models\TourPackage;
use App\Models\Inquiry;

new class extends Component
{
    public function render()
    {
        $totalBookings = Booking::count();
        
        // Sum total price of confirmed bookings
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');
        
        $totalPackages = TourPackage::count();
        $totalInquiries = Inquiry::count();
        
        // Retrieve 5 most recent bookings
        $recentBookings = Booking::with('package')->latest()->take(5)->get();

        return view('components.admin.⚡dashboard.dashboard', [
            'totalBookings' => $totalBookings,
            'totalRevenue' => $totalRevenue,
            'totalPackages' => $totalPackages,
            'totalInquiries' => $totalInquiries,
            'recentBookings' => $recentBookings,
        ]);
    }
};

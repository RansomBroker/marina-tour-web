<?php

use Livewire\Component;
use App\Models\TourPackage;

new class extends Component
{
    public function with(): array
    {
        $packages = TourPackage::with('category')
            ->latest()
            ->take(6)
            ->get()
            ->map(function ($package) {
                $image = !empty($package->images) 
                    ? asset('storage/' . $package->images[0]) 
                    : 'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80';
                
                return [
                    'slug' => $package->slug,
                    'image' => $image,
                    'title' => $package->name,
                    'category' => $package->category->name ?? 'Uncategorized',
                    'price' => 'IDR ' . number_format($package->price, 0, ',', '.'),
                    'description' => $package->description,
                    'duration' => $package->duration
                ];
            })->toArray();

        return [
            'packages' => $packages
        ];
    }
};
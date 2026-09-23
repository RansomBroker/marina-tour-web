<?php

use Livewire\Component;
use App\Models\TourPackage;
use App\Models\TourCategory;

new class extends Component
{
    public string $search = '';
    public string $selectedCategory = 'all';

    public function selectCategory(string $categoryName): void
    {
        $this->selectedCategory = $categoryName;
    }

    public function with(): array
    {
        $query = TourPackage::with('category');

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->whereHas('category', function ($q) {
                $q->where('name', $this->selectedCategory);
            });
        }

        $packages = $query->latest()->get()->map(function ($package) {
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

        $categories = TourCategory::pluck('name')->toArray();

        return [
            'packages' => $packages,
            'categories' => $categories,
        ];
    }
};
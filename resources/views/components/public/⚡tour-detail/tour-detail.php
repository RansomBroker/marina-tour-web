<?php

use Livewire\Component;
use App\Models\TourPackage;

new class extends Component
{
    public string $slug;
    public ?TourPackage $package = null;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->package = TourPackage::with(['category', 'relatedPackages'])
            ->where('slug', $slug)
            ->first();

        if (!$this->package) {
            abort(404);
        }
    }

    public function with(): array
    {
        $image = !empty($this->package->images) 
            ? asset('storage/' . $this->package->images[0]) 
            : 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80';

        $gallery = [];
        if (!empty($this->package->images) && count($this->package->images) > 1) {
            foreach ($this->package->images as $img) {
                $gallery[] = asset('storage/' . $img);
            }
        }

        // Safe defaults for array casts
        $highlights = is_array($this->package->highlights) ? $this->package->highlights : [];
        $included = is_array($this->package->included) ? $this->package->included : [];
        $excluded = is_array($this->package->excluded) ? $this->package->excluded : [];
        $whatToBring = is_array($this->package->what_to_bring) ? $this->package->what_to_bring : [];
        $itinerary = is_array($this->package->itinerary) ? $this->package->itinerary : [];
        $faq = is_array($this->package->faq) ? $this->package->faq : [];

        $related = $this->package->relatedPackages->map(function ($rel) {
            $relImage = !empty($rel->images) 
                ? asset('storage/' . $rel->images[0]) 
                : 'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80';

            return [
                'slug' => $rel->slug,
                'image' => $relImage,
                'title' => $rel->name,
                'category' => $rel->category->name ?? 'Uncategorized',
                'price' => 'IDR ' . number_format($rel->price, 0, ',', '.'),
                'description' => $rel->description,
                'duration' => $rel->duration
            ];
        })->toArray();

        return [
            'tour' => [
                'slug' => $this->package->slug,
                'image' => $image,
                'gallery' => $gallery,
                'title' => $this->package->name,
                'category' => $this->package->category->name ?? 'Uncategorized',
                'price' => 'IDR ' . number_format($this->package->price, 0, ',', '.'),
                'duration' => $this->package->duration,
                'location' => 'Bali, Indonesia',
                'description' => $this->package->description,
                'highlights' => $highlights,
                'included' => $included,
                'excluded' => $excluded,
                'what_to_bring' => $whatToBring,
                'itinerary' => $itinerary,
                'cancellation_policy' => $this->package->cancellation_policy ?? 'Free cancellation up to 24 hours in advance.',
                'faq' => $faq,
                'related' => $related,
            ]
        ];
    }
};
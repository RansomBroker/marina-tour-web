<?php

use Livewire\Component;

new class extends Component
{
    public array $blogs = [
        [
            'image' => 'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'March 5, 2026',
            'title' => 'Best Time to Visit Bali for Your Dream Vacation',
            'description' => 'Planning a Bali trip? Learn about the best seasons, weather patterns, and peak times to visit the Island of the Gods for an unforgettable experience.',
            'url' => '/BlogPost?id=best-time-to-visit-bali'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
            'category' => 'Destination Guide',
            'date' => 'February 28, 2026',
            'title' => 'Top 10 Places to Visit in Ubud',
            'description' => 'Ubud is the cultural heart of Bali. Discover the must-visit temples, rice terraces, art galleries, and hidden gems that make Ubud truly special.',
            'url' => '/BlogPost?id=top-10-places-ubud'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'February 20, 2026',
            'title' => 'What to Pack for a Bali Trip',
            'description' => 'Don\'t know what to bring? Here\'s a complete packing guide for Bali with tips on clothing, essentials, and what to leave at home.',
            'url' => '/BlogPost?id=what-to-pack-bali'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80',
            'category' => 'Destination Guide',
            'date' => 'February 15, 2026',
            'title' => 'Uluwatu Travel Guide for First-Time Visitors',
            'description' => 'Everything you need to know about visiting Uluwatu, from the stunning cliff temple to the best surf breaks and sunset spots.',
            'url' => '/BlogPost?id=uluwatu-travel-guide'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1570789210967-2cac24f04879?w=800&q=80',
            'category' => 'Island Guide',
            'date' => 'February 8, 2026',
            'title' => 'Nusa Penida Day Trip: What You Need to Know',
            'description' => 'Planning a day trip to Nusa Penida? Here\'s your complete guide covering boat transfers, must-see spots, and essential tips.',
            'url' => '/BlogPost?id=nusa-penida-day-trip'
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'January 30, 2026',
            'title' => 'Bali Private Driver vs Self-Drive: Which is Better?',
            'description' => 'Should you hire a private driver in Bali or rent a scooter? We compare both options to help you decide the best way to get around.',
            'url' => '/BlogPost?id=bali-private-driver-vs-self-drive'
        ]
    ];
};
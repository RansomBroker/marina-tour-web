<?php

use Livewire\Component;

new class extends Component
{
    public string $slug;
    public array $tour = [];

    public function mount($slug)
    {
        $this->slug = $slug;
        
        $tours = [
            'honeymoon-romantic-bali-tour' => [
                'image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                'title' => 'Honeymoon Romantic Bali Tour',
                'category' => 'Honeymoon Tours',
                'price' => 'From $90/couple',
                'duration' => 'Full Day',
                'location' => 'Bali, Indonesia',
                'description' => 'Create unforgettable memories with your loved one on a romantic journey through Bali\'s most scenic and intimate locations.',
                'highlights' => [
                    'Scenic Photo Spots',
                    'Romantic Dinner Option',
                    'Private Car',
                    'Flexible Timing'
                ],
                'included' => [
                    'Private car & driver',
                    'Couple flower decoration',
                    'Dinner voucher',
                    'Hotel pickup & drop-off'
                ]
            ],
            'bedugul-tanah-lot-tour' => [
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800&q=80',
                'title' => 'Bedugul & Tanah Lot Tour',
                'category' => 'Nature Tours',
                'price' => 'From $48/person',
                'duration' => 'Full Day',
                'location' => 'Bali, Indonesia',
                'description' => 'Experience the serene beauty of Bali\'s highlands and witness the iconic Tanah Lot temple perched on a dramatic ocean rock at sunset.',
                'highlights' => [
                    'Ulun Danu Beratan Temple',
                    'Jatiluwih Rice Terraces',
                    'Tanah Lot Sunset',
                    'Private Guide'
                ],
                'included' => [
                    'Private AC vehicle',
                    'English speaking driver',
                    'All entrance tickets',
                    'Mineral water'
                ]
            ],
            'atv-adventure-tour' => [
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=800&q=80',
                'title' => 'ATV Adventure Tour',
                'category' => 'Adventure Tours',
                'price' => 'From $65/person',
                'duration' => 'Half Day',
                'location' => 'Ubud, Bali',
                'description' => 'Get your adrenaline pumping on an exciting ATV ride through jungles, tunnels, rice fields, and waterfalls in Bali\'s countryside.',
                'highlights' => ['Jungle Track', 'Waterfall Visit', 'Safety Gear', 'Local Lunch'],
                'included' => ['ATV Equipment', 'Professional Guide', 'Lunch', 'Insurance']
            ],
            'bali-instagram-tour' => [
                'image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
                'title' => 'Bali Instagram Tour',
                'category' => 'Cultural Tours',
                'price' => 'From $55/person',
                'duration' => 'Full Day',
                'location' => 'East Bali',
                'description' => 'Visit Bali\'s most photogenic spots including the Gates of Heaven, water palaces, and hidden waterfalls for the ultimate photo experience.',
                'highlights' => ['Lempuyang Temple', 'Tirta Gangga', 'Tukad Cepung Waterfall'],
                'included' => ['Private Driver', 'All Entrance Fees', 'Swing Ticket']
            ],
            'nusa-penida-west-tour' => [
                'image' => 'https://images.unsplash.com/photo-1570789210967-2cac24f04879?w=800&q=80',
                'title' => 'Nusa Penida West Tour',
                'category' => 'Island Tours',
                'price' => 'From $75/person',
                'duration' => 'Full Day',
                'location' => 'Nusa Penida, Bali',
                'description' => 'Explore the stunning island of Nusa Penida with its dramatic cliffs, crystal-clear waters, and Instagram-famous viewpoints.',
                'highlights' => ['Kelingking Beach', 'Broken Beach', 'Angel\'s Billabong', 'Crystal Bay'],
                'included' => ['Fast Boat Return Ticket', 'Private Car in Penida', 'Lunch', 'Entrance Fees']
            ],
            'kintamani-volcano-tour' => [
                'image' => 'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80',
                'title' => 'Kintamani Volcano Tour',
                'category' => 'Nature Tours',
                'price' => 'From $50/person',
                'duration' => 'Full Day',
                'location' => 'Kintamani, Bali',
                'description' => 'Discover the breathtaking views of Mount Batur volcano, visit traditional coffee plantations, and explore scenic rice terraces.',
                'highlights' => ['Mount Batur View', 'Tegalalang Rice Terrace', 'Coffee Plantation', 'Tirta Empul Temple'],
                'included' => ['Private Transport', 'English Speaking Guide', 'All Tickets', 'Buffet Lunch']
            ],
            'default' => [
                'image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                'title' => 'Bali Tour Package',
                'category' => 'General Tours',
                'price' => 'From $50/person',
                'duration' => 'Full Day',
                'location' => 'Bali, Indonesia',
                'description' => 'Explore the beauty of Bali with our customized tour package.',
                'highlights' => ['Scenic Views', 'Cultural Sites', 'Comfortable Transport'],
                'included' => ['Private Driver', 'Mineral Water', 'Hotel Transfer']
            ]
        ];

        $this->tour = $tours[$slug] ?? $tours['default'];
    }
};
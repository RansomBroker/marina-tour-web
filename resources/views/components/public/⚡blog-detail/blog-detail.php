<?php

use Livewire\Component;

new class extends Component
{
    public $slug;
    public $blog;
    public $relatedBlogs;

    public array $blogs = [
        [
            'slug' => 'best-time-to-visit-bali',
            'image' => 'https://images.unsplash.com/photo-1573790387438-4da905039392?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'March 5, 2026',
            'title' => 'Best Time to Visit Bali for Your Dream Vacation',
            'description' => 'Planning a Bali trip? Learn about the best seasons, weather patterns, and peak times to visit the Island of the Gods for an unforgettable experience.',
            'content' => '
<p>Bali is a year-round destination, but certain months offer better weather and fewer crowds.</p>
<h2>Dry Season (April – October)</h2>
<p>The dry season is considered the best time to visit Bali. Clear blue skies, low humidity, and pleasant temperatures. Ideal for beach activities, temple visits, and outdoor adventures.</p>
<p><strong>Best months:</strong> May, June, and September offer the perfect balance of great weather and manageable crowds.</p>
<h2>Wet Season (November – March)</h2>
<p>The wet season brings occasional tropical showers, usually in the afternoon. Bali is still beautiful during this time with lush green landscapes and fewer tourists.</p>
<h2>Peak Season</h2>
<p>July and August are the busiest months. December and the Christmas/New Year period also see a surge in visitors. Book well in advance.</p>
<h2>Our Recommendation</h2>
<p>For the ideal Bali experience, we recommend visiting between May and September.</p>
<p>Ready to plan your Bali trip? Contact Smith Bali Travel!</p>'
        ],
        [
            'slug' => 'top-10-places-ubud',
            'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=800&q=80',
            'category' => 'Destination Guide',
            'date' => 'February 28, 2026',
            'title' => 'Top 10 Places to Visit in Ubud',
            'description' => 'Ubud is the cultural heart of Bali. Discover the must-visit temples, rice terraces, art galleries, and hidden gems that make Ubud truly special.',
            'content' => '<p>Ubud is the cultural heart of Bali. Explore the Sacred Monkey Forest, walk along the Campuhan Ridge, and visit the beautiful Tegalalang Rice Terraces. Don\'t forget to stop by the local art markets for some unique souvenirs.</p>
<h2>1. Sacred Monkey Forest Sanctuary</h2>
<p>A nature reserve and Hindu temple complex in Ubud, home to hundreds of macaques.</p>
<h2>2. Tegalalang Rice Terrace</h2>
<p>Famous for its beautiful scenes of rice paddies involving the subak (traditional Balinese cooperative irrigation system).</p>
<h2>3. Campuhan Ridge Walk</h2>
<p>A free and easy nature trek, with sweeping hilltop views of the surrounding lush valleys.</p>'
        ],
        [
            'slug' => 'what-to-pack-bali',
            'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'February 20, 2026',
            'title' => 'What to Pack for a Bali Trip',
            'description' => 'Don\'t know what to bring? Here\'s a complete packing guide for Bali with tips on clothing, essentials, and what to leave at home.',
            'content' => '<p>Packing for Bali is all about lightweight clothing and travel essentials. Here is a quick list of what you should definitely bring along:</p>
<ul>
    <li>Lightweight, breathable clothing (cotton or linen)</li>
    <li>Swimwear (at least 2 sets)</li>
    <li>Comfortable walking shoes and flip-flops</li>
    <li>Sunscreen (reef-safe if you plan on snorkeling)</li>
    <li>Insect repellent</li>
    <li>A universal power adapter</li>
</ul>
<p>Leave your heavy jackets and formal wear at home. Bali is very casual!</p>'
        ],
        [
            'slug' => 'uluwatu-travel-guide',
            'image' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?w=800&q=80',
            'category' => 'Destination Guide',
            'date' => 'February 15, 2026',
            'title' => 'Uluwatu Travel Guide for First-Time Visitors',
            'description' => 'Everything you need to know about visiting Uluwatu, from the stunning cliff temple to the best surf breaks and sunset spots.',
            'content' => '<p>Uluwatu is famous for its stunning cliffside views, pristine beaches, and the iconic Uluwatu Temple. It\'s a paradise for surfers and those looking for a more relaxed vibe compared to Kuta or Seminyak.</p>
<h2>Top Things to Do</h2>
<ul>
    <li>Visit the Uluwatu Temple at sunset</li>
    <li>Watch the traditional Kecak Fire Dance</li>
    <li>Surf at Suluban Beach or Padang Padang</li>
    <li>Relax at Sundays Beach Club</li>
</ul>
<p>Don\'t miss out on the incredible seafood dinners overlooking the ocean!</p>'
        ],
        [
            'slug' => 'nusa-penida-day-trip',
            'image' => 'https://images.unsplash.com/photo-1570789210967-2cac24f04879?w=800&q=80',
            'category' => 'Island Guide',
            'date' => 'February 8, 2026',
            'title' => 'Nusa Penida Day Trip: What You Need to Know',
            'description' => 'Planning a day trip to Nusa Penida? Here\'s your complete guide covering boat transfers, must-see spots, and essential tips.',
            'content' => '<p>A day trip to Nusa Penida is a must for anyone looking to see some of the most dramatic landscapes near Bali. The fast boat ride from Sanur takes about 45 minutes.</p>
<h2>Must-See Spots</h2>
<ul>
    <li><strong>Kelingking Beach:</strong> Famous for its T-Rex shaped cliff.</li>
    <li><strong>Broken Beach & Angel\'s Billabong:</strong> Stunning natural rock formations and tide pools.</li>
    <li><strong>Crystal Bay:</strong> Perfect for a relaxing swim and snorkeling.</li>
</ul>
<p>Be prepared for bumpy roads on the island, but the views are absolutely worth it!</p>'
        ],
        [
            'slug' => 'bali-private-driver-vs-self-drive',
            'image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
            'category' => 'Travel Tips',
            'date' => 'January 30, 2026',
            'title' => 'Bali Private Driver vs Self-Drive: Which is Better?',
            'description' => 'Should you hire a private driver in Bali or rent a scooter? We compare both options to help you decide the best way to get around.',
            'content' => '<p>Getting around Bali can be challenging due to narrow roads and heavy traffic. Here is a comparison between hiring a private driver and driving yourself.</p>
<h2>Hiring a Private Driver</h2>
<p>Pros: Relaxing, air-conditioned comfort, local knowledge, no stress over navigation or parking.<br>
Cons: More expensive than a scooter, less flexibility for spontaneous stops.</p>
<h2>Renting a Scooter</h2>
<p>Pros: Very cheap, great for weaving through traffic, ultimate freedom.<br>
Cons: Can be dangerous if you are not an experienced rider, exposure to sun and rain, police checks.</p>
<p>If you plan on doing long day trips, a private driver is highly recommended.</p>'
        ]
    ];

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->blog = collect($this->blogs)->firstWhere('slug', $slug);

        if (!$this->blog) {
            abort(404);
        }

        $this->relatedBlogs = collect($this->blogs)
            ->where('slug', '!=', $slug)
            ->take(3)
            ->toArray();
    }
};
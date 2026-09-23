<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourPackage;
use App\Models\TourCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure packages directory exists in public disk
        if (!Storage::disk('public')->exists('packages')) {
            Storage::disk('public')->makeDirectory('packages');
        }

        $packagesData = [
            [
                'slug' => 'honeymoon-romantic-bali-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80',
                'name' => 'Honeymoon Romantic Bali Tour',
                'category' => 'Honeymoon Tours',
                'price' => 1350000,
                'description' => 'Create unforgettable memories with your loved one on a romantic journey through Bali\'s most scenic and intimate locations.',
                'duration' => 'Full Day',
                'highlights' => [
                    'Romantic dinner on a private beach setting',
                    'Visit to Uluwatu Temple at sunset with Kecak Dance',
                    'Couples spa session at a luxury wellness center',
                    'Scenic private boat cruise around Jimbaran Bay'
                ],
                'included' => [
                    'Private luxury AC transport',
                    'English-speaking driver & guide',
                    'All entrance tickets & performance passes',
                    'Gourmet 3-course romantic dinner',
                    'Mineral water & cold towels'
                ],
                'excluded' => [
                    'Personal expenses',
                    'Gratuities & tips for guide/driver'
                ],
                'what_to_bring' => [
                    'Camera / smartphone for photos',
                    'Comfortable walking shoes & extra clothing',
                    'Sunscreen & sunglasses'
                ],
                'cancellation_policy' => 'Free cancellation up to 48 hours in advance for a full refund.',
                'faq' => [
                    ['question' => 'Is transport private?', 'answer' => 'Yes, all transports provided in this package are fully private for you and your partner.'],
                    ['question' => 'Can we customize the itinerary?', 'answer' => 'Absolutely. Feel free to request itinerary adjustments with our team via WhatsApp after booking.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival & Sunset Uluwatu', 'description' => 'Pick up from hotel, head to Uluwatu Temple, watch the fire dance, and enjoy romantic beachfront dinner.']
                ]
            ],
            [
                'slug' => 'bedugul-tanah-lot-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800&q=80',
                'name' => 'Bedugul & Tanah Lot Tour',
                'category' => 'Nature Tours',
                'price' => 720000,
                'description' => 'Experience the serene beauty of Bali\'s highlands and witness the iconic Tanah Lot temple perched on a dramatic ocean rock at sunset.',
                'duration' => 'Full Day',
                'highlights' => [
                    'Explore the iconic water temple Ulun Danu Beratan',
                    'Stroll through the lush Bali Botanic Garden',
                    'Witness the majestic sunset at Tanah Lot Temple',
                    'Visit the traditional fruit and spice market in Candi Kuning'
                ],
                'included' => [
                    'Private AC transportation',
                    'Professional English-speaking driver',
                    'All entrance fees and parking tickets',
                    'Buffet lunch overlooking Lake Beratan',
                    'Bottled mineral water'
                ],
                'excluded' => [
                    'Dinner',
                    'Personal shopping / shopping at markets',
                    'Tips'
                ],
                'what_to_bring' => [
                    'Light jacket (Bedugul can be cool)',
                    'Camera',
                    'Sunscreen & umbrella'
                ],
                'cancellation_policy' => 'Cancel up to 24 hours in advance for a full refund.',
                'faq' => [
                    ['question' => 'What is the temperature in Bedugul?', 'answer' => 'Bedugul is in the highlands, so temperatures range from 18°C to 24°C. We recommend bringing a light jacket.'],
                    ['question' => 'Is lunch included?', 'answer' => 'Yes, a buffet lunch with Indonesian cuisine is included.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Highland Exploration', 'description' => 'Depart in the morning, visit Ulun Danu Beratan, explore Candi Kuning market, lunch, and end the day witnessing sunset at Tanah Lot.']
                ]
            ],
            [
                'slug' => 'atv-adventure-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=800&q=80',
                'name' => 'ATV Adventure Tour',
                'category' => 'Adventure Tours',
                'price' => 975000,
                'description' => 'Get your adrenaline pumping on an exciting ATV ride through jungles, tunnels, rice fields, and waterfalls in Bali\'s countryside.',
                'duration' => 'Half Day',
                'highlights' => [
                    '2-hour quad bike ride through muddy tracks and jungles',
                    'Ride through a traditional village and cave tunnel',
                    'Shower facilities and lockers provided',
                    'Scenic waterfall stop for photos'
                ],
                'included' => [
                    'Air-conditioned return hotel transfer',
                    'Welcome drink',
                    'Safety equipment (Helmet & boots)',
                    'Professional ATV instructor/guide',
                    'Gourmet lunch after the ride',
                    'Insurance cover'
                ],
                'excluded' => [
                    'ATV photo & video packages (optional)',
                    'Extra drinks at lunch'
                ],
                'what_to_bring' => [
                    'Change of clothes (you will get wet and muddy)',
                    'Plastic bag for wet clothes',
                    'Socks, sunscreen, and cash for optional photo purchases'
                ],
                'cancellation_policy' => 'Free cancellation up to 24 hours in advance.',
                'faq' => [
                    ['question' => 'Is prior riding experience required?', 'answer' => 'No. Our instructors will provide a full safety briefing and training before you hit the tracks.'],
                    ['question' => 'What is the minimum age to ride?', 'answer' => 'Minimum age to ride solo is 12 years old. Children under 12 can join as tandem passengers with an adult.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Mud & Cave Jungle Ride', 'description' => 'Arrive at the ATV base camp, undergo safety briefing, ride through muddy rice fields and tunnels, followed by a warm shower and lunch.']
                ]
            ],
            [
                'slug' => 'bali-instagram-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
                'name' => 'Bali Instagram Tour',
                'category' => 'Cultural Tours',
                'price' => 825000,
                'description' => 'Visit Bali\'s most photogenic spots including the Gates of Heaven, water palaces, and hidden waterfalls for the ultimate photo experience.',
                'duration' => 'Full Day',
                'highlights' => [
                    'Take photos at Lempuyang Temple (Gates of Heaven)',
                    'Visit Tirta Gangga Water Palace',
                    'Swim at Tukad Cepung hidden canyon waterfall',
                    'Swing over the scenic jungle in Ubud'
                ],
                'included' => [
                    'Private AC vehicle',
                    'English-speaking driver-photographer',
                    'All temple and destination entry fees',
                    'Ubud jungle swing ticket',
                    'Sarong rental for temple visits'
                ],
                'excluded' => [
                    'Lunch (driver can suggest scenic local spots)',
                    'Personal expenses'
                ],
                'what_to_bring' => [
                    'Brightly colored clothing for high-contrast photos',
                    'Swimwear & towel',
                    'Power bank for your devices'
                ],
                'cancellation_policy' => 'Free cancellation up to 24 hours before departure.',
                'faq' => [
                    ['question' => 'Does the driver take photos for us?', 'answer' => 'Yes, our drivers are trained to take pictures from the best angles at every destination.'],
                    ['question' => 'Is Lempuyang Temple crowded?', 'answer' => 'Yes, it is very popular. We recommend leaving early in the morning to beat the long lines.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Gates of Heaven & Hidden Falls', 'description' => 'Early departure for Lempuyang Temple, follow up with Tirta Gangga Water Palace, lunch, Tukad Cepung waterfall, and Ubud swing.']
                ]
            ],
            [
                'slug' => 'nusa-penida-west-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1570789210967-2cac24f04879?w=800&q=80',
                'name' => 'Nusa Penida West Tour',
                'category' => 'Island Tours',
                'price' => 1125000,
                'description' => 'Explore the stunning island of Nusa Penida with its dramatic cliffs, crystal-clear waters, and Instagram-famous viewpoints.',
                'duration' => 'Full Day',
                'highlights' => [
                    'Witness the famous T-Rex shaped Kelingking Beach',
                    'Stroll around the natural ocean pool of Angel Billabong',
                    'See the circular cliff arch of Broken Beach',
                    'Relax on the sandy shore of Crystal Bay'
                ],
                'included' => [
                    'Return fast boat tickets (Sanur - Nusa Penida)',
                    'Private AC car in Nusa Penida with driver/guide',
                    'All island entry fees and parking tickets',
                    'Lunch at a local restaurant',
                    'Mineral water'
                ],
                'excluded' => [
                    'Snorkeling gear (optional add-on)',
                    'Tips & personal costs'
                ],
                'what_to_bring' => [
                    'Sunscreen, hat, and sunglasses',
                    'Good walking shoes (climbing to Kelingking beach can be steep)',
                    'Swimwear & change of clothes'
                ],
                'cancellation_policy' => 'Free cancellation up to 48 hours in advance.',
                'faq' => [
                    ['question' => 'How long is the boat ride?', 'answer' => 'The fast boat from Sanur to Nusa Penida takes about 40 to 45 minutes.'],
                    ['question' => 'Can we swim at Angel Billabong?', 'answer' => 'Swimming is allowed only during low tide when there are no big waves. Safety is our priority.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Island Paradise Excursion', 'description' => 'Depart from Sanur harbor, arrive at Penida, visit Kelingking Beach, Broken Beach, Angel Billabong, lunch, relax at Crystal Bay, and return by fast boat.']
                ]
            ],
            [
                'slug' => 'kintamani-volcano-tour',
                'imageUrl' => 'https://images.unsplash.com/photo-1604999333679-b86d54738315?w=800&q=80',
                'name' => 'Kintamani Volcano Tour',
                'category' => 'Nature Tours',
                'price' => 750000,
                'description' => 'Discover the breathtaking views of Mount Batur volcano, visit traditional coffee plantations, and explore scenic rice terraces.',
                'duration' => 'Full Day',
                'highlights' => [
                    'Panoramic view of Mount Batur active volcano and its lake',
                    'Visit a traditional Balinese coffee plantation (Luwak coffee)',
                    'Walk through the world-famous Tegalalang Rice Terraces',
                    'Visit Tirta Empul Holy Water Temple'
                ],
                'included' => [
                    'Private hotel pickup & dropoff',
                    'Comfortable private AC transportation',
                    'All entrance fees and local guide fees',
                    'Buffet lunch with direct volcano views',
                    'Mineral water'
                ],
                'excluded' => [
                    'Coffee Luwak testing costs (optional)',
                    'Tips'
                ],
                'what_to_bring' => [
                    'Camera',
                    'Sarong for temple entrance (also available to rent on-site)',
                    'Comfortable walking shoes'
                ],
                'cancellation_policy' => 'Free cancellation up to 24 hours prior to departure.',
                'faq' => [
                    ['question' => 'Can we hike the volcano on this tour?', 'answer' => 'No, this is a sightseeing tour. Volcano hiking is a separate overnight trip starting at 2 AM.'],
                    ['question' => 'Is Mount Batur safe to visit?', 'answer' => 'Yes, it is highly monitored and perfectly safe to view from the Kintamani observatory ridge.']
                ],
                'itinerary' => [
                    ['day' => 1, 'title' => 'Volcano View & Rice Terraces', 'description' => 'Depart hotel, visit Tirta Empul, head to Kintamani for lunch and volcano viewing, walk through Tegalalang rice terraces, and visit organic coffee plantation.']
                ]
            ]
        ];

        foreach ($packagesData as $pData) {
            // Find category
            $category = TourCategory::where('name', $pData['category'])->first();
            if (!$category) {
                // Fallback category if not found
                $category = TourCategory::firstOrCreate([
                    'name' => $pData['category'], 
                    'slug' => Str::slug($pData['category'])
                ]);
            }

            // Download image locally to make it work with the storage system
            $localImagePath = null;
            try {
                $response = Http::get($pData['imageUrl']);
                if ($response->successful()) {
                    $filename = 'packages/' . $pData['slug'] . '.jpg';
                    Storage::disk('public')->put($filename, $response->body());
                    $localImagePath = $filename;
                }
            } catch (\Exception $e) {
                // Fallback
            }

            TourPackage::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'tour_category_id' => $category->id,
                    'name' => $pData['name'],
                    'price' => $pData['price'],
                    'duration' => $pData['duration'],
                    'description' => $pData['description'],
                    'images' => $localImagePath ? [$localImagePath] : [],
                    'highlights' => $pData['highlights'],
                    'included' => $pData['included'],
                    'excluded' => $pData['excluded'],
                    'what_to_bring' => $pData['what_to_bring'],
                    'cancellation_policy' => $pData['cancellation_policy'],
                    'faq' => $pData['faq'],
                    'itinerary' => $pData['itinerary'],
                ]
            );
        }
    }
}

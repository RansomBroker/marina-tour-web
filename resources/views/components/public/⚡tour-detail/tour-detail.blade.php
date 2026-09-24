<div>
    <!-- Hero Image Header -->
    <div class="relative w-full h-[60vh] min-h-[500px]">
        <img src="{{ $tour['image'] }}" alt="{{ $tour['title'] }}" class="w-full h-full object-cover">
        <!-- Gradient to make text readable and blend with navbar -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/80"></div>
        
        <div class="absolute inset-0 flex items-end pb-12 pt-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <!-- Back button -->
                <a href="/tour-packages" class="inline-flex items-center gap-2 text-sm font-medium text-white/70 hover:text-white mb-6 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Back to Packages
                </a>

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center rounded-md px-3 py-1 font-semibold transition-colors shadow bg-primary text-primary-foreground font-body text-xs mb-3">
                            {{ $tour['category'] }}
                        </div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-white leading-tight">{{ $tour['title'] }}</h1>
                    </div>
                    <span class="bg-accent text-accent-foreground px-6 py-4 rounded-2xl font-body font-bold text-xl shadow-xl shrink-0 hidden sm:block border border-accent-foreground/10">
                        {{ $tour['price'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <section class="relative py-12 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Content (Left Column - 2/3 width) -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Mobile Price -->
                    <div class="sm:hidden bg-accent/10 border border-accent/20 rounded-2xl p-5 flex justify-between items-center">
                        <span class="font-body text-muted-foreground font-medium text-sm">Starting Price</span>
                        <span class="text-accent font-bold font-body text-2xl">{{ $tour['price'] }}</span>
                    </div>

                    <!-- Info Bar -->
                    <div class="flex flex-wrap items-center gap-6 text-sm text-foreground font-body p-6 bg-card rounded-2xl border border-border/50 shadow-sm">
                        <span class="flex items-center gap-3">
                            <div class="p-2 bg-primary/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-primary"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground mb-0.5">Duration</p>
                                <p class="font-semibold text-card-foreground">{{ $tour['duration'] }}</p>
                            </div>
                        </span>
                        <div class="w-px h-10 bg-border/50 hidden sm:block"></div>
                        <span class="flex items-center gap-3">
                            <div class="p-2 bg-primary/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div>
                                <p class="text-xs text-muted-foreground mb-0.5">Location</p>
                                <p class="font-semibold text-card-foreground">{{ $tour['location'] }}</p>
                            </div>
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-slate max-w-none">
                        <h3 class="text-2xl font-heading font-bold text-foreground mb-4">Tour Overview</h3>
                        <p class="text-muted-foreground font-body leading-relaxed text-lg">{{ $tour['description'] }}</p>
                    </div>

                    <!-- Gallery Photos (If any) -->
                    @if(!empty($tour['gallery']))
                        <div class="space-y-4">
                            <h3 class="text-2xl font-heading font-bold text-foreground">Gallery</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($tour['gallery'] as $galleryImg)
                                    <div class="relative h-32 sm:h-40 rounded-2xl overflow-hidden group border border-border/50">
                                        <img src="{{ $galleryImg }}" alt="Gallery Image" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Highlights & What to bring -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Highlights -->
                        @if(!empty($tour['highlights']))
                            <div class="p-8 rounded-3xl bg-muted/30 border border-border/50 hover:border-primary/20 transition-colors">
                                <h4 class="font-heading font-bold text-xl mb-6 text-foreground flex items-center gap-3">
                                    <div class="p-2 bg-accent/10 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-accent"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    </div>
                                    Tour Highlights
                                </h4>
                                <div class="space-y-4">
                                    @foreach($tour['highlights'] as $highlight)
                                        <div class="flex items-start gap-3 text-base font-body text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-secondary shrink-0 mt-1"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span class="leading-relaxed text-sm">{{ $highlight }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- What to bring -->
                        @if(!empty($tour['what_to_bring']))
                            <div class="p-8 rounded-3xl bg-muted/30 border border-border/50 hover:border-primary/20 transition-colors">
                                <h4 class="font-heading font-bold text-xl mb-6 text-foreground flex items-center gap-3">
                                    <div class="p-2 bg-amber-500/10 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-amber-500"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    </div>
                                    What to Bring
                                </h4>
                                <div class="space-y-4">
                                    @foreach($tour['what_to_bring'] as $bringItem)
                                        <div class="flex items-start gap-3 text-base font-body text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500 shrink-0 mt-1"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                            <span class="leading-relaxed text-sm">{{ $bringItem }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Inclusions & Exclusions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Included -->
                        @if(!empty($tour['included']))
                            <div class="p-8 rounded-3xl bg-emerald-500/5 border border-emerald-500/10 hover:border-emerald-500/20 transition-colors">
                                <h4 class="font-heading font-bold text-xl mb-6 text-emerald-800 dark:text-emerald-350 flex items-center gap-3">
                                    <div class="p-2 bg-emerald-500/10 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-emerald-600"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                    </div>
                                    What's Included
                                </h4>
                                <div class="space-y-4">
                                    @foreach($tour['included'] as $item)
                                        <div class="flex items-start gap-3 text-base font-body text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-emerald-500 shrink-0 mt-1"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span class="leading-relaxed text-sm text-foreground/80">{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Excluded -->
                        @if(!empty($tour['excluded']))
                            <div class="p-8 rounded-3xl bg-red-500/5 border border-red-500/10 hover:border-red-500/20 transition-colors">
                                <h4 class="font-heading font-bold text-xl mb-6 text-red-800 dark:text-red-350 flex items-center gap-3">
                                    <div class="p-2 bg-red-500/10 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-red-600"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                                    </div>
                                    Not Included
                                </h4>
                                <div class="space-y-4">
                                    @foreach($tour['excluded'] as $item)
                                        <div class="flex items-start gap-3 text-base font-body text-muted-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 shrink-0 mt-1"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                            <span class="leading-relaxed text-sm text-foreground/80">{{ $item }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Itinerary -->
                    @if(!empty($tour['itinerary']))
                        <div class="space-y-6">
                            <h3 class="text-2xl font-heading font-bold text-foreground">Itinerary Timeline</h3>
                            
                            <div class="relative border-l border-border/80 pl-6 ml-4 space-y-8">
                                @foreach($tour['itinerary'] as $index => $step)
                                    <div class="relative">
                                        <!-- Point marker -->
                                        <div class="absolute -left-[35px] top-1.5 w-[18px] h-[18px] rounded-full border-2 border-primary bg-background flex items-center justify-center">
                                            <div class="w-2.5 h-2.5 rounded-full bg-primary"></div>
                                        </div>
                                        <div>
                                            <h4 class="font-heading font-bold text-lg text-foreground mb-1">
                                                {{ $step['time'] ?? 'Day ' . ($index + 1) }} - {{ $step['title'] ?? 'Destination' }}
                                            </h4>
                                            <p class="text-muted-foreground text-sm font-body leading-relaxed">{{ $step['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Cancellation Policy -->
                    @if(!empty($tour['cancellation_policy']))
                        <div class="p-6 bg-card border border-border/50 rounded-2xl space-y-3">
                            <h4 class="font-heading font-bold text-lg text-foreground flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                Cancellation Policy
                            </h4>
                            <p class="text-muted-foreground text-sm font-body leading-relaxed">{{ $tour['cancellation_policy'] }}</p>
                        </div>
                    @endif

                    <!-- FAQs Accordion -->
                    @if(!empty($tour['faq']))
                        <div class="space-y-4" x-data="{ activeFaq: null }">
                            <h3 class="text-2xl font-heading font-bold text-foreground">Frequently Asked Questions</h3>
                            
                            <div class="divide-y divide-border/60 border border-border/60 rounded-2xl overflow-hidden bg-card">
                                @foreach($tour['faq'] as $faqIndex => $item)
                                    <div class="p-5">
                                        <button 
                                            @click="activeFaq = activeFaq === {{ $faqIndex }} ? null : {{ $faqIndex }}"
                                            class="w-full flex items-center justify-between text-left font-semibold text-foreground hover:text-primary transition-colors focus:outline-none"
                                        >
                                            <span class="text-base font-heading">{{ $item['question'] ?? '' }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transform transition-transform duration-200" :class="activeFaq === {{ $faqIndex }} ? 'rotate-180 text-primary' : 'text-muted-foreground'"><polyline points="6 9 12 15 18 9"/></svg>
                                        </button>
                                        <div 
                                            x-show="activeFaq === {{ $faqIndex }}"
                                            x-collapse
                                            x-cloak
                                            class="mt-3 text-muted-foreground text-sm font-body leading-relaxed pl-1"
                                        >
                                            {{ $item['answer'] ?? '' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sticky Sidebar (Right Column - 1/3 width) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-28 bg-card border border-border/50 shadow-lg rounded-3xl p-6 sm:p-8 space-y-6">
                        
                        <div>
                            <span class="text-xs text-muted-foreground font-body font-semibold uppercase tracking-wider block mb-1">Starting Price</span>
                            <span class="text-card-foreground font-bold font-heading text-3xl">{{ $tour['price'] }}</span>
                        </div>
                        
                        <div class="h-px bg-border/50"></div>

                        <!-- Tour details recap -->
                        <div class="space-y-4 text-sm font-body">
                            <div class="flex items-center justify-between">
                                <span class="text-muted-foreground">Tour Duration</span>
                                <span class="font-semibold text-card-foreground">{{ $tour['duration'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-muted-foreground">Location</span>
                                <span class="font-semibold text-card-foreground">{{ $tour['location'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-muted-foreground">Category</span>
                                <span class="font-semibold text-card-foreground">{{ $tour['category'] }}</span>
                            </div>
                        </div>

                        <!-- CTA Actions -->
                        <div class="space-y-3 pt-4">
                            <button 
                                @click="$dispatch('open-booking-modal', { slug: '{{ $tour['slug'] }}' })"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-base transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 shadow-lg shadow-accent/20 px-8 py-3 w-full bg-accent hover:bg-accent/90 text-accent-foreground rounded-2xl font-body font-bold h-12"
                            >
                                Book This Tour
                            </button>
                            @php
                                $tourWaNumber = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '6281234567890'));
                            @endphp
                            <a href="https://wa.me/{{ $tourWaNumber }}?text={{ urlencode('Hi! I have a question about the ' . $tour['title']) }}" target="_blank" rel="noopener noreferrer" class="block w-full">
                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-base transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground hover:border-accent px-8 py-3 w-full rounded-2xl font-body font-bold h-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1 text-primary"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                    Ask via WhatsApp
                                </button>
                            </a>
                        </div>
                        
                        <p class="text-xs text-muted-foreground text-center font-body pt-2">
                            Need custom itinerary? Feel free to chat with us anytime.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Related Packages Section (At the bottom) -->
            @if(!empty($tour['related']))
                <div class="mt-16 pt-16 border-t border-border/50">
                    <h3 class="text-3xl font-heading font-bold text-foreground mb-8">Related Tour Packages</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tour['related'] as $relPackage)
                            <x-shared.tour-card 
                                :slug="$relPackage['slug']"
                                :image="$relPackage['image']"
                                :title="$relPackage['title']"
                                :category="$relPackage['category']"
                                :price="$relPackage['price']"
                                :description="$relPackage['description']"
                                :duration="$relPackage['duration']"
                            />
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
</div>
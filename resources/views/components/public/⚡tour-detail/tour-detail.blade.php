<div>
    <!-- Hero Image Header -->
    <div class="relative w-full h-[60vh] min-h-[500px]">
        <img src="{{ $tour['image'] }}" alt="{{ $tour['title'] }}" class="w-full h-full object-cover">
        <!-- Gradient to make text readable and blend with navbar -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/20 to-black/80"></div>
        
        <div class="absolute inset-0 flex items-end pb-12 pt-32">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="space-y-10">
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
                            <p class="font-semibold">{{ $tour['duration'] }}</p>
                        </div>
                    </span>
                    <div class="w-px h-10 bg-border/50 hidden sm:block"></div>
                    <span class="flex items-center gap-3">
                        <div class="p-2 bg-primary/10 rounded-lg">
                            <x-icons.map-pin class="w-5 h-5 text-primary" /> 
                        </div>
                        <div>
                            <p class="text-xs text-muted-foreground mb-0.5">Location</p>
                            <p class="font-semibold">{{ $tour['location'] }}</p>
                        </div>
                    </span>
                </div>

                <!-- Description -->
                <div class="prose prose-slate max-w-none">
                    <h3 class="text-2xl font-heading font-bold text-foreground mb-4">Tour Overview</h3>
                    <p class="text-muted-foreground font-body leading-relaxed text-lg">{{ $tour['description'] }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Highlights -->
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
                                    <x-icons.check class="w-6 h-6 text-secondary shrink-0 mt-0.5" /> 
                                    <span class="leading-relaxed">{{ $highlight }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Included -->
                    <div class="p-8 rounded-3xl bg-muted/30 border border-border/50 hover:border-primary/20 transition-colors">
                        <h4 class="font-heading font-bold text-xl mb-6 text-foreground flex items-center gap-3">
                            <div class="p-2 bg-primary/10 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-primary"><path d="m7.5 4.27 9 5.15"></path><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                            </div>
                            What's Included
                        </h4>
                        <div class="space-y-4">
                            @foreach($tour['included'] as $item)
                                <div class="flex items-start gap-3 text-base font-body text-muted-foreground">
                                    <x-icons.check class="w-6 h-6 text-primary shrink-0 mt-0.5" /> 
                                    <span class="leading-relaxed">{{ $item }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-10 mt-10 border-t border-border/50">
                    <a href="https://wa.me/6281234567890?text={{ urlencode('Hi! I\'d like to book the ' . $tour['title'] . '. Can you share more details?') }}" target="_blank" rel="noopener noreferrer" class="flex-1">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-lg transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 shadow-lg shadow-accent/20 px-8 py-4 w-full bg-accent hover:bg-accent/90 text-accent-foreground rounded-2xl font-body font-bold h-16">
                            Book This Tour
                        </button>
                    </a>
                    <a href="https://wa.me/6281234567890?text={{ urlencode('Hi! I have a question about the ' . $tour['title']) }}" target="_blank" rel="noopener noreferrer" class="flex-1">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-lg transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border-2 border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground hover:border-accent px-8 py-4 w-full rounded-2xl font-body font-bold h-16">
                            <x-icons.message-circle class="w-6 h-6 mr-1" /> Ask via WhatsApp
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<div>
    <section class="relative pt-32 pb-20 bg-primary overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1573790387438-4da905039392?w=1600&amp;q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div style="opacity: 1; transform: none;">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Bali Tour Packages</h1>
                <p class="text-lg text-white/70 font-body max-w-2xl mx-auto leading-relaxed">Discover our collection of private, flexible tours designed for every type of traveler.</p>
            </div>
        </div>
    </section>
    <!-- Search & Filter -->
    <section class="py-8 bg-card border-b border-border sticky top-16 md:top-20 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="relative flex-1 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                    <input class="flex w-full border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm pl-10 rounded-xl font-body h-11" placeholder="Search tour packages..." value="">
                </div>
                <div class="flex gap-2 overflow-x-auto pb-1 w-full md:w-auto">
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow hover:bg-primary/90 h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs bg-primary text-primary-foreground">All Tours</button>
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs">Cultural Tours</button>
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs">Nature Tours</button>
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs">Adventure Tours</button>
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs">Island Tours</button>
                    <button class="inline-flex items-center justify-center gap-2 font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-8 px-3 rounded-xl font-body whitespace-nowrap text-xs">Honeymoon Tours</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-12 bg-muted/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages as $package)
                    <x-shared.tour-card 
                        :image="$package['image']"
                        :title="$package['title']"
                        :category="$package['category']"
                        :price="$package['price']"
                        :description="$package['description']"
                        :duration="$package['duration']"
                    />
                @endforeach
            </div>
        </div>
    </section>
</div>
@props([
    'image', 
    'title', 
    'category', 
    'price', 
    'description', 
    'duration', 
    'location' => 'Bali'
])

<div class="group bg-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-border/50 transition-all duration-300" style="opacity: 1; transform: none;">
    <div class="relative h-52 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        <div class="inline-flex items-center rounded-md border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent shadow hover:bg-primary/80 absolute top-4 left-4 bg-primary/90 text-primary-foreground font-body text-xs">{{ $category }}</div>
        <div class="absolute bottom-4 right-4 bg-accent text-accent-foreground px-3 py-1 rounded-lg font-body font-bold text-sm">{{ $price }}</div>
    </div>
    <div class="p-5">
        <h3 class="font-heading font-bold text-lg text-foreground mb-2 group-hover:text-primary transition-colors">{{ $title }}</h3>
        <p class="text-sm text-muted-foreground font-body leading-relaxed mb-4 line-clamp-2">{{ $description }}</p>
        <div class="flex items-center gap-4 text-xs text-muted-foreground mb-4 font-body">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-3.5 h-3.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                {{ $duration }}
            </span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin w-3.5 h-3.5"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                {{ $location }}
            </span>
        </div>
        <div class="flex gap-2">
            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 flex-1 rounded-xl font-body text-sm">View Details</button>
            <a href="https://wa.me/6281234567890?text={{ urlencode('Hi! I\'m interested in the ' . $title) }}" target="_blank" rel="noopener noreferrer" class="flex-1">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow h-9 px-4 py-2 w-full bg-accent hover:bg-accent/90 text-accent-foreground rounded-xl font-body text-sm">Book Now</button>
            </a>
        </div>
    </div>
</div>

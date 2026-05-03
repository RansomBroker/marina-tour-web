@props(['image', 'category', 'date', 'author' => 'Smith Bali Travel', 'title', 'description', 'slug'])

<div class="group bg-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-border/50 transition-all duration-300" style="opacity: 1; transform: none;">
    <div class="relative h-48 overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        <div class="inline-flex items-center rounded-md border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent shadow hover:bg-primary/80 absolute top-4 left-4 bg-secondary/90 text-secondary-foreground font-body text-xs">{{ $category }}</div>
    </div>
    <div class="p-5">
        <div class="flex items-center gap-4 text-xs text-muted-foreground font-body mb-3">
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>{{ $date }}
            </span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-3 h-3"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>{{ $author }}
            </span>
        </div>
        <h3 class="font-heading font-bold text-base text-foreground mb-2 group-hover:text-primary transition-colors line-clamp-2">{{ $title }}</h3>
        <p class="text-sm text-muted-foreground font-body leading-relaxed mb-4 line-clamp-2">{{ $description }}</p>
        <a class="inline-flex items-center gap-1.5 text-sm font-semibold font-body text-primary hover:text-accent transition-colors" href="/blogs/detail/{{ $slug }}">Read More
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
        </a>
    </div>
</div>

<div>
    <section class="relative pt-24 pb-16">
        <div class="absolute inset-0 h-96">
            <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-background"></div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-32">
            <a class="inline-flex items-center gap-1.5 text-sm text-white/70 hover:text-white font-body mb-6 transition-colors" href="/blogs">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4"><path d="m12 19-7-7 7-7"></path><path d="M19 12H5"></path></svg> 
                Back to Blog
            </a>
            <div class="inline-flex items-center rounded-md border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent shadow hover:bg-primary/80 bg-secondary/90 text-secondary-foreground font-body text-xs mb-4">
                {{ $blog['category'] }}
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">{{ $blog['title'] }}</h1>
            <div class="flex items-center gap-4 text-sm text-white/60 font-body">
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> 
                    Smith Bali Travel
                </span>
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 
                    {{ $blog['date'] }}
                </span>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="prose prose-lg max-w-none font-body prose-headings:font-heading prose-headings:text-foreground prose-p:text-muted-foreground prose-p:leading-relaxed prose-a:text-primary prose-strong:text-foreground prose-li:text-muted-foreground">
                {!! $blog['content'] !!}
            </article>

            <div class="mt-12 p-8 bg-primary/5 border border-primary/10 rounded-2xl text-center">
                <h3 class="text-xl font-heading font-bold text-foreground mb-2">Need Help Planning Your Bali Trip?</h3>
                <p class="text-muted-foreground font-body mb-6">Contact Smith Bali Travel and let our experts create the perfect itinerary for you.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 shadow h-9 px-4 py-2 bg-accent hover:bg-accent/90 text-accent-foreground rounded-xl font-body font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-4 h-4 mr-2"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path></svg> 
                            Chat on WhatsApp
                        </button>
                    </a>
                    <a href="/contact-us">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 rounded-xl font-body font-semibold">
                            Contact Us
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-heading font-bold text-foreground text-center mb-10">More Articles You Might Like</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedBlogs as $related)
                <div class="group bg-card rounded-2xl overflow-hidden shadow-sm hover:shadow-xl border border-border/50 transition-all duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $related['image'] }}" alt="{{ $related['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="inline-flex items-center rounded-md border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent shadow hover:bg-primary/80 absolute top-4 left-4 bg-secondary/90 text-secondary-foreground font-body text-xs">
                            {{ $related['category'] }}
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-4 text-xs text-muted-foreground font-body mb-3">
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                                {{ $related['date'] }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-3 h-3"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Smith Bali Travel
                            </span>
                        </div>
                        <h3 class="font-heading font-bold text-base text-foreground mb-2 group-hover:text-primary transition-colors line-clamp-2">{{ $related['title'] }}</h3>
                        <p class="text-sm text-muted-foreground font-body leading-relaxed mb-4 line-clamp-2">{{ $related['description'] }}</p>
                        <a class="inline-flex items-center gap-1.5 text-sm font-semibold font-body text-primary hover:text-accent transition-colors" href="/blogs/detail/{{ $related['slug'] }}">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
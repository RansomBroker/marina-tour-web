<div>
    <section class="relative pt-32 pb-20 bg-primary overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600&amp;q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div style="opacity: 1; transform: none;">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Bali Travel Blog</h1>
                <p class="text-lg text-white/70 font-body max-w-2xl mx-auto leading-relaxed">Travel tips, destination guides, and inspiration for your Bali holiday.</p>
            </div>
        </div>
    </section>
    <section class="py-16 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($blogs as $blog)
                    <x-shared.blog-card 
                        :image="$blog['image']"
                        :category="$blog['category']"
                        :date="$blog['date']"
                        :title="$blog['title']"
                        :description="$blog['description']"
                        :url="$blog['url']"
                    />
                @endforeach
            </div>
        </div>
    </section>
</div>
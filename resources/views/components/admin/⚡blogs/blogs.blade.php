<div class="space-y-8">
    <!-- Header Summary Stats Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Total Blog Posts -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Total Articles</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-foreground">{{ \App\Models\Blog::count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/></svg>
            </div>
        </div>

        <!-- Latest Article Date -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Latest Update</span>
                <h3 class="text-lg font-bold font-heading mt-1.5 text-green-500">
                    {{ \App\Models\Blog::latest()->first()?->created_at?->format('M d, Y') ?? 'No articles yet' }}
                </h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            </div>
        </div>

        <!-- Add Button -->
        <div class="p-4 bg-muted/20 border border-dashed border-border rounded-3xl flex items-center justify-center">
            <a 
                href="{{ route('admin.blogs.create') }}" 
                class="inline-flex items-center justify-center gap-2 px-6 h-12 bg-primary hover:bg-primary/90 text-white font-body font-semibold text-sm rounded-2xl transition-all shadow-lg shadow-primary/15 w-full text-center"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                Write New Article
            </a>
        </div>
    </div>

    <!-- Filters and Table Container -->
    <div class="bg-card border border-border/60 shadow-lg rounded-3xl overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-border/50 flex flex-col md:flex-row gap-4 items-center justify-between">
            <h2 class="text-xl font-bold font-heading text-foreground w-full md:w-auto">Manage Blog Articles</h2>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto items-center">
                <!-- Search input -->
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10 pl-9"
                        placeholder="Search articles, content..."
                    >
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-muted/40 border-b border-border/50">
                        <th class="p-4 px-6 sm:px-8 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Article</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Category</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">URL Slug</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Date Published</th>
                        <th class="p-4 px-6 sm:px-8 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse ($blogs as $blog)
                        <tr class="hover:bg-muted/10 transition-colors">
                            <td class="p-4 px-6 sm:px-8 align-middle">
                                <div class="flex items-center gap-3">
                                    <!-- Image Thumbnail -->
                                    <div class="w-12 h-12 rounded-xl bg-muted overflow-hidden border border-border/60 shrink-0">
                                        @if($blog->image)
                                            <img src="{{ str_starts_with($blog->image, 'http') ? $blog->image : asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-muted-foreground/60 text-[9px] uppercase font-bold">No Pic</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-body font-semibold text-sm text-foreground line-clamp-1 max-w-[280px]">{{ $blog->title }}</div>
                                        <div class="font-body text-xs text-muted-foreground mt-0.5 line-clamp-1 max-w-[280px]">{{ $blog->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="inline-block font-heading font-semibold text-xs text-primary bg-primary/10 px-2.5 py-1 rounded-full">
                                    {{ $blog->category ?? 'General' }}
                                </span>
                            </td>
                            <td class="p-4 align-middle font-mono text-xs text-muted-foreground max-w-[150px] truncate">
                                {{ $blog->slug }}
                            </td>
                            <td class="p-4 align-middle font-body text-xs text-foreground">
                                {{ $blog->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="p-4 px-6 sm:px-8 align-middle text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Link Page -->
                                    <a 
                                        href="{{ route('admin.blogs.edit', $blog->id) }}" 
                                        class="px-3 py-1.5 bg-muted hover:bg-primary/10 text-muted-foreground hover:text-primary rounded-lg text-xs font-semibold transition-all inline-block"
                                        title="Edit Article"
                                    >
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <button 
                                        wire:click="deleteBlog({{ $blog->id }})" 
                                        onclick="confirm('Are you sure you want to delete this article? This action is permanent.') || event.stopImmediatePropagation()"
                                        class="px-3 py-1.5 bg-muted hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-lg text-xs font-semibold transition-all"
                                        title="Delete Article"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-muted-foreground font-body text-sm">
                                No articles found. Click "Write New Article" to add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-border/50 bg-muted/20">
            {{ $blogs->links() }}
        </div>
    </div>
</div>

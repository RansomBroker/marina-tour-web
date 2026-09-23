<div class="space-y-8" x-data="{ activeTab: 'general' }">
    <!-- Header Area -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="space-y-1">
            <a href="{{ route('admin.blogs') }}" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-muted-foreground hover:text-foreground font-body transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Back to Articles
            </a>
            <h1 class="text-2xl sm:text-3xl font-bold font-heading tracking-tight text-foreground">
                {{ $isEditMode ? 'Edit Blog Article' : 'Write New Article' }}
            </h1>
            <p class="text-sm text-muted-foreground font-body">Create or update premium guides and travel tips for Smith Travel Bali.</p>
        </div>
    </div>

    <!-- Main Form Page Wrapper -->
    <div class="bg-card border border-border/60 shadow-lg rounded-3xl overflow-hidden">
        <!-- Tabs Navigation -->
        <div class="px-6 border-b border-border/50 flex gap-4 text-sm font-semibold font-body bg-muted/20">
            <button 
                type="button" 
                @click="activeTab = 'general'" 
                class="py-4 border-b-2 transition-all focus:outline-none" 
                :class="activeTab === 'general' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground'"
            >
                General Content
            </button>
            <button 
                type="button" 
                @click="activeTab = 'seo'" 
                class="py-4 border-b-2 transition-all focus:outline-none" 
                :class="activeTab === 'seo' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground'"
            >
                SEO Settings
            </button>
        </div>

        <form wire:submit.prevent="save">
            <div class="p-6 sm:p-8 space-y-6">
                
                <!-- TAB 1: GENERAL CONTENT -->
                <div x-show="activeTab === 'general'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">Title *</label>
                            <input 
                                type="text" 
                                wire:model.blur="title"
                                class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                                placeholder="e.g. 5 Must-Try Restaurants in Seminyak"
                                required
                            >
                            @error('title') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">Category</label>
                            <input 
                                type="text" 
                                wire:model="category"
                                class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                                placeholder="e.g. Travel Tips, Food & Dining"
                            >
                            @error('category') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Slug -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">URL Slug *</label>
                        <input 
                            type="text" 
                            wire:model="slug"
                            class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-mono text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                            placeholder="e.g. 5-must-try-seminyak-restaurants"
                            required
                        >
                        @error('slug') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                    </div>

                    <!-- Brief Description -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">Brief Description / Excerpt</label>
                        <textarea 
                            wire:model.blur="description" 
                            rows="2"
                            class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                            placeholder="Write a short summary that will show on the blog listing page..."
                        ></textarea>
                        @error('description') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">Thumbnail Image</label>
                        
                        <!-- File input placeholder -->
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border/80 rounded-2xl cursor-pointer bg-muted/20 hover:bg-muted/30 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <svg class="w-8 h-8 mb-2 text-muted-foreground/60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="text-xs text-muted-foreground"><span class="font-semibold">Click to upload image</span> or drag & drop</p>
                                    <p class="text-[10px] text-muted-foreground/60 mt-1">PNG, JPG, JPEG (Max 5MB)</p>
                                </div>
                                <input type="file" wire:model="newImage" class="hidden">
                            </label>
                        </div>
                        @error('newImage') <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p> @enderror

                        <!-- Preview -->
                        @if($newImage)
                            <div class="mt-2">
                                <span class="text-xs font-body font-semibold text-muted-foreground block mb-2">New Image Preview:</span>
                                <div class="relative w-48 h-32 rounded-xl overflow-hidden border border-border/85">
                                    <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @elseif($image)
                            <div class="mt-2">
                                <span class="text-xs font-body font-semibold text-muted-foreground block mb-2">Current Image:</span>
                                <div class="relative w-48 h-32 rounded-xl overflow-hidden border border-border/85">
                                    <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- TinyMCE Rich Content Container -->
                    <div class="space-y-1.5" wire:ignore>
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">Article Content *</label>
                        <textarea 
                            id="blog-editor"
                            class="w-full min-h-96"
                        ></textarea>
                    </div>
                    @error('content') <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p> @enderror
                </div>

                <!-- TAB 2: SEO SETTINGS -->
                <div x-show="activeTab === 'seo'" class="space-y-6">
                    <!-- Meta Title -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">SEO Meta Title</label>
                        <input 
                            type="text" 
                            wire:model="meta_title"
                            class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" 
                            placeholder="Recommended: under 60 characters"
                        >
                        @error('meta_title') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold font-body text-muted-foreground uppercase tracking-wider">SEO Meta Description</label>
                        <textarea 
                            wire:model="meta_description" 
                            rows="4"
                            class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all leading-relaxed" 
                            placeholder="Recommended: 150-160 characters describing the article content."
                        ></textarea>
                        @error('meta_description') <p class="text-xs font-semibold text-destructive mt-1 font-body">{{ $message }}</p> @enderror
                    </div>
                </div>

            </div>

            <!-- Footer actions -->
            <div class="p-6 border-t border-border/50 flex justify-end gap-3 bg-muted/20">
                <a 
                    href="{{ route('admin.blogs') }}"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-12 px-6 rounded-2xl font-body text-sm font-medium"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-white shadow-lg shadow-primary/15 h-12 px-8 rounded-2xl font-body text-sm font-semibold"
                >
                    Save Article
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        initTinyMCE();
    });

    document.addEventListener("livewire:navigated", () => {
        initTinyMCE();
    });

    function initTinyMCE() {
        if (!document.getElementById('blog-editor')) return;
        
        if (tinymce.get('blog-editor')) {
            tinymce.get('blog-editor').remove();
        }

        tinymce.init({
            selector: '#blog-editor',
            height: 500,
            skin: document.documentElement.classList.contains('dark') ? 'oxide-dark' : 'oxide',
            content_css: document.documentElement.classList.contains('dark') ? 'dark' : 'default',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code fullscreen',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(@this.get('content') || '');
                });
                editor.on('change', function () {
                    @this.set('content', editor.getContent());
                });
                editor.on('blur', function () {
                    @this.set('content', editor.getContent());
                });
            }
        });
    }
</script>
@endpush

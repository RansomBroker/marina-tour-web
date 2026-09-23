<div class="space-y-8">
    <!-- Header Area -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold font-heading tracking-tight">Tour Categories</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Manage parent categories for your travel packages.</p>
        </div>
        <button wire:click="openCreateModal" class="inline-flex items-center justify-center gap-2 px-5 h-12 bg-primary hover:bg-primary/90 text-white font-body font-semibold text-sm rounded-xl transition-all shadow-lg shadow-primary/15 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
            Add Category
        </button>
    </div>

    <!-- Content Table / Card -->
    <div class="bg-card rounded-3xl border border-border/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-muted/20 border-b border-border/60 text-muted-foreground font-body text-[11px] font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 sm:px-8">Category Name</th>
                        <th class="py-4 px-6">URL Slug</th>
                        <th class="py-4 px-6">Description</th>
                        <th class="py-4 px-6">Created At</th>
                        <th class="py-4 px-6 sm:px-8 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/60 text-sm font-body text-foreground">
                    @forelse($categories as $category)
                        <tr class="hover:bg-muted/15 transition-all">
                            <td class="py-4 px-6 sm:px-8">
                                <div class="font-semibold text-foreground">{{ $category->name }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <code class="px-2 py-1 bg-muted/60 text-muted-foreground rounded text-xs font-mono">{{ $category->slug }}</code>
                            </td>
                            <td class="py-4 px-6 text-muted-foreground max-w-xs truncate">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-muted-foreground">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 sm:px-8 text-right space-x-1">
                                <button wire:click="openEditModal({{ $category->id }})" class="px-3 py-1.5 bg-muted/60 hover:bg-primary/10 text-muted-foreground hover:text-primary rounded-lg text-xs font-semibold transition-all">
                                    Edit
                                </button>
                                <button 
                                    wire:click="confirmDelete({{ $category->id }})" 
                                    class="px-3 py-1.5 bg-muted/60 hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-lg text-xs font-semibold transition-all"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-muted-foreground">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground/60"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                                    <span class="font-semibold text-sm">No categories found</span>
                                    <span class="text-xs text-muted-foreground/80">Click the button above to add your first tour category.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form (Create / Edit) -->
    <div x-data="{ open: @entangle('isModalOpen') }" x-show="open" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" 
             wire:click="closeModal"></div>

        <!-- Modal Content -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="relative bg-card border border-border/60 rounded-3xl max-w-lg w-full p-8 shadow-2xl overflow-hidden transition-all z-10">
            <h3 class="text-xl font-bold font-heading mb-6">
                {{ $editingCategoryId ? 'Edit Category' : 'Create New Category' }}
            </h3>

            <form wire:submit.prevent="save" class="space-y-6">
                <x-shared.input.text 
                    id="name" 
                    name="name" 
                    label="Category Name" 
                    placeholder="e.g. Adventure Tours" 
                    wire:model.live="name" 
                    required 
                />

                <x-shared.input.text 
                    id="slug" 
                    name="slug" 
                    label="URL Slug" 
                    placeholder="e.g. adventure-tours" 
                    wire:model="slug" 
                    required 
                />

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-semibold font-body text-muted-foreground">
                        Description
                    </label>
                    <textarea 
                        id="description" 
                        wire:model="description"
                        rows="3"
                        class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground placeholder-muted-foreground/50 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200"
                        placeholder="Short description of this category..."
                    ></textarea>
                    @error('description')
                        <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" wire:click="closeModal" class="px-5 py-2.5 rounded-xl border border-border/80 text-muted-foreground hover:bg-muted/40 font-body text-sm font-semibold transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white hover:bg-primary/95 font-body text-sm font-semibold transition-all shadow-md shadow-primary/15">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <x-shared.modal.confirm 
        :type="$confirmType" 
        :title="$confirmTitle" 
        :message="$confirmMessage" 
        :confirmAction="$confirmActionMethod" 
        cancelAction="closeConfirmModal" 
    />
</div>

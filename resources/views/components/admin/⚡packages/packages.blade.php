<div class="space-y-8" x-data="{ activeTab: 'general' }">
    <!-- Header Area -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold font-heading tracking-tight">Tour Packages</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Create and manage your premium Bali travel packages.</p>
        </div>
        <button wire:click="openCreateModal" @click="activeTab = 'general'" class="inline-flex items-center justify-center gap-2 px-5 h-12 bg-primary hover:bg-primary/90 text-white font-body font-semibold text-sm rounded-xl transition-all shadow-lg shadow-primary/15 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
            Add Package
        </button>
    </div>

    <!-- Content Table / Card -->
    <div class="bg-card rounded-3xl border border-border/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-muted/20 border-b border-border/60 text-muted-foreground font-body text-[11px] font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 sm:px-8">Package / Category</th>
                        <th class="py-4 px-6">Price</th>
                        <th class="py-4 px-6">Duration</th>
                        <th class="py-4 px-6">Created At</th>
                        <th class="py-4 px-6 sm:px-8 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/60 text-sm font-body text-foreground">
                    @forelse($packages as $package)
                        <tr class="hover:bg-muted/15 transition-all">
                            <td class="py-4 px-6 sm:px-8">
                                <div class="flex items-center gap-3">
                                    <!-- Image Thumbnail -->
                                    <div class="w-12 h-12 rounded-xl bg-muted overflow-hidden border border-border/60 shrink-0">
                                        @if(!empty($package->images))
                                            <img src="{{ asset('storage/' . $package->images[0]) }}" alt="{{ $package->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-muted-foreground/60 text-[10px] uppercase font-bold">No Pic</div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-semibold text-foreground line-clamp-1">{{ $package->name }}</div>
                                        <div class="text-xs text-muted-foreground/90 mt-0.5">{{ $package->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-semibold">
                                IDR {{ number_format($package->price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-muted-foreground">
                                {{ $package->duration }}
                            </td>
                            <td class="py-4 px-6 text-muted-foreground">
                                {{ $package->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-6 sm:px-8 text-right space-x-1">
                                <button wire:click="openEditModal({{ $package->id }})" @click="activeTab = 'general'" class="px-3 py-1.5 bg-muted/60 hover:bg-primary/10 text-muted-foreground hover:text-primary rounded-lg text-xs font-semibold transition-all">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $package->id }})" class="px-3 py-1.5 bg-muted/60 hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-lg text-xs font-semibold transition-all">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-muted-foreground">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground/60"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                                    <span class="font-semibold text-sm">No packages found</span>
                                    <span class="text-xs text-muted-foreground/80">Click the button above to add your first tour package.</span>
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
             class="relative bg-card border border-border/60 rounded-3xl max-w-4xl w-full p-8 shadow-2xl overflow-hidden transition-all z-10 flex flex-col max-h-[85vh]">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-border/60 shrink-0">
                <h3 class="text-xl font-bold font-heading">
                    {{ $editingPackageId ? 'Edit Tour Package' : 'Create Tour Package' }}
                </h3>
                <button wire:click="closeModal" class="text-muted-foreground hover:text-foreground transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                </button>
            </div>

            <!-- Tabs Navigation -->
            <div class="flex border-b border-border/60 mt-4 shrink-0 font-body text-sm font-semibold overflow-x-auto gap-2">
                <button type="button" @click="activeTab = 'general'" :class="activeTab === 'general' ? 'border-primary text-primary border-b-2 px-4 py-2' : 'text-muted-foreground px-4 py-2 hover:text-foreground'">
                    General Information
                </button>
                <button type="button" @click="activeTab = 'details'" :class="activeTab === 'details' ? 'border-primary text-primary border-b-2 px-4 py-2' : 'text-muted-foreground px-4 py-2 hover:text-foreground'">
                    Package Details
                </button>
                <button type="button" @click="activeTab = 'itinerary'" :class="activeTab === 'itinerary' ? 'border-primary text-primary border-b-2 px-4 py-2' : 'text-muted-foreground px-4 py-2 hover:text-foreground'">
                    Itinerary
                </button>
                <button type="button" @click="activeTab = 'faq-related'" :class="activeTab === 'faq-related' ? 'border-primary text-primary border-b-2 px-4 py-2' : 'text-muted-foreground px-4 py-2 hover:text-foreground'">
                    FAQs & Related
                </button>
            </div>

            <!-- Form Content (Scrollable) -->
            <form wire:submit.prevent="save" class="flex-1 overflow-y-auto mt-6 pr-2 space-y-6">
                
                <!-- General Information Tab -->
                <div x-show="activeTab === 'general'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-shared.input.text 
                            id="name" 
                            name="name" 
                            label="Package Name" 
                            placeholder="e.g. Nusa Penida Day Cruise" 
                            wire:model.live="name" 
                            required 
                        />
                        <x-shared.input.text 
                            id="slug" 
                            name="slug" 
                            label="URL Slug" 
                            placeholder="e.g. nusa-penida-day-cruise" 
                            wire:model="slug" 
                            required 
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="tour_category_id" class="block text-sm font-semibold font-body text-muted-foreground mb-2">Category</label>
                            <select id="tour_category_id" wire:model="tour_category_id" class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('tour_category_id')
                                <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-shared.input.text 
                            id="price" 
                            name="price" 
                            label="Price (IDR)" 
                            type="number" 
                            placeholder="e.g. 1500000" 
                            wire:model="price" 
                            required 
                        />

                        <x-shared.input.text 
                            id="duration" 
                            name="duration" 
                            label="Duration" 
                            placeholder="e.g. 3 Days 2 Nights" 
                            wire:model="duration" 
                            required 
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-semibold font-body text-muted-foreground">Description</label>
                        <textarea id="description" wire:model="description" rows="4" class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Tell the customer about the package..."></textarea>
                        @error('description')
                            <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Images Upload / Gallery -->
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold font-body text-muted-foreground">Photo Gallery</label>
                        
                        <!-- File Input -->
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-border/80 rounded-2xl cursor-pointer bg-muted/20 hover:bg-muted/30 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-muted-foreground/60" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="text-xs text-muted-foreground"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-[10px] text-muted-foreground/60 mt-1">PNG, JPG, JPEG (Max 5MB per image)</p>
                                </div>
                                <input type="file" wire:model="newImages" multiple class="hidden">
                            </label>
                        </div>
                        @error('newImages.*')
                            <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
                        @enderror

                        <!-- Preview Grid -->
                        @if(!empty($existingImages) || !empty($newImages))
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4 mt-3">
                                <!-- Existing Images -->
                                @foreach($existingImages as $k => $img)
                                    <div class="relative group aspect-square rounded-xl overflow-hidden border border-border/80">
                                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                        <button type="button" wire:click="removeExistingImage({{ $k }})" class="absolute top-2 right-2 bg-destructive text-white p-1 rounded-lg opacity-0 group-hover:opacity-100 transition-all hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                        </button>
                                    </div>
                                @endforeach

                                <!-- Temporary Previews -->
                                @foreach($newImages as $img)
                                    @if($img->temporaryUrl())
                                        <div class="relative aspect-square rounded-xl overflow-hidden border border-border/80 opacity-70">
                                            <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Package Details Tab -->
                <div x-show="activeTab === 'details'" class="space-y-6">
                    <!-- Highlights -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-semibold font-body text-muted-foreground">Highlights</label>
                            <button type="button" wire:click="addHighlight" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                                Add Highlight
                            </button>
                        </div>
                        <div class="space-y-3">
                            @foreach($highlights as $k => $highlight)
                                <div class="flex items-center gap-3">
                                    <input type="text" wire:model="highlights.{{ $k }}" class="flex-1 px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="e.g. Private sunset boat deck viewing">
                                    <button type="button" wire:click="removeHighlight({{ $k }})" class="p-2.5 bg-muted hover:bg-destructive/15 text-muted-foreground hover:text-destructive rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Included / Excluded Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Included -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-semibold font-body text-muted-foreground">Included</label>
                                <button type="button" wire:click="addIncluded" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                                    Add Included
                                </button>
                            </div>
                            <div class="space-y-3">
                                @foreach($included as $k => $inc)
                                    <div class="flex items-center gap-3">
                                        <input type="text" wire:model="included.{{ $k }}" class="flex-1 px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="e.g. Free mineral water">
                                        <button type="button" wire:click="removeIncluded({{ $k }})" class="p-2.5 bg-muted hover:bg-destructive/15 text-muted-foreground hover:text-destructive rounded-xl transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Excluded -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-semibold font-body text-muted-foreground">Excluded</label>
                                <button type="button" wire:click="addExcluded" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                                    Add Excluded
                                </button>
                            </div>
                            <div class="space-y-3">
                                @foreach($excluded as $k => $exc)
                                    <div class="flex items-center gap-3">
                                        <input type="text" wire:model="excluded.{{ $k }}" class="flex-1 px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="e.g. Tips for guide">
                                        <button type="button" wire:click="removeExcluded({{ $k }})" class="p-2.5 bg-muted hover:bg-destructive/15 text-muted-foreground hover:text-destructive rounded-xl transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- What to Bring -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-semibold font-body text-muted-foreground">What to Bring</label>
                            <button type="button" wire:click="addWhatToBring" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                                Add Item
                            </button>
                        </div>
                        <div class="space-y-3">
                            @foreach($what_to_bring as $k => $bring)
                                <div class="flex items-center gap-3">
                                    <input type="text" wire:model="what_to_bring.{{ $k }}" class="flex-1 px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="e.g. Sunscreen, camera">
                                    <button type="button" wire:click="removeWhatToBring({{ $k }})" class="p-2.5 bg-muted hover:bg-destructive/15 text-muted-foreground hover:text-destructive rounded-xl transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Cancellation Policy -->
                    <div class="space-y-2">
                        <label for="cancellation_policy" class="block text-sm font-semibold font-body text-muted-foreground">Cancellation Policy</label>
                        <textarea id="cancellation_policy" wire:model="cancellation_policy" rows="3" class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="e.g. Free cancellation up to 24 hours in advance."></textarea>
                        @error('cancellation_policy')
                            <p class="text-xs font-semibold text-destructive mt-1 font-body block">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Itinerary Tab -->
                <div x-show="activeTab === 'itinerary'" class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-semibold font-body text-muted-foreground">Package Day Itinerary</h4>
                        <button type="button" wire:click="addItinerary" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1 bg-muted px-3 py-1.5 rounded-xl hover:bg-primary/10 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                            Add Day
                        </button>
                    </div>

                    <div class="space-y-6">
                        @foreach($itinerary as $k => $day)
                            <div class="p-6 bg-muted/20 border border-border/60 rounded-3xl space-y-4 relative">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs uppercase font-bold text-muted-foreground/80 tracking-wider">Day {{ $day['day'] }}</span>
                                    <button type="button" wire:click="removeItinerary({{ $k }})" class="text-xs text-destructive hover:underline font-semibold">
                                        Remove Day
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <!-- Day Title -->
                                    <div class="md:col-span-1">
                                        <x-shared.input.text 
                                            id="itinerary.{{ $k }}.title" 
                                            name="itinerary.{{ $k }}.title" 
                                            label="Day Title" 
                                            placeholder="e.g. Arrival & Beach Sunset" 
                                            wire:model="itinerary.{{ $k }}.title" 
                                            required 
                                        />
                                    </div>
                                    <!-- Day Description -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold font-body text-muted-foreground mb-2">Activities Description</label>
                                        <textarea wire:model="itinerary.{{ $k }}.description" rows="2" class="w-full px-4 py-3 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="Explain this day's destinations and schedule details..."></textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- FAQs & Related Tab -->
                <div x-show="activeTab === 'faq-related'" class="space-y-6">
                    <!-- FAQ List -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-semibold font-body text-muted-foreground">Frequently Asked Questions (FAQ)</label>
                            <button type="button" wire:click="addFaq" class="text-xs font-semibold text-primary hover:text-primary/95 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                                Add FAQ
                            </button>
                        </div>
                        <div class="space-y-4">
                            @foreach($faq as $k => $f)
                                <div class="p-6 bg-muted/20 border border-border/60 rounded-3xl space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs uppercase font-bold text-muted-foreground/85">FAQ Item #{{ $k + 1 }}</span>
                                        <button type="button" wire:click="removeFaq({{ $k }})" class="text-xs text-destructive hover:underline font-semibold">Remove FAQ</button>
                                    </div>
                                    <div class="space-y-3">
                                        <input type="text" wire:model="faq.{{ $k }}.question" class="w-full px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="Question">
                                        <textarea wire:model="faq.{{ $k }}.answer" rows="2" class="w-full px-4 py-2.5 bg-muted/40 border border-border/85 rounded-xl font-body text-sm text-foreground focus:outline-none" placeholder="Answer"></textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Related Packages -->
                    <div class="space-y-4 pt-4 border-t border-border/60">
                        <label class="block text-sm font-semibold font-body text-muted-foreground">Related Packages</label>
                        <p class="text-xs text-muted-foreground/80 mt-1">Select other packages to recommend alongside this tour.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-3 max-h-48 overflow-y-auto pr-2">
                            @foreach($packages as $p)
                                @if($p->id !== $editingPackageId)
                                    <label class="flex items-center gap-3 p-3 bg-muted/20 hover:bg-muted/40 border border-border/60 rounded-xl cursor-pointer transition-all">
                                        <input type="checkbox" wire:model="selectedRelatedPackages" value="{{ $p->id }}" class="w-4 h-4 rounded text-primary focus:ring-primary/20 border-border/85">
                                        <span class="text-sm font-body font-semibold truncate">{{ $p->name }}</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            </form>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-4 border-t border-border/60 shrink-0 mt-6">
                <button type="button" wire:click="closeModal" class="px-5 py-2.5 rounded-xl border border-border/80 text-muted-foreground hover:bg-muted/40 font-body text-sm font-semibold transition-all">
                    Cancel
                </button>
                <button type="button" wire:click="save" class="px-6 py-2.5 rounded-xl bg-primary text-white hover:bg-primary/95 font-body text-sm font-semibold transition-all shadow-md shadow-primary/15">
                    Save Package
                </button>
            </div>
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

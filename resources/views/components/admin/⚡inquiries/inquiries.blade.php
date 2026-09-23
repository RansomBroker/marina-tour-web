<div class="space-y-8">
    <!-- Header Summary Stats Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Total Inquiries -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Total Inquiries</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-foreground">{{ \App\Models\Inquiry::count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
        </div>

        <!-- Today Inquiries -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Today's Inquiries</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-green-500">{{ \App\Models\Inquiry::whereDate('created_at', \Carbon\Carbon::today())->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            </div>
        </div>

        <!-- This Month Inquiries -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">This Month</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-primary">{{ \App\Models\Inquiry::whereMonth('created_at', \Carbon\Carbon::now()->month)->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
        </div>
    </div>

    <!-- Filters and Table Container -->
    <div class="bg-card border border-border/60 shadow-lg rounded-3xl overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-border/50 flex flex-col md:flex-row gap-4 items-center justify-between">
            <h2 class="text-xl font-bold font-heading text-foreground w-full md:w-auto">Manage Inquiries</h2>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto items-center">
                <!-- Search input -->
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10 pl-9"
                        placeholder="Search name, message, package..."
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
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">ID</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Customer Details</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Package</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground font-body">Message Brief</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Date Received</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse ($inquiries as $inquiry)
                        <tr class="hover:bg-muted/10 transition-colors">
                            <td class="p-4 align-middle font-body font-bold text-sm text-foreground">
                                #{{ $inquiry->id }}
                            </td>
                            <td class="p-4 align-middle">
                                <div class="font-body font-semibold text-sm text-foreground">{{ $inquiry->name }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $inquiry->email }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $inquiry->whatsapp_number }}</div>
                            </td>
                            <td class="p-4 align-middle">
                                <span class="max-w-[180px] block truncate font-heading font-semibold text-xs text-primary bg-primary/10 px-2 py-1 rounded-md">
                                    {{ $inquiry->package->name ?? 'General Inquiry' }}
                                </span>
                            </td>
                            <td class="p-4 align-middle font-body text-sm text-muted-foreground max-w-[250px] truncate">
                                {{ $inquiry->message }}
                            </td>
                            <td class="p-4 align-middle font-body text-sm text-foreground">
                                {{ $inquiry->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- View Details Button -->
                                    <button 
                                        wire:click="viewDetails({{ $inquiry->id }})" 
                                        class="p-2 hover:bg-muted text-muted-foreground hover:text-foreground rounded-lg transition-colors"
                                        title="View Details"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <button 
                                        wire:click="deleteInquiry({{ $inquiry->id }})" 
                                        onclick="confirm('Are you sure you want to delete this inquiry? This cannot be undone.') || event.stopImmediatePropagation()"
                                        class="p-2 hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-lg transition-colors"
                                        title="Delete Inquiry"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-muted-foreground font-body text-sm">
                                No inquiries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t border-border/50 bg-muted/20">
            {{ $inquiries->links() }}
        </div>
    </div>

    <!-- Inquiry Details Modal -->
    <div 
        x-data="{ isDetailOpen: @entangle('isDetailOpen') }" 
        x-show="isDetailOpen" 
        x-on:keydown.escape.window="isDetailOpen = false"
        class="fixed inset-0 z-50 overflow-y-auto" 
        style="display: none;"
    >
        <!-- Backdrop -->
        <div 
            x-show="isDetailOpen" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
            @click="isDetailOpen = false"
        ></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
            <div 
                x-show="isDetailOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-3xl bg-card border border-border/60 text-left shadow-2xl transition-all w-full max-w-lg"
            >
                @if ($selectedInquiry)
                    <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                        <div>
                            <h3 class="text-lg font-heading font-bold text-foreground">Inquiry Details</h3>
                            <p class="text-xs text-muted-foreground mt-0.5">ID: <span class="font-bold text-foreground font-body">#{{ $selectedInquiry->id }}</span></p>
                        </div>
                        <button 
                            @click="isDetailOpen = false" 
                            class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="space-y-4 font-body text-sm">
                            <div class="p-4 bg-muted/40 rounded-2xl border border-border/50">
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block mb-0.5">Inquired Tour Package</span>
                                <h4 class="font-heading font-bold text-base text-foreground">{{ $selectedInquiry->package->name ?? 'General Inquiry' }}</h4>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Customer Name</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedInquiry->name }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">WhatsApp</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedInquiry->whatsapp_number) }}" target="_blank" class="font-semibold text-primary hover:underline flex items-center gap-1 mt-0.5">
                                        {{ $selectedInquiry->whatsapp_number }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                    </a>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Email</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedInquiry->email }}</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Date Received</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedInquiry->created_at->format('l, F j, Y - H:i') }}</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Message / Question</span>
                                    <p class="text-muted-foreground bg-muted/20 p-4 border border-border/40 rounded-xl mt-1 text-sm whitespace-pre-wrap leading-relaxed">
                                        {{ $selectedInquiry->message }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="border-t border-border/50 pt-5 flex justify-end gap-3">
                            <a 
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedInquiry->whatsapp_number) }}?text={{ urlencode('Hi ' . $selectedInquiry->name . ', thank you for inquiring about our tour package. Regarding your inquiry: ' . $selectedInquiry->message) }}" 
                                target="_blank"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-[#25D366] hover:bg-[#1ebd5a] text-white shadow-md h-10 px-6 rounded-xl font-body text-sm font-semibold"
                            >
                                Reply via WhatsApp
                            </a>
                            <button 
                                type="button" 
                                @click="isDetailOpen = false" 
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-10 px-6 rounded-xl font-body text-sm font-medium"
                            >
                                Close
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

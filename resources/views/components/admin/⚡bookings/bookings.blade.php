<div class="space-y-8">
    <!-- Header Summary Stats Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Bookings -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Total Bookings</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-foreground">{{ \App\Models\Booking::count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Pending Bookings</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-amber-500">{{ \App\Models\Booking::where('status', 'pending')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
        </div>

        <!-- Confirmed Bookings -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Confirmed Bookings</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-green-500">{{ \App\Models\Booking::where('status', 'confirmed')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- Cancelled Bookings -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Cancelled Bookings</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-red-500">{{ \App\Models\Booking::where('status', 'cancelled')->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
            </div>
        </div>
    </div>

    <!-- Filters and Table Container -->
    <div class="bg-card border border-border/60 shadow-lg rounded-3xl overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-border/50 flex flex-col md:flex-row gap-4 items-center justify-between">
            <h2 class="text-xl font-bold font-heading text-foreground w-full md:w-auto">Manage Bookings</h2>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto items-center">
                <!-- Search input -->
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10 pl-9"
                        placeholder="Search bookings..."
                    >
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>

                <!-- Status Filter Dropdown -->
                <select 
                    wire:model.live="statusFilter"
                    class="flex w-full sm:w-44 border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                >
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-muted/40 border-b border-border/50">
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Code</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Package</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Customer Details</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Travel Date</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Pax</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Total Price</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Status</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-muted/10 transition-colors">
                            <td class="p-4 align-middle">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold font-body bg-primary/10 text-primary uppercase">
                                    {{ $booking->booking_code }}
                                </span>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="max-w-[200px] truncate font-heading font-bold text-sm text-foreground">
                                    {{ $booking->package->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="font-body font-semibold text-sm text-foreground">{{ $booking->full_name }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $booking->email }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $booking->whatsapp_number }}</div>
                            </td>
                            <td class="p-4 align-middle font-body text-sm text-foreground">
                                {{ $booking->travel_date->format('M d, Y') }}
                            </td>
                            <td class="p-4 align-middle font-body text-sm text-foreground">
                                {{ $booking->number_of_pax }} Pax
                            </td>
                            <td class="p-4 align-middle font-heading font-bold text-sm text-accent">
                                IDR {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="p-4 align-middle">
                                @if ($booking->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @elseif ($booking->status === 'confirmed')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-500/10 text-green-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Confirmed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-500/10 text-red-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- View Details Button -->
                                    <button 
                                        wire:click="viewDetails({{ $booking->id }})" 
                                        class="p-2 hover:bg-muted text-muted-foreground hover:text-foreground rounded-lg transition-colors"
                                        title="View Details"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>

                                    <!-- Confirm Booking Button -->
                                    @if ($booking->status !== 'confirmed')
                                        <button 
                                            wire:click="updateStatus({{ $booking->id }}, 'confirmed')" 
                                            class="p-2 hover:bg-green-500/10 text-green-500 rounded-lg transition-colors"
                                            title="Confirm Booking"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        </button>
                                    @endif

                                    <!-- Cancel Booking Button -->
                                    @if ($booking->status !== 'cancelled')
                                        <button 
                                            wire:click="updateStatus({{ $booking->id }}, 'cancelled')" 
                                            class="p-2 hover:bg-red-500/10 text-red-500 rounded-lg transition-colors"
                                            title="Cancel Booking"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                                        </button>
                                    @endif

                                    <!-- Delete History Button -->
                                    <button 
                                        wire:click="deleteBooking({{ $booking->id }})" 
                                        onclick="confirm('Are you sure you want to delete this booking history? This cannot be undone.') || event.stopImmediatePropagation()"
                                        class="p-2 hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-lg transition-colors"
                                        title="Delete Booking"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-muted-foreground font-body text-sm">
                                No bookings found matching the filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="p-6 border-t border-border/50 bg-muted/20">
            {{ $bookings->links() }}
        </div>
    </div>

    <!-- Booking Detail Modal -->
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
                @if ($selectedBooking)
                    <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                        <div>
                            <h3 class="text-lg font-heading font-bold text-foreground">Booking Details</h3>
                            <p class="text-xs text-muted-foreground mt-0.5">Code: <span class="font-bold text-primary uppercase">{{ $selectedBooking->booking_code }}</span></p>
                        </div>
                        <button 
                            @click="isDetailOpen = false" 
                            class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Details Grid -->
                        <div class="space-y-4 font-body text-sm">
                            <div class="p-4 bg-muted/40 rounded-2xl border border-border/50">
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block mb-0.5">Tour Package</span>
                                <h4 class="font-heading font-bold text-base text-foreground">{{ $selectedBooking->package->name ?? '-' }}</h4>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Customer Name</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->full_name }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">WhatsApp</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedBooking->whatsapp_number) }}" target="_blank" class="font-semibold text-primary hover:underline flex items-center gap-1 mt-0.5">
                                        {{ $selectedBooking->whatsapp_number }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                    </a>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Email</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->email }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Travel Date</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->travel_date->format('l, M d, Y') }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Number of Pax</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->number_of_pax }} Person(s)</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Pickup Location</span>
                                    <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->pickup_location }}</p>
                                </div>
                                @if ($selectedBooking->special_request)
                                    <div class="col-span-2">
                                        <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Special Request</span>
                                        <p class="text-muted-foreground bg-muted/20 p-3 border border-border/40 rounded-xl mt-1 text-xs whitespace-pre-wrap leading-relaxed">{{ $selectedBooking->special_request }}</p>
                                    </div>
                                @endif
                                <div class="col-span-2 p-4 bg-primary/5 border border-primary/10 rounded-2xl flex items-center justify-between">
                                    <div>
                                        <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Status</span>
                                        <p class="uppercase text-xs font-bold mt-1">
                                            @if ($selectedBooking->status === 'pending')
                                                <span class="text-amber-500">Pending</span>
                                            @elseif ($selectedBooking->status === 'confirmed')
                                                <span class="text-green-500">Confirmed</span>
                                            @else
                                                <span class="text-red-500">Cancelled</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Total Price Paid</span>
                                        <h3 class="text-xl font-heading font-bold text-accent">IDR {{ number_format($selectedBooking->total_price, 0, ',', '.') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="border-t border-border/50 pt-5 flex justify-end gap-3">
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

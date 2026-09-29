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

        <!-- New & Follow Up -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Needs Follow Up</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-amber-500">{{ \App\Models\Booking::whereIn('status', ['new', 'follow_up'])->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
        </div>

        <!-- Confirmed & Assigned -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Confirmed / Active</span>
                <h3 class="text-2xl font-bold font-heading mt-1 text-emerald-500">{{ \App\Models\Booking::whereIn('status', ['confirmed', 'assigned', 'completed'])->count() }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <!-- Deposit / Revenue Collected -->
        <div class="p-6 bg-card border border-border/60 rounded-3xl flex items-center justify-between shadow-sm">
            <div>
                <span class="text-xs font-semibold font-body text-muted-foreground uppercase tracking-wider block">Deposit Collected</span>
                <h3 class="text-xl font-bold font-heading mt-1 text-accent">IDR {{ number_format(\App\Models\Booking::sum('deposit_amount'), 0, ',', '.') }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center text-accent shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
        </div>
    </div>

    <!-- Filters and Table Container -->
    <div class="bg-card border border-border/60 shadow-lg rounded-3xl overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-border/50 flex flex-col lg:flex-row gap-4 items-center justify-between">
            <h2 class="text-xl font-bold font-heading text-foreground w-full lg:w-auto">Manage Bookings</h2>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto items-center">
                <!-- Search input -->
                <div class="relative w-full sm:w-64">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search" 
                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10 pl-9"
                        placeholder="Search code, name, email..."
                    >
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>

                <!-- Booking Status Filter Dropdown -->
                <select 
                    wire:model.live="statusFilter"
                    class="flex w-full sm:w-44 border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                >
                    <option value="">All Booking Status</option>
                    @foreach ($bookingStatuses as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>

                <!-- Payment Status Filter Dropdown -->
                <select 
                    wire:model.live="paymentStatusFilter"
                    class="flex w-full sm:w-44 border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                >
                    <option value="">All Payments</option>
                    @foreach ($paymentStatuses as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
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
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Customer</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Date / Pax</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Payment Details</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Booking Status</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground">Payment Status</th>
                        <th class="p-4 font-heading font-bold text-xs uppercase tracking-wider text-muted-foreground text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/50">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-muted/10 transition-colors">
                            <td class="p-4 align-middle">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold font-body bg-primary/10 text-primary uppercase inline-block">
                                    {{ $booking->booking_code }}
                                </span>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="max-w-[180px] truncate font-heading font-bold text-sm text-foreground">
                                    {{ $booking->package->name ?? '-' }}
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                <div class="font-body font-semibold text-sm text-foreground">{{ $booking->full_name }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $booking->email }}</div>
                                <div class="font-body text-xs text-muted-foreground mt-0.5">{{ $booking->whatsapp_number }}</div>
                            </td>
                            <td class="p-4 align-middle font-body text-sm text-foreground">
                                <div>{{ $booking->travel_date ? $booking->travel_date->format('M d, Y') : '-' }}</div>
                                <div class="text-xs text-muted-foreground mt-0.5 font-medium">{{ $booking->number_of_pax }} Pax</div>
                            </td>
                            <td class="p-4 align-middle font-body text-sm">
                                <div class="font-heading font-bold text-foreground">
                                    IDR {{ number_format($booking->total_price, 0, ',', '.') }}
                                </div>
                                <div class="text-xs text-muted-foreground mt-0.5">
                                    Deposit: <span class="font-semibold text-accent">IDR {{ number_format($booking->deposit_amount ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-xs text-muted-foreground">
                                    Remaining: <span class="font-semibold {{ ($booking->remaining_balance ?? 0) > 0 ? 'text-amber-500' : 'text-emerald-500' }}">IDR {{ number_format($booking->remaining_balance ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </td>
                            <td class="p-4 align-middle">
                                @php
                                    $st = $booking->status;
                                @endphp
                                @if ($st === 'new')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> New
                                    </span>
                                @elseif ($st === 'follow_up')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Follow Up
                                    </span>
                                @elseif ($st === 'confirmed')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Confirmed
                                    </span>
                                @elseif ($st === 'assigned')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Assigned
                                    </span>
                                @elseif ($st === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-teal-500/10 text-teal-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 align-middle">
                                @php
                                    $pst = $booking->payment_status ?? 'unpaid';
                                @endphp
                                @if ($pst === 'unpaid')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                                        <span class="w-1.5 h-1.5 rounded-full bg-muted-foreground"></span> Unpaid
                                    </span>
                                @elseif ($pst === 'deposit_requested')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-500/10 text-orange-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Deposit Requested
                                    </span>
                                @elseif ($pst === 'deposit_paid')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-500/10 text-sky-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> Deposit Paid
                                    </span>
                                @elseif ($pst === 'fully_paid')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Fully Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-500/10 text-red-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 align-middle text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- View/Edit Details Button -->
                                    <button 
                                        wire:click="viewDetails({{ $booking->id }})" 
                                        class="p-2 hover:bg-primary/10 text-muted-foreground hover:text-primary rounded-xl transition-colors"
                                        title="View & Edit Booking"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </button>

                                    <!-- Delete History Button -->
                                    <button 
                                        wire:click="deleteBooking({{ $booking->id }})" 
                                        onclick="confirm('Are you sure you want to delete this booking history? This cannot be undone.') || event.stopImmediatePropagation()"
                                        class="p-2 hover:bg-destructive/10 text-muted-foreground hover:text-destructive rounded-xl transition-colors"
                                        title="Delete Booking"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
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

    <!-- Booking Detail & Management Modal -->
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
                class="relative transform overflow-hidden rounded-3xl bg-card border border-border/60 text-left shadow-2xl transition-all w-full max-w-2xl"
            >
                @if ($selectedBooking)
                    <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                        <div>
                            <h3 class="text-lg font-heading font-bold text-foreground">Booking & Payment Details</h3>
                            <p class="text-xs text-muted-foreground mt-0.5">Booking Code: <span class="font-bold text-primary uppercase">{{ $selectedBooking->booking_code }}</span></p>
                        </div>
                        <button 
                            @click="isDetailOpen = false" 
                            class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">
                        <!-- Tour Package Info -->
                        <div class="p-4 bg-muted/30 rounded-2xl border border-border/50 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block mb-0.5">Tour Package</span>
                                <h4 class="font-heading font-bold text-base text-foreground">{{ $selectedBooking->package->name ?? '-' }}</h4>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block mb-0.5">Base Total</span>
                                <div class="font-heading font-bold text-base text-accent">IDR {{ number_format($selectedBooking->total_price, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <!-- Customer Details -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 font-body text-sm p-4 bg-card rounded-2xl border border-border/50">
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Customer Name</span>
                                <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->full_name }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">WhatsApp Contact</span>
                                <a 
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedBooking->whatsapp_number) }}" 
                                    target="_blank" 
                                    class="inline-flex items-center gap-1.5 font-semibold text-primary hover:underline mt-0.5"
                                >
                                    <span>{{ $selectedBooking->whatsapp_number }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                </a>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Email</span>
                                <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->email }}</p>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Travel Date & Pax</span>
                                <p class="font-semibold text-foreground mt-0.5">
                                    {{ $selectedBooking->travel_date ? $selectedBooking->travel_date->format('l, M d, Y') : '-' }} ({{ $selectedBooking->number_of_pax }} Pax)
                                </p>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Pickup Location</span>
                                <p class="font-semibold text-foreground mt-0.5">{{ $selectedBooking->pickup_location }}</p>
                            </div>
                            @if ($selectedBooking->special_request)
                                <div class="col-span-1 sm:col-span-2">
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block">Special Request</span>
                                    <p class="text-muted-foreground bg-muted/20 p-3 border border-border/40 rounded-xl mt-1 text-xs whitespace-pre-wrap leading-relaxed">{{ $selectedBooking->special_request }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Management Form: Status & Deposit -->
                        <div class="p-5 bg-primary/5 border border-primary/15 rounded-2xl space-y-4">
                            <h4 class="font-heading font-bold text-sm text-foreground flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                Update Status & Deposit Information
                            </h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Booking Status Dropdown -->
                                <div>
                                    <label class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider block mb-1.5">Booking Status</label>
                                    <select 
                                        wire:model="editStatus" 
                                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                                    >
                                        @foreach ($bookingStatuses as $val => $txt)
                                            <option value="{{ $val }}">{{ $txt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Payment Status Dropdown -->
                                <div>
                                    <label class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider block mb-1.5">Payment Status</label>
                                    <select 
                                        wire:model="editPaymentStatus" 
                                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                                    >
                                        @foreach ($paymentStatuses as $val => $txt)
                                            <option value="{{ $val }}">{{ $txt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Deposit Amount Input -->
                                <div>
                                    <label class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider block mb-1.5">Deposit Amount (IDR)</label>
                                    <input 
                                        type="number" 
                                        step="1000" 
                                        min="0"
                                        wire:model.live.debounce.300ms="editDepositAmount" 
                                        class="flex w-full border border-input bg-background px-3 py-2 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-10"
                                    >
                                </div>

                                <!-- Remaining Balance Display -->
                                <div>
                                    <label class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider block mb-1.5">Remaining Balance</label>
                                    <div class="h-10 px-3 flex items-center bg-muted/40 border border-input/60 rounded-xl font-heading font-bold text-sm {{ $editRemainingBalance > 0 ? 'text-amber-500' : 'text-emerald-500' }}">
                                        IDR {{ number_format($editRemainingBalance, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <div class="pt-2 flex justify-end">
                                <button 
                                    type="button" 
                                    wire:click="saveBookingChanges"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-6 rounded-xl font-body text-sm font-semibold shadow-sm"
                                >
                                    <svg wire:loading.remove wire:target="saveBookingChanges" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                    <span wire:loading wire:target="saveBookingChanges" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                                    Save Changes
                                </button>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="border-t border-border/50 pt-5 flex items-center justify-between">
                            <a 
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $selectedBooking->whatsapp_number) }}?text={{ urlencode('Hi ' . $selectedBooking->full_name . ', regarding your booking #' . $selectedBooking->booking_code . ' with Smith Travel Bali...') }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-500/10 text-emerald-600 hover:bg-emerald-500/20 text-xs font-semibold font-body transition-colors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                                Chat on WhatsApp
                            </a>

                            <button 
                                type="button" 
                                @click="isDetailOpen = false" 
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors border border-input bg-background shadow-sm hover:bg-muted h-10 px-6 rounded-xl font-body text-sm font-medium"
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

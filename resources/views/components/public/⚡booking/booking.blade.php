<div 
    x-data="{ isOpen: @entangle('isOpen') }" 
    x-show="isOpen" 
    x-on:keydown.escape.window="isOpen = false"
    class="fixed inset-0 z-[9999] overflow-y-auto" 
    style="display: none;"
>
    <!-- Backdrop -->
    <div 
        x-show="isOpen" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
        @click="isOpen = false"
    ></div>

    <!-- Modal Content Wrapper -->
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
        <div 
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-3xl bg-card border border-border/60 text-left shadow-2xl transition-all w-full max-w-2xl"
        >
            @if ($isSuccess)
                <!-- Success Header -->
                <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                    <div>
                        <h3 class="text-xl font-heading font-bold text-foreground">Booking Request Submitted!</h3>
                        <p class="text-xs text-muted-foreground mt-0.5">Your booking request has been registered</p>
                    </div>
                    <button 
                        wire:click="closeModal" 
                        class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                    </button>
                </div>

                <!-- Success Body -->
                <div class="p-6 text-center space-y-6">
                    <!-- Icon -->
                    <div class="mx-auto w-16 h-16 rounded-full bg-green-500/10 flex items-center justify-center text-green-500 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="animate-bounce"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>

                    <!-- Heading & Text -->
                    <div class="space-y-2">
                        <h4 class="text-2xl font-heading font-bold text-foreground">Booking Registered Successfully!</h4>
                        <p class="text-sm font-body text-muted-foreground max-w-md mx-auto leading-relaxed">
                            Thank you, <span class="font-semibold text-foreground">{{ $full_name }}</span>! We've saved your request. 
                            We are opening WhatsApp to coordinate pickup details and finalize your tour.
                        </p>
                        <p class="text-xs text-amber-500 font-body">
                            If WhatsApp did not open automatically (blocked by browser), please click the green button below.
                        </p>
                    </div>

                    <!-- Details Box -->
                    <div class="p-5 bg-muted/40 border border-border/50 rounded-2xl text-left space-y-3 font-body text-sm max-w-md mx-auto">
                        <div class="flex justify-between items-center pb-2 border-b border-border/40">
                            <span class="text-xs text-muted-foreground font-semibold uppercase">Booking Code</span>
                            <span class="px-2 py-0.5 bg-primary/10 text-primary rounded font-bold text-xs uppercase">{{ $bookingCode }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Tour Package:</span>
                            <span class="font-bold text-foreground truncate max-w-[220px]">{{ $packageName }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Travel Date:</span>
                            <span class="font-semibold text-foreground">
                                {{ \Carbon\Carbon::parse($travel_date)->format('M d, Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted-foreground">Number of Pax:</span>
                            <span class="font-semibold text-foreground">{{ $number_of_pax }} Pax</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-border/40 items-center">
                            <span class="font-bold text-foreground">Total Price:</span>
                            <span class="font-heading font-bold text-base text-accent">IDR {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-3 max-w-md mx-auto pt-4">
                        <a 
                            href="{{ $whatsappUrl }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap bg-[#25D366] hover:bg-[#1ebd5a] text-white text-sm font-bold h-12 px-6 rounded-xl transition-all shadow-md shadow-green-500/10"
                        >
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.122 1.54 5.862L.15 24l6.326-1.636A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.996c-1.815 0-3.535-.466-5.06-1.3 l-.363-.2-3.766.974.99-3.606-.219-.344A9.957 9.957 0 012.004 12c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 9.996-10 9.996zm5.472-7.614c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            </svg>
                            Open WhatsApp
                        </a>
                        <button 
                            type="button" 
                            wire:click="closeModal" 
                            class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-12 px-6 rounded-xl font-body text-sm font-semibold"
                        >
                            Close
                        </button>
                    </div>
                </div>
            @else
                <!-- Header -->
                <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                    <div>
                        <h3 class="text-xl font-heading font-bold text-foreground">Book Tour Package</h3>
                        <p class="text-xs text-muted-foreground mt-0.5">Please fill out the form below to secure your booking</p>
                    </div>
                    <button 
                        wire:click="closeModal" 
                        class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                    </button>
                </div>

                <!-- Body -->
                <form wire:submit.prevent="submitBooking" class="p-6 space-y-6">
                    <!-- Package Summary Banner -->
                    <div class="p-4 bg-primary/5 border border-primary/10 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-[10px] uppercase tracking-wider font-semibold text-primary block mb-0.5">Selected Package</span>
                            <h4 class="font-heading font-bold text-base text-foreground">{{ $packageName }}</h4>
                        </div>
                        <div class="sm:text-right">
                            <span class="text-[10px] uppercase tracking-wider font-semibold text-primary block mb-0.5">Package Price</span>
                            <p class="font-heading font-bold text-base text-foreground">IDR {{ number_format($packagePrice, 0, ',', '.') }} <span class="text-xs text-muted-foreground font-normal">/pax</span></p>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="full_name" class="text-sm font-semibold font-body text-foreground">Full Name</label>
                            <input 
                                type="text" 
                                id="full_name" 
                                wire:model="full_name" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                                placeholder="Enter your full name"
                            >
                            @error('full_name') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- WhatsApp Number -->
                        <div class="space-y-1.5">
                            <label for="whatsapp_number" class="text-sm font-semibold font-body text-foreground">WhatsApp Number</label>
                            <input 
                                type="text" 
                                id="whatsapp_number" 
                                wire:model="whatsapp_number" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                                placeholder="e.g. +62812345678"
                            >
                            @error('whatsapp_number') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="text-sm font-semibold font-body text-foreground">Email Address</label>
                            <input 
                                type="email" 
                                id="email" 
                                wire:model="email" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                                placeholder="yourname@example.com"
                            >
                            @error('email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- Travel Date -->
                        <div class="space-y-1.5">
                            <label for="travel_date" class="text-sm font-semibold font-body text-foreground">Travel Date</label>
                            <input 
                                type="date" 
                                id="travel_date" 
                                wire:model="travel_date" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                            >
                            @error('travel_date') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- Number of Pax -->
                        <div class="space-y-1.5">
                            <label for="number_of_pax" class="text-sm font-semibold font-body text-foreground">Number of Pax</label>
                            <input 
                                type="number" 
                                id="number_of_pax" 
                                wire:model.live="number_of_pax" 
                                min="1" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                            >
                            @error('number_of_pax') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pickup Location -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="pickup_location" class="text-sm font-semibold font-body text-foreground">Pickup Location</label>
                            <input 
                                type="text" 
                                id="pickup_location" 
                                wire:model="pickup_location" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                                placeholder="Hotel name or address in Bali"
                            >
                            @error('pickup_location') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>

                        <!-- Special Request -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label for="special_request" class="text-sm font-semibold font-body text-foreground">Special Request (Optional)</label>
                            <textarea 
                                id="special_request" 
                                wire:model="special_request" 
                                rows="2" 
                                class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body min-h-[80px]"
                                placeholder="Any food allergies, kid seats, or specific requirements..."
                            ></textarea>
                            @error('special_request') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Price Recap & Actions -->
                    <div class="border-t border-border/50 pt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="text-[10px] uppercase tracking-wider font-semibold text-muted-foreground block mb-0.5">Estimated Total Price</span>
                            <h3 class="text-2xl font-heading font-bold text-accent">IDR {{ number_format($totalPrice, 0, ',', '.') }}</h3>
                        </div>
                        
                        <div class="flex gap-3 justify-end">
                            <button 
                                type="button" 
                                wire:click="closeModal" 
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-11 px-6 rounded-xl font-body text-sm font-medium"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit" 
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-accent hover:bg-accent/90 text-accent-foreground shadow-lg h-11 px-6 rounded-xl font-body text-sm font-bold"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                Confirm Booking
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

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
            class="relative transform overflow-hidden rounded-3xl bg-card border border-border/60 text-left shadow-2xl transition-all w-full max-w-lg"
        >
            @if ($isSuccess)
                <!-- Success Header -->
                <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                    <div>
                        <h3 class="text-xl font-heading font-bold text-foreground">Inquiry Sent!</h3>
                        <p class="text-xs text-muted-foreground mt-0.5">Your message has been delivered to our team</p>
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
                    <div class="mx-auto w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>

                    <!-- Heading & Text -->
                    <div class="space-y-2">
                        <h4 class="text-2xl font-heading font-bold text-foreground">Inquiry Received</h4>
                        <p class="text-sm font-body text-muted-foreground max-w-sm mx-auto leading-relaxed">
                            Thank you, <span class="font-semibold text-foreground">{{ $name }}</span>! We've received your question about the <span class="font-semibold text-foreground">{{ $packageName }}</span> package. 
                            Our team will get back to you shortly via WhatsApp or Email.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-4 max-w-sm mx-auto">
                        <button 
                            type="button" 
                            wire:click="closeModal" 
                            class="w-full inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-primary-foreground shadow-lg h-11 px-6 rounded-xl font-body text-sm font-semibold"
                        >
                            Back to Details
                        </button>
                    </div>
                </div>
            @else
                <!-- Header -->
                <div class="px-6 py-5 border-b border-border/50 flex items-center justify-between bg-muted/40">
                    <div>
                        <h3 class="text-xl font-heading font-bold text-foreground">Send Tour Inquiry</h3>
                        <p class="text-xs text-muted-foreground mt-0.5">Have a question about {{ $packageName }}? Ask us!</p>
                    </div>
                    <button 
                        wire:click="closeModal" 
                        class="rounded-full p-1.5 text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
                    </button>
                </div>

                <!-- Body / Form -->
                <form wire:submit.prevent="submitInquiry" class="p-6 space-y-5">
                    <!-- Package Context Banner -->
                    <div class="p-4 bg-primary/5 border border-primary/10 rounded-2xl">
                        <span class="text-[10px] uppercase tracking-wider font-semibold text-primary block mb-0.5">Package in Inquiry</span>
                        <h4 class="font-heading font-bold text-sm text-foreground">{{ $packageName }}</h4>
                    </div>

                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label for="inquiry_name" class="text-sm font-semibold font-body text-foreground">Your Name</label>
                        <input 
                            type="text" 
                            id="inquiry_name" 
                            wire:model="name" 
                            class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                            placeholder="Enter your name"
                        >
                        @error('name') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    </div>

                    <!-- WhatsApp -->
                    <div class="space-y-1.5">
                        <label for="inquiry_whatsapp" class="text-sm font-semibold font-body text-foreground">WhatsApp Number</label>
                        <input 
                            type="text" 
                            id="inquiry_whatsapp" 
                            wire:model="whatsapp_number" 
                            class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                            placeholder="e.g. +62812345678"
                        >
                        @error('whatsapp_number') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="inquiry_email" class="text-sm font-semibold font-body text-foreground">Email Address</label>
                        <input 
                            type="email" 
                            id="inquiry_email" 
                            wire:model="email" 
                            class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11"
                            placeholder="yourname@example.com"
                        >
                        @error('email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    </div>

                    <!-- Message -->
                    <div class="space-y-1.5">
                        <label for="inquiry_message" class="text-sm font-semibold font-body text-foreground">Your Question / Message</label>
                        <textarea 
                            id="inquiry_message" 
                            wire:model="message" 
                            rows="3" 
                            class="flex w-full border border-input bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body min-h-[90px]"
                            placeholder="I'd like to ask if..."
                        ></textarea>
                        @error('message') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    </div>

                    <!-- Footer Actions -->
                    <div class="border-t border-border/50 pt-5 flex justify-end gap-3">
                        <button 
                            type="button" 
                            wire:click="closeModal" 
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-11 px-6 rounded-xl font-body text-sm font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-primary-foreground shadow-lg h-11 px-6 rounded-xl font-body text-sm font-bold"
                        >
                            Send Inquiry
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

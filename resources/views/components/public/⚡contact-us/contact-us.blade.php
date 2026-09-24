<div>
    <section class="relative pt-32 pb-20 bg-primary overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=1600&amp;q=80" alt="" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div style="opacity: 1; transform: none;">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact Smith Bali Travel</h1>
                <p class="text-lg text-white/70 font-body max-w-2xl mx-auto">We're here to help you plan your Bali experience. Reach out anytime!</p>
            </div>
        </div>
    </section>

    <section class="py-12 bg-background">
        @php
            $cuWa = \App\Models\Setting::get('whatsapp_number', '6281234567890');
            $cuWaClean = preg_replace('/[^0-9]/', '', $cuWa);
            $cuEmail = \App\Models\Setting::get('company_email', 'info@smithbalitravel.com');
            $cuAddress = \App\Models\Setting::get('company_address', 'Bali, Indonesia');
            $cuHours = \App\Models\Setting::get('working_hours', 'Daily 8:00 AM – 9:00 PM (Bali Time)');
            $cuMap = \App\Models\Setting::get('google_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d505152.90832866866!2d114.94970995!3d-8.4556975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd22f3923364d7d%3A0x54a729bfb59e0430!2sBali%2C%20Indonesia!5e0!3m2!1sen!2s!4v1695000000000!5m2!1sen!2s');
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 -mt-16 relative z-20">
                <a href="https://wa.me/{{ $cuWaClean }}" target="_blank" rel="noopener noreferrer" class="bg-card rounded-2xl p-5 border border-border/50 shadow-lg hover:shadow-xl transition-all text-center group" style="opacity: 1; transform: none;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-5 h-5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </div>
                    <p class="text-xs text-muted-foreground font-body mb-1">WhatsApp</p>
                    <p class="text-sm font-semibold font-body text-foreground">+{{ $cuWaClean }}</p>
                </a>
                <a href="mailto:{{ $cuEmail }}" rel="noopener noreferrer" class="bg-card rounded-2xl p-5 border border-border/50 shadow-lg hover:shadow-xl transition-all text-center group" style="opacity: 1; transform: none;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail w-5 h-5"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                    </div>
                    <p class="text-xs text-muted-foreground font-body mb-1">Email</p>
                    <p class="text-sm font-semibold font-body text-foreground">{{ $cuEmail }}</p>
                </a>
                <a href="#" rel="noopener noreferrer" class="bg-card rounded-2xl p-5 border border-border/50 shadow-lg hover:shadow-xl transition-all text-center group" style="opacity: 1; transform: none;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                        <x-icons.map-pin class="lucide lucide-map-pin w-5 h-5" />
                    </div>
                    <p class="text-xs text-muted-foreground font-body mb-1">Address</p>
                    <p class="text-sm font-semibold font-body text-foreground">{{ $cuAddress }}</p>
                </a>
                <a href="#" rel="noopener noreferrer" class="bg-card rounded-2xl p-5 border border-border/50 shadow-lg hover:shadow-xl transition-all text-center group" style="opacity: 1; transform: none;">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mx-auto mb-3 group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <p class="text-xs text-muted-foreground font-body mb-1">Hours</p>
                    <p class="text-sm font-semibold font-body text-foreground">{{ $cuHours }}</p>
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-muted/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-3">
                    <div class="bg-card rounded-2xl p-6 md:p-8 shadow-sm border border-border/50">
                        @if ($isSuccess)
                            <div class="text-center py-10 space-y-6">
                                <div class="mx-auto w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary shadow-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="animate-bounce"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-heading font-bold text-foreground">Inquiry Sent Successfully!</h3>
                                    <p class="text-sm text-muted-foreground font-body max-w-sm mx-auto leading-relaxed">
                                        Thank you! We've received your request. Our travel experts are reviewing your details and will contact you via WhatsApp or Email within a few hours.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <button 
                                        type="button" 
                                        wire:click="$set('isSuccess', false)" 
                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-primary-foreground shadow-lg h-11 px-8 rounded-xl font-body text-sm font-semibold"
                                    >
                                        Send Another Inquiry
                                    </button>
                                </div>
                            </div>
                        @else
                            <h2 class="text-2xl font-heading font-bold text-foreground mb-2">Send Us an Inquiry</h2>
                            <p class="text-sm text-muted-foreground font-body mb-6">Fill out the form below and we'll get back to you within a few hours.</p>
                            <form wire:submit.prevent="submitInquiry" class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1.5">
                                        <label class="font-medium font-body text-sm text-foreground">Full Name *</label>
                                        <input 
                                            type="text" 
                                            wire:model="name"
                                            class="flex w-full border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11" 
                                            required 
                                            placeholder="Your full name"
                                        >
                                        @error('name') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="font-medium font-body text-sm text-foreground">Email *</label>
                                        <input 
                                            type="email" 
                                            wire:model="email"
                                            class="flex w-full border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11" 
                                            required 
                                            placeholder="your@email.com"
                                        >
                                        @error('email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="font-medium font-body text-sm text-foreground">WhatsApp Number *</label>
                                    <input 
                                        type="text" 
                                        wire:model="whatsapp_number"
                                        class="flex w-full border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-11" 
                                        required 
                                        placeholder="+62 xxx xxx xxxx"
                                    >
                                    @error('whatsapp_number') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="font-medium font-body text-sm text-foreground">Message *</label>
                                    <textarea 
                                        wire:model="message"
                                        class="flex w-full border border-input bg-transparent px-3 py-2 text-base shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body min-h-28" 
                                        required 
                                        placeholder="How can we help you plan your dream Bali trip?"
                                    ></textarea>
                                    @error('message') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex gap-3 pt-2">
                                    <button 
                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-primary-foreground shadow rounded-xl font-body font-semibold h-12 px-8" 
                                        type="submit"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send w-4 h-4 mr-2"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path><path d="m21.854 2.147-10.94 10.939"></path></svg> 
                                        Send Inquiry
                                    </button>
                                    <a href="https://wa.me/{{ $cuWaClean }}" target="_blank" rel="noopener noreferrer">
                                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground px-4 py-2 rounded-xl font-body font-semibold h-12" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2 text-primary"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                            Chat via WhatsApp
                                        </button>
                                    </a>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-card rounded-2xl overflow-hidden shadow-sm border border-border/50 h-full min-h-80">
                        <div class="w-full h-full bg-muted flex items-center justify-center">
                            @if (!empty($cuMap))
                                <iframe src="{{ $cuMap }}" width="100%" height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Smith Bali Travel Location" style="border: 0px; min-height: 320px;"></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-background">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-foreground mb-3">Frequently Asked Questions</h2>
                <p class="text-muted-foreground font-body">Quick answers to common questions about our services.</p>
            </div>
            <div class="space-y-3">
                <div class="bg-card rounded-2xl border border-border/50 px-6 shadow-sm cursor-pointer group">
                    <h3 class="flex flex-1 items-center justify-between text-sm transition-all text-left font-body font-semibold text-foreground py-5">
                        How do I book a tour?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </h3>
                </div>
                <div class="bg-card rounded-2xl border border-border/50 px-6 shadow-sm cursor-pointer group">
                    <h3 class="flex flex-1 items-center justify-between text-sm transition-all text-left font-body font-semibold text-foreground py-5">
                        Can I customize the itinerary?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </h3>
                </div>
                <div class="bg-card rounded-2xl border border-border/50 px-6 shadow-sm cursor-pointer group">
                    <h3 class="flex flex-1 items-center justify-between text-sm transition-all text-left font-body font-semibold text-foreground py-5">
                        Do you offer private tours?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </h3>
                </div>
                <div class="bg-card rounded-2xl border border-border/50 px-6 shadow-sm cursor-pointer group">
                    <h3 class="flex flex-1 items-center justify-between text-sm transition-all text-left font-body font-semibold text-foreground py-5">
                        What payment methods do you accept?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </h3>
                </div>
                <div class="bg-card rounded-2xl border border-border/50 px-6 shadow-sm cursor-pointer group">
                    <h3 class="flex flex-1 items-center justify-between text-sm transition-all text-left font-body font-semibold text-foreground py-5">
                        Do you provide airport pickup?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </h3>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="space-y-8 max-w-5xl">
    <!-- Header Page Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-heading font-bold text-foreground">Website Settings</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Configure your business WhatsApp number, admin notification email, and company details.</p>
        </div>
    </div>

    <!-- Alert / Flash Message -->
    @if (session('success'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 rounded-2xl flex items-center gap-3 font-body text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><polyline points="20 6 9 17 4 12"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        
        <!-- SECTION 1: WhatsApp Configuration (Top Priority) -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6 relative overflow-hidden">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#25D366]/10 flex items-center justify-center text-[#25D366] shrink-0 shadow-sm">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.122 1.54 5.862L.15 24l6.326-1.636A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.996c-1.815 0-3.535-.466-5.06-1.3 l-.363-.2-3.766.974.99-3.606-.219-.344A9.957 9.957 0 012.004 12c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 9.996-10 9.996zm5.472-7.614c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">WhatsApp Configuration</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Semua pengalihan pesanan (*booking redirect*), tombol chat mengapung, dan tombol WhatsApp di seluruh website akan mengarah ke nomor ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label for="whatsapp_number" class="text-sm font-semibold font-body text-foreground flex items-center justify-between">
                        <span>Nomor WhatsApp Bisnis *</span>
                        <span class="text-xs font-normal text-muted-foreground">Format: 628... (tanpa tanda +)</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="whatsapp_number" 
                            wire:model="whatsapp_number" 
                            class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                            placeholder="Contoh: 6281234567890"
                            required
                        >
                    </div>
                    @error('whatsapp_number') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    <p class="text-xs text-muted-foreground font-body">
                        Sistem akan otomatis menghapus spasi atau tanda hubung. Gunakan kode negara (misal <strong>62</strong> untuk Indonesia).
                    </p>
                </div>

                <!-- Preview Box -->
                <div class="bg-muted/40 rounded-2xl p-5 border border-border/50 flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-muted-foreground block mb-1">Live Preview Target Link</span>
                        <p class="text-xs font-mono text-foreground break-all bg-background p-2.5 rounded-lg border border-border/50">
                            https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp_number) ?: '6281234567890' }}
                        </p>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-xs text-muted-foreground font-body">Aktif digunakan di: Tombol Booking, Floating Chat WA, Detail Paket, Contact Us.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Notification & Admin Email -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">Notification Email Settings</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Email tujuan untuk menerima notifikasi pesanan dan formulir pertanyaan (inquiry).</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label for="admin_email" class="text-sm font-semibold font-body text-foreground">
                        Email Penerima Notifikasi Admin *
                    </label>
                    <input 
                        type="email" 
                        id="admin_email" 
                        wire:model="admin_email" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="Contoh: Kadekekahospitality@gmail.com"
                        required
                    >
                    @error('admin_email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    <p class="text-xs text-muted-foreground font-body">
                        Sesuai spesifikasi: <code>Kadekekahospitality@gmail.com</code>.
                    </p>
                </div>

                <div class="space-y-2">
                    <label for="company_email" class="text-sm font-semibold font-body text-foreground">
                        Email Publik / Info Website
                    </label>
                    <input 
                        type="email" 
                        id="company_email" 
                        wire:model="company_email" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="Contoh: info@smithbalitravel.com"
                    >
                    @error('company_email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    <p class="text-xs text-muted-foreground font-body">
                        Email yang ditampilkan pada halaman kontak publik & footer website.
                    </p>
                </div>
            </div>
        </div>

        <!-- SECTION 3: General Company Information -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center text-accent shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">Company & Office Details</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Informasi umum yang ditampilkan pada footer dan halaman kontak.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label for="company_name" class="text-sm font-semibold font-body text-foreground">
                        Nama Usaha / Brand *
                    </label>
                    <input 
                        type="text" 
                        id="company_name" 
                        wire:model="company_name" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="Smith Bali Travel"
                        required
                    >
                    @error('company_name') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="working_hours" class="text-sm font-semibold font-body text-foreground">
                        Jam Operasional Layanan
                    </label>
                    <input 
                        type="text" 
                        id="working_hours" 
                        wire:model="working_hours" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="Daily 8:00 AM – 9:00 PM (Bali Time)"
                    >
                    @error('working_hours') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label for="company_address" class="text-sm font-semibold font-body text-foreground">
                        Alamat Kantor
                    </label>
                    <input 
                        type="text" 
                        id="company_address" 
                        wire:model="company_address" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="Bali, Indonesia"
                    >
                    @error('company_address') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label for="google_maps_embed" class="text-sm font-semibold font-body text-foreground">
                        Google Maps Embed URL (Iframe src)
                    </label>
                    <input 
                        type="text" 
                        id="google_maps_embed" 
                        wire:model="google_maps_embed" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring rounded-xl font-body h-12"
                        placeholder="https://www.google.com/maps/embed?..."
                    >
                    @error('google_maps_embed') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 pt-4">
            <button 
                type="submit" 
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-all focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring bg-primary hover:bg-primary/90 text-primary-foreground shadow-lg px-8 h-12 rounded-xl font-body font-bold"
                wire:loading.attr="disabled"
            >
                <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <svg wire:loading class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span>Save Settings</span>
            </button>
        </div>

    </form>
</div>

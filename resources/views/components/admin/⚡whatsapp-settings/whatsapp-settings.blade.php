<div class="space-y-8 max-w-5xl">
    <!-- Header Page Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-heading font-bold text-foreground">WhatsApp Settings</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Configure your official business WhatsApp number and default customer inquiry messages.</p>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- WhatsApp Configuration Card -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6 relative overflow-hidden">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#25D366]/10 flex items-center justify-center text-[#25D366] shrink-0 shadow-sm">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.122 1.54 5.862L.15 24l6.326-1.636A11.933 11.933 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.996c-1.815 0-3.535-.466-5.06-1.3 l-.363-.2-3.766.974.99-3.606-.219-.344A9.957 9.957 0 012.004 12c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 9.996-10 9.996zm5.472-7.614c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">WhatsApp Business Number</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Semua pengalihan pesanan (*booking redirect*), floating chat WA, dan tombol WhatsApp di seluruh website akan mengarah ke nomor ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label for="whatsapp_number" class="text-sm font-semibold font-body text-foreground flex items-center justify-between">
                        <span>Nomor WhatsApp Bisnis *</span>
                        <span class="text-xs font-normal text-muted-foreground">Format: 628... (tanpa tanda +)</span>
                    </label>
                    <input 
                        type="text" 
                        id="whatsapp_number" 
                        wire:model="whatsapp_number" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Contoh: 6281234567890"
                        required
                    >
                    @error('whatsapp_number') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                    <p class="text-xs text-muted-foreground font-body">
                        Sistem otomatis menghapus spasi atau tanda hubung. Gunakan kode negara (misal <strong>62</strong> untuk Indonesia).
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

                <div class="space-y-2 md:col-span-2">
                    <label for="whatsapp_default_message" class="text-sm font-semibold font-body text-foreground">
                        Default Message Template (General Floating Button)
                    </label>
                    <textarea 
                        id="whatsapp_default_message" 
                        wire:model="whatsapp_default_message" 
                        rows="3"
                        class="flex w-full border border-input bg-background p-3 text-sm shadow-sm transition-colors rounded-xl font-body"
                        placeholder="Hello Smith Travel Bali, I would like to inquire about your tour packages."
                    ></textarea>
                    <p class="text-xs text-muted-foreground font-body">
                        Pesan otomatis saat pengunjung mengeklik tombol WhatsApp umum di pojok website.
                    </p>
                </div>
            </div>

            <!-- Save WhatsApp Button -->
            <div class="flex justify-end pt-4 border-t border-border/50">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 rounded-2xl font-body text-sm font-semibold shadow-md shadow-primary/20"
                >
                    <svg wire:loading.remove wire:target="save" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span wire:loading wire:target="save" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Save WhatsApp Settings
                </button>
            </div>
        </div>
    </form>
</div>

<div class="space-y-8 max-w-5xl">
    <!-- Header Page Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-heading font-bold text-foreground">Company Profile & Logo</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Manage your brand logo, business name, address, and public contact information.</p>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- SECTION 1: Brand Logo Upload -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">Website Brand Logo</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Upload logo perusahaan untuk menggantikan logo bawaan pada Navbar, Footer, dan Header Admin Console.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center pt-2">
                <!-- Current / Preview Logo Box -->
                <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-border/80 rounded-3xl bg-muted/20 min-h-[220px] text-center">
                    @if ($new_logo)
                        <!-- New Uploaded Preview -->
                        <div class="relative group">
                            <img src="{{ $new_logo->temporaryUrl() }}" alt="New Logo Preview" class="max-h-24 max-w-full object-contain mb-3 drop-shadow-sm">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-primary/10 text-primary">
                                Preview Logo Baru
                            </span>
                        </div>
                    @elseif ($current_logo)
                        <!-- Saved Logo Preview -->
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $current_logo) }}" alt="Current Brand Logo" class="max-h-24 max-w-full object-contain mb-3 drop-shadow-sm">
                            <div class="flex items-center justify-center gap-2 mt-2">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-600">
                                    Logo Aktif
                                </span>
                                <button 
                                    type="button" 
                                    wire:click="removeLogo" 
                                    onclick="confirm('Hapus logo ini dan kembali ke teks default?') || event.stopImmediatePropagation()"
                                    class="text-xs text-rose-500 hover:text-rose-700 underline font-body"
                                >
                                    Hapus Logo
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Default Placeholder when no logo uploaded -->
                        <div class="w-16 h-16 rounded-2xl bg-accent/15 flex items-center justify-center text-accent font-heading font-bold text-2xl mb-3 shadow-inner">
                            {{ strtoupper(substr($company_name, 0, 1)) ?: 'S' }}
                        </div>
                        <p class="text-xs text-muted-foreground font-body">Belum ada file logo kustom diunggah.<br>Saat ini menggunakan inisial & teks standar.</p>
                    @endif
                </div>

                <!-- Upload Input & Guidance -->
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="new_logo" class="text-sm font-semibold font-body text-foreground block">
                            Pilih File Gambar Logo
                        </label>
                        <input 
                            type="file" 
                            id="new_logo" 
                            wire:model="new_logo" 
                            accept="image/png,image/jpeg,image/webp,image/svg+xml"
                            class="flex w-full file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90 text-sm border border-input rounded-2xl p-2 bg-background cursor-pointer"
                        >
                        @error('new_logo') <span class="text-xs text-rose-500 font-body block">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-xs text-muted-foreground font-body space-y-1.5 p-4 bg-muted/40 rounded-2xl border border-border/50">
                        <span class="font-bold uppercase tracking-wider text-foreground block text-[11px]">💡 Rekomendasi Format Logo:</span>
                        <p>• Format disarankan: <strong>PNG transparan</strong>, <strong>SVG</strong>, atau <strong>WebP</strong>.</p>
                        <p>• Ukuran maksimal: <strong>2 MB</strong>.</p>
                        <p>• Dimensi optimal: Rasio horizontal / proporsional (contoh: tinggi 80-120 px).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Company Profile Information -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center text-accent shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">Company & Office Details</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Informasi profil yang ditampilkan pada footer dan halaman kontak.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <div class="space-y-2">
                    <label for="company_name" class="text-sm font-semibold font-body text-foreground">Nama Usaha / Brand *</label>
                    <input 
                        type="text" 
                        id="company_name" 
                        wire:model="company_name" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Smith Bali Travel"
                        required
                    >
                    @error('company_name') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="company_tagline" class="text-sm font-semibold font-body text-foreground">Tagline / Slogan</label>
                    <input 
                        type="text" 
                        id="company_tagline" 
                        wire:model="company_tagline" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Your Trusted Bali Travel Partner"
                    >
                    @error('company_tagline') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="company_email" class="text-sm font-semibold font-body text-foreground">Email Kontak Publik</label>
                    <input 
                        type="email" 
                        id="company_email" 
                        wire:model="company_email" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="info@smithbalitravel.com"
                    >
                    @error('company_email') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label for="working_hours" class="text-sm font-semibold font-body text-foreground">Jam Operasional Layanan</label>
                    <input 
                        type="text" 
                        id="working_hours" 
                        wire:model="working_hours" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Daily 8:00 AM – 9:00 PM (Bali Time)"
                    >
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="company_address" class="text-sm font-semibold font-body text-foreground">Alamat Kantor / Head Office</label>
                    <input 
                        type="text" 
                        id="company_address" 
                        wire:model="company_address" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Jl. Raya Ubud, Gianyar, Bali - Indonesia"
                    >
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="company_about" class="text-sm font-semibold font-body text-foreground">Deskripsi Singkat (Footer)</label>
                    <textarea 
                        id="company_about" 
                        wire:model="company_about" 
                        rows="3"
                        class="flex w-full border border-input bg-background p-3 text-sm shadow-sm transition-colors rounded-xl font-body"
                        placeholder="Your trusted Bali travel partner. Curated tours and personalized experiences across the Island of the Gods."
                    ></textarea>
                    <p class="text-[11px] text-muted-foreground font-body">Teks ini ditampilkan di bagian footer website.</p>
                    @error('company_about') <span class="text-xs text-rose-500 font-body">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="google_maps_embed" class="text-sm font-semibold font-body text-foreground">Google Maps Embed URL (Opsional)</label>
                    <textarea 
                        id="google_maps_embed" 
                        wire:model="google_maps_embed" 
                        rows="2"
                        class="flex w-full border border-input bg-background p-3 text-sm shadow-sm transition-colors rounded-xl font-body"
                        placeholder="https://www.google.com/maps/embed?..."
                    ></textarea>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end pt-4 border-t border-border/50">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 rounded-2xl font-body text-sm font-semibold shadow-md shadow-primary/20"
                >
                    <svg wire:loading.remove wire:target="save" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span wire:loading wire:target="save" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Save Company Profile & Logo
                </button>
            </div>
        </div>
    </form>
</div>

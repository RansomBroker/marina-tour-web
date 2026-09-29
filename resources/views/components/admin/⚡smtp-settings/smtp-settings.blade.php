<div class="space-y-8 max-w-5xl">
    <!-- Header Page Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-heading font-bold text-foreground">SMTP (Email) Settings</h1>
            <p class="text-sm text-muted-foreground font-body mt-1">Configure your outgoing SMTP server credentials, notification recipients, and test connections.</p>
        </div>
    </div>

    <!-- Main SMTP Settings Form -->
    <form wire:submit.prevent="saveSmtp" class="space-y-6">
        <!-- SMTP Server Credentials Card -->
        <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-heading font-bold text-foreground">SMTP Server Credentials</h2>
                    <p class="text-xs text-muted-foreground font-body mt-0.5">Semua email notifikasi booking baru dan pertanyaan inquiry tamu akan dikirimkan melalui server ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                <!-- Admin Notification Email -->
                <div class="space-y-2 md:col-span-2 bg-primary/5 p-4 rounded-2xl border border-primary/15">
                    <label for="admin_email" class="text-sm font-semibold font-body text-foreground flex items-center justify-between">
                        <span>Email Penerima Notifikasi Admin *</span>
                        <span class="text-xs text-primary font-normal">Tujuan notifikasi booking & inquiry masuk</span>
                    </label>
                    <input 
                        type="email" 
                        id="admin_email" 
                        wire:model="admin_email" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Kadekekahospitality@gmail.com"
                        required
                    >
                    @error('admin_email') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <!-- Mail Driver -->
                <div class="space-y-2">
                    <label for="mail_mailer" class="text-sm font-semibold font-body text-foreground">Mail Driver *</label>
                    <select 
                        id="mail_mailer" 
                        wire:model="mail_mailer" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                    >
                        <option value="smtp">SMTP (Recommended)</option>
                        <option value="sendmail">Sendmail</option>
                        <option value="log">Log (Testing)</option>
                    </select>
                </div>

                <!-- SMTP Host -->
                <div class="space-y-2">
                    <label for="mail_host" class="text-sm font-semibold font-body text-foreground">SMTP Host *</label>
                    <input 
                        type="text" 
                        id="mail_host" 
                        wire:model="mail_host" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="mailpit atau smtp.gmail.com"
                        required
                    >
                    @error('mail_host') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <!-- SMTP Port -->
                <div class="space-y-2">
                    <label for="mail_port" class="text-sm font-semibold font-body text-foreground">SMTP Port *</label>
                    <input 
                        type="number" 
                        id="mail_port" 
                        wire:model="mail_port" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="1025, 587, atau 465"
                        required
                    >
                    @error('mail_port') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <!-- Encryption -->
                <div class="space-y-2">
                    <label for="mail_encryption" class="text-sm font-semibold font-body text-foreground">Encryption</label>
                    <select 
                        id="mail_encryption" 
                        wire:model="mail_encryption" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                    >
                        <option value="">None / Null (Local Mailpit)</option>
                        <option value="tls">TLS (Port 587)</option>
                        <option value="ssl">SSL (Port 465)</option>
                    </select>
                </div>

                <!-- SMTP Username -->
                <div class="space-y-2">
                    <label for="mail_username" class="text-sm font-semibold font-body text-foreground">SMTP Username</label>
                    <input 
                        type="text" 
                        id="mail_username" 
                        wire:model="mail_username" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Email atau username SMTP"
                    >
                </div>

                <!-- SMTP Password -->
                <div class="space-y-2">
                    <label for="mail_password" class="text-sm font-semibold font-body text-foreground">SMTP Password / App Password</label>
                    <input 
                        type="password" 
                        id="mail_password" 
                        wire:model="mail_password" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="••••••••••••"
                    >
                </div>

                <!-- Sender From Address -->
                <div class="space-y-2">
                    <label for="mail_from_address" class="text-sm font-semibold font-body text-foreground">Sender Email (From Address) *</label>
                    <input 
                        type="email" 
                        id="mail_from_address" 
                        wire:model="mail_from_address" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="info@smithtravelbali.com"
                        required
                    >
                    @error('mail_from_address') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>

                <!-- Sender From Name -->
                <div class="space-y-2">
                    <label for="mail_from_name" class="text-sm font-semibold font-body text-foreground">Sender Name (From Name) *</label>
                    <input 
                        type="text" 
                        id="mail_from_name" 
                        wire:model="mail_from_name" 
                        class="flex w-full border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                        placeholder="Smith Travel Bali"
                        required
                    >
                    @error('mail_from_name') <span class="text-xs text-red-500 font-body">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Save SMTP Button -->
            <div class="flex justify-end pt-4 border-t border-border/50">
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-primary text-primary-foreground hover:bg-primary/90 h-12 px-8 rounded-2xl font-body text-sm font-semibold shadow-md shadow-primary/20"
                >
                    <svg wire:loading.remove wire:target="saveSmtp" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span wire:loading wire:target="saveSmtp" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                    Save SMTP Configuration
                </button>
            </div>
        </div>
    </form>

    <!-- Test SMTP Connection Card -->
    <div class="bg-card border border-border/60 shadow-sm rounded-3xl p-6 sm:p-8 space-y-4">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-accent/10 flex items-center justify-center text-accent shrink-0 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-heading font-bold text-foreground">Test SMTP Email Connection</h3>
                <p class="text-xs text-muted-foreground font-body mt-0.5">Kirim email percobaan untuk memastikan kredensial SMTP Anda sudah terhubung dengan benar ke server.</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
            <input 
                type="email" 
                wire:model="test_email_recipient" 
                class="flex w-full sm:flex-1 border border-input bg-background px-4 py-2.5 text-sm shadow-sm transition-colors rounded-xl font-body h-12"
                placeholder="Masukkan email penerima test (misal: yourname@gmail.com)"
            >
            <button 
                type="button" 
                wire:click="sendTestEmail"
                wire:loading.attr="disabled"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap transition-colors bg-accent text-accent-foreground hover:bg-accent/90 h-12 px-6 rounded-xl font-body text-sm font-semibold shadow-sm"
            >
                <svg wire:loading.remove wire:target="sendTestEmail" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" x2="11" y1="2" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                <span wire:loading wire:target="sendTestEmail" class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>
                Send Test Email
            </button>
        </div>

        <!-- Test Feedback Status -->
        @if ($testEmailStatus === 'success')
            <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-xl text-xs font-semibold font-body flex items-center gap-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ $testEmailMessage }}</span>
            </div>
        @elseif ($testEmailStatus === 'error')
            <div class="p-4 bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 rounded-xl text-xs font-semibold font-body flex items-center gap-2 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
                <span>{{ $testEmailMessage }}</span>
            </div>
        @endif
    </div>

    <!-- Quick Guide / Preset Tips -->
    <div class="p-5 bg-muted/30 border border-border/50 rounded-2xl text-xs text-muted-foreground font-body space-y-2">
        <span class="font-bold uppercase tracking-wider text-foreground block">💡 Panduan Konfigurasi Server SMTP:</span>
        <ul class="list-disc list-inside space-y-1">
            <li><strong>Mailpit (Lokal Docker):</strong> Host: <code>mailpit</code> | Port: <code>1025</code> | Encryption: <code>None</code> | Username & Password: Kosongkan. Cek inbox di <a href="http://localhost:8025" target="_blank" class="text-primary underline">localhost:8025</a>.</li>
            <li><strong>Google Workspace / Gmail:</strong> Host: <code>smtp.gmail.com</code> | Port: <code>587</code> | Encryption: <code>TLS</code> | Password: Gunakan <em>App Password 16-digit</em> Google.</li>
            <li><strong>Brevo / Sendinblue:</strong> Host: <code>smtp-relay.brevo.com</code> | Port: <code>587</code> | Encryption: <code>TLS</code>.</li>
        </ul>
    </div>
</div>

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $mailHost = \App\Models\Setting::get('mail_host');
                if ($mailHost) {
                    config([
                        'mail.default' => \App\Models\Setting::get('mail_mailer', env('MAIL_MAILER', 'smtp')),
                        'mail.mailers.smtp.host' => $mailHost,
                        'mail.mailers.smtp.port' => (int) \App\Models\Setting::get('mail_port', env('MAIL_PORT', 1025)),
                        'mail.mailers.smtp.encryption' => \App\Models\Setting::get('mail_encryption', env('MAIL_ENCRYPTION', null)),
                        'mail.mailers.smtp.username' => \App\Models\Setting::get('mail_username', env('MAIL_USERNAME', null)),
                        'mail.mailers.smtp.password' => \App\Models\Setting::get('mail_password', env('MAIL_PASSWORD', null)),
                        'mail.from.address' => \App\Models\Setting::get('mail_from_address', env('MAIL_FROM_ADDRESS', 'info@smithtravelbali.com')),
                        'mail.from.name' => \App\Models\Setting::get('mail_from_name', env('MAIL_FROM_NAME', 'Smith Travel Bali')),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Fail gracefully if database is not yet ready or migrating
        }
    }
}

<?php

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    // SMTP / Email Settings
    public string $admin_email = '';
    public string $mail_mailer = 'smtp';
    public string $mail_host = '';
    public string $mail_port = '1025';
    public ?string $mail_encryption = '';
    public ?string $mail_username = '';
    public ?string $mail_password = '';
    public string $mail_from_address = '';
    public string $mail_from_name = '';

    // Test Email
    public string $test_email_recipient = '';
    public string $testEmailStatus = '';
    public string $testEmailMessage = '';

    protected array $rules = [
        'admin_email' => 'required|email|max:255',
        'mail_mailer' => 'required|string|max:50',
        'mail_host' => 'required|string|max:255',
        'mail_port' => 'required|numeric',
        'mail_encryption' => 'nullable|string|max:20',
        'mail_username' => 'nullable|string|max:255',
        'mail_password' => 'nullable|string|max:255',
        'mail_from_address' => 'required|email|max:255',
        'mail_from_name' => 'required|string|max:255',
    ];

    public function mount(): void
    {
        $this->admin_email = (string) (Setting::get('admin_email') ?? env('ADMIN_EMAIL') ?? 'Kadekekahospitality@gmail.com');
        $this->mail_mailer = (string) (Setting::get('mail_mailer') ?? env('MAIL_MAILER') ?? 'smtp');
        $this->mail_host = (string) (Setting::get('mail_host') ?? env('MAIL_HOST') ?? 'mailpit');
        $this->mail_port = (string) (Setting::get('mail_port') ?? env('MAIL_PORT') ?? '1025');
        $this->mail_encryption = (string) (Setting::get('mail_encryption') ?? env('MAIL_ENCRYPTION') ?? '');
        $this->mail_username = (string) (Setting::get('mail_username') ?? env('MAIL_USERNAME') ?? '');
        $this->mail_password = (string) (Setting::get('mail_password') ?? env('MAIL_PASSWORD') ?? '');
        $this->mail_from_address = (string) (Setting::get('mail_from_address') ?? env('MAIL_FROM_ADDRESS') ?? 'info@smithtravelbali.com');
        $this->mail_from_name = (string) (Setting::get('mail_from_name') ?? env('MAIL_FROM_NAME') ?? 'Smith Travel Bali');

        $this->test_email_recipient = $this->admin_email;
    }

    public function saveSmtp(): void
    {
        $this->validate();

        Setting::set('admin_email', $this->admin_email);
        Setting::set('mail_mailer', $this->mail_mailer);
        Setting::set('mail_host', $this->mail_host);
        Setting::set('mail_port', (string) $this->mail_port);
        Setting::set('mail_encryption', $this->mail_encryption ?: '');
        Setting::set('mail_username', $this->mail_username ?: '');
        Setting::set('mail_password', $this->mail_password ?: '');
        Setting::set('mail_from_address', $this->mail_from_address);
        Setting::set('mail_from_name', $this->mail_from_name);

        // Apply immediately to current runtime mail config
        config([
            'mail.default' => $this->mail_mailer,
            'mail.mailers.smtp.host' => $this->mail_host,
            'mail.mailers.smtp.port' => (int) $this->mail_port,
            'mail.mailers.smtp.encryption' => $this->mail_encryption ?: null,
            'mail.mailers.smtp.username' => $this->mail_username ?: null,
            'mail.mailers.smtp.password' => $this->mail_password ?: null,
            'mail.from.address' => $this->mail_from_address,
            'mail.from.name' => $this->mail_from_name,
        ]);

        $this->dispatch('toast', 
            message: 'SMTP (Email) configuration saved successfully!', 
            type: 'success'
        );
    }

    public function sendTestEmail(): void
    {
        $this->validate([
            'test_email_recipient' => 'required|email',
        ]);

        $this->testEmailStatus = 'sending';
        $this->testEmailMessage = 'Sending test email...';

        try {
            // Apply current form values to runtime config
            config([
                'mail.default' => $this->mail_mailer,
                'mail.mailers.smtp.host' => $this->mail_host,
                'mail.mailers.smtp.port' => (int) $this->mail_port,
                'mail.mailers.smtp.encryption' => $this->mail_encryption ?: null,
                'mail.mailers.smtp.username' => $this->mail_username ?: null,
                'mail.mailers.smtp.password' => $this->mail_password ?: null,
                'mail.from.address' => $this->mail_from_address,
                'mail.from.name' => $this->mail_from_name,
            ]);

            $recipient = $this->test_email_recipient;
            $appName = Setting::get('company_name', 'Smith Travel Bali');

            Mail::raw("Hello!\n\nThis is a test email sent from {$appName} Admin Panel (SMTP Settings) to verify that your email server configuration is working properly.\n\nTime sent: " . now()->toDayDateTimeString(), function ($msg) use ($recipient, $appName) {
                $msg->to($recipient)
                    ->subject("SMTP Test Email - {$appName}");
            });

            $this->testEmailStatus = 'success';
            $this->testEmailMessage = "Test email sent successfully to {$recipient}!";

            $this->dispatch('toast', 
                message: "Test email sent successfully to {$recipient}!", 
                type: 'success'
            );
        } catch (\Exception $e) {
            Log::error("SMTP Test Email Error: " . $e->getMessage());
            $this->testEmailStatus = 'error';
            $this->testEmailMessage = "Failed to send email: " . $e->getMessage();

            $this->dispatch('toast', 
                message: "SMTP test failed: " . $e->getMessage(), 
                type: 'error'
            );
        }
    }

    public function render()
    {
        return view('components.admin.⚡smtp-settings.smtp-settings');
    }
};

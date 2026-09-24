<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            'whatsapp_number' => '6281234567890',
            'admin_email' => 'Kadekekahospitality@gmail.com',
            'company_name' => 'Smith Bali Travel',
            'company_email' => 'info@smithbalitravel.com',
            'company_address' => 'Bali, Indonesia',
            'working_hours' => 'Daily 8:00 AM – 9:00 PM (Bali Time)',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d505152.90832866866!2d114.94970995!3d-8.4556975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd22f3923364d7d%3A0x54a729bfb59e0430!2sBali%2C%20Indonesia!5e0!3m2!1sen!2s!4v1695000000000!5m2!1sen!2s',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}

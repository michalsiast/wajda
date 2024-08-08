<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->seedSMTP();
       $this->seedGoogleApi();
    }


    private function seedGoogleApi() {
        Config::create([
            'name' => 'google_app_recaptcha2_site_key',
            'value' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
        ]);
        Config::create([
            'name' => 'google_app_recaptcha2_secret_key',
            'value' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        ]);
    }

    private function seedSMTP() {
        Config::create([
            'name' => 'smtp_host',
            'value' => 's2.palmax.com.pl',
        ]);
        Config::create([
            'name' => 'smtp_port',
            'value' => '587',
        ]);
        Config::create([
            'name' => 'smtp_username',
            'value' => 'noreply@domena.s2.palmax.com.pl',
        ]);
        Config::create([
            'name' => 'smtp_password',
            'value' => 'Sk5cMPXTu',
        ]);
        Config::create([
            'name' => 'smtp_encryption',
            'value' => 'TLS',
        ]);
        Config::create([
            'name' => 'smtp_from_address',
            'value' => 'noreply@domena.pl',
        ]);
        Config::create([
            'name' => 'smtp_from_name',
            'value' => 'Formularz kontaktowy - Nazwa strony',
        ]);
    }
}

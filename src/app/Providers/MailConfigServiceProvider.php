<?php


namespace App\Providers;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        if (Schema::hasTable('config')) {
            $smtp = DB::table('config')
                ->where('name', 'like', 'smtp_%')
                ->pluck('value', 'name')
                ->toArray();

            $config = Config::get('mail');
            $config['mailers']['smtp']['host'] = $smtp['smtp_host'] ?? '';
            $config['mailers']['smtp']['port'] = $smtp['smtp_port'] ?? '';
            $config['mailers']['smtp']['username'] = $smtp['smtp_username'] ?? '';
            $config['mailers']['smtp']['password'] = $smtp['smtp_password'] ?? '';
            $config['mailers']['smtp']['encryption'] = $smtp['smtp_encryption'] ?? '';
            $config['from']['address'] = $smtp['smtp_from_address'] ?? '';
            $config['from']['name'] = $smtp['smtp_from_name'] ?? '';


            Config::set('mail', $config);
        }
    }
}

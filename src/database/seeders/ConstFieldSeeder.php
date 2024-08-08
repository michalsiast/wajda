<?php

namespace Database\Seeders;

use App\Models\ConstField;
use Illuminate\Database\Seeder;

class ConstFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConstField::create([
            'name' => 'contact_form_rule',
            'value' => '<p>Wyrażam zgodę na przetwarzanie moich danych osobowych w celach marketingowych, poprzez przesyłanie informacji handlowych za pomocą poczty elektronicznej, na podany adres e-mail.</p>',
            'lang' => 'pl'
        ]);
    }
}


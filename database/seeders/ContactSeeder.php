<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo1 = [
            'nome'   => 'Email',
        ];

        $tipo2 = [
            'nome'   => 'Celular',
        ];

        Contact::create($tipo1);
        Contact::create($tipo2);
        Contact::factory()->count(20)->create();
    }
}

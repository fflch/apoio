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
        $contact1 = [
            'nome' => 'Email',
        ];
        $contact2 = [
            'nome' => 'Celular',
        ];
        $contact3 = [
            'nome' => 'Telefone Fixo',
        ];
        $contact4 = [
            'nome' => 'Telefone Comercial',
        ];

        Contact::create($contact1);
        Contact::create($contact2);
        Contact::create($contact3);
        Contact::create($contact4);
        //Contact::factory()->count(5)->create();
    }
}

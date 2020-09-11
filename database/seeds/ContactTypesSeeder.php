<?php

use Illuminate\Database\Seeder;
use App\ContactType;

class ContactTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo1 = [
            'tipo'   => 'Email',
        ];

        $tipo2 = [
            'tipo'   => 'Celular',
        ];

        ContactType::create($tipo1);
        ContactType::create($tipo2);
        factory(ContactType::class, 20)->create();
    }
}

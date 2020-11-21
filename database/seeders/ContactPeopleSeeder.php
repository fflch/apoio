<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactPeople;

class ContactPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contato1 = [
            'people_id' => 1,
            'contact_id' => 1,
            'contato' => 'meuemail@usp.br',
        ];

        $contato2 = [
            'people_id' => 2,
            'contact_id' => 2,
            'contato' => '91234-5678',
        ];
        Contact::create($contato1);
        Contact::create($contato2);
        Contact::factory()->count(20)->create();
    }

}

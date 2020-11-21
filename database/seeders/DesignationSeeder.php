<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designation1 = [
            'nome'   => 'Assistente',
        ];

        $designation2 = [
            'nome'   => 'Doutor',
        ];

        Designation::create($designation1);
        Designation::create($designation2);
        Designation::factory()->count(20)->create();
    }
}

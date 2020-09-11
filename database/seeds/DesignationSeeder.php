<?php

use Illuminate\Database\Seeder;
use App\Designation;

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
            'titulo'   => 'Assistente',
        ];

        $designation2 = [
            'titulo'   => 'Doutor',
        ];

        Designation::create($designation1);
        Designation::create($designation2);
        factory(Designation::class, 20)->create();
    }
}

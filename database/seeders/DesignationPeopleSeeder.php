<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DesignationPeople;

class DesignationPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designationPeople1 = [
            'designation_id' => 2,
            'people_id' => 1,
        ];
        $designationPeople2 = [
            'designation_id' => 1,
            'people_id' => 2,
        ];
        DesignationPeople::create($designationPeople1);
        DesignationPeople::create($designationPeople2);
        DesignationPeople::factory()->count(20)->create();
    }
}

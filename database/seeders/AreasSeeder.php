<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area1 = [
            'departament_id' => 1,
            'area' => 'STI',
        ];
        Area::create($area1);
        Area::factory()->count(20)->create();
    }
}

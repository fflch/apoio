<?php

use Illuminate\Database\Seeder;
use App\Area;

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
        factory(Area::class, 20)->create();
    }
}

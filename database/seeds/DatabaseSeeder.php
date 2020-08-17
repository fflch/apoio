<?php

use Illuminate\Database\Seeder;
use App\Institution;
use App\Departament;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            InstitutionsSeeder::class,
            DepartamentsSeeder::class,
        ]);
    }
}

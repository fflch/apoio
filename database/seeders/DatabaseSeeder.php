<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


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
            DesignationSeeder::class,
            RolesSeeder::class,
            ContactTypesSeeder::class,
            AreasSeeder::class,
            PeopleSeeder::class,
            ContactsSeeder::class,
        ]);
    }
}

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
            InstitutionSeeder::class,
            DepartamentSeeder::class,
            DesignationSeeder::class,
            RoleSeeder::class,
            ContactSeeder::class,
            AreaSeeder::class,
            PeopleSeeder::class,
            //ContactPeopleSeeder::class,
            HolderSeeder::class,
            SurrogateSeeder::class,
            ContestSeeder::class,
            CommissionSeeder::class,
        ]);
    }
}

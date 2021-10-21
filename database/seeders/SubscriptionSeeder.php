<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contest;
use App\Models\Subscription;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(Contest::all()->take(3) as $contest) {
            $people = \App\Models\People::inRandomOrder()
                ->take(3)->pluck('id');
            foreach($people as $key => $person) {
                $subscription = [
                    'contest_id' => $contest->id,
                    'people_id' => $person,
                ];
                Subscription::create($subscription);
            }
        }

        Subscription::factory()->count(10)->create();
    }
}

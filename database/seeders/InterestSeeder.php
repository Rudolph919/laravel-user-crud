<?php

namespace Database\Seeders;

use App\Models\Interests;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interests::create(['name' => 'Reading']);
        Interests::create(['name' => 'Traveling']);
        Interests::create(['name' => 'Fishing']);
        Interests::create(['name' => 'Television']);
        Interests::create(['name' => 'Bird Watching']);
        Interests::create(['name' => 'Collecting']);
        Interests::create(['name' => 'Music']);
        Interests::create(['name' => 'Gardening']);
        Interests::create(['name' => 'Video Games']);
        Interests::create(['name' => 'Martial Arts']);
        Interests::create(['name' => 'Woodworking']);
        Interests::create(['name' => 'Team Sports']);
        Interests::create(['name' => 'Yoga']);
        Interests::create(['name' => 'Golf']);
        Interests::create(['name' => 'Watching Sports']);
        Interests::create(['name' => 'Playing Cards']);
        Interests::create(['name' => 'Board Games']);
        Interests::create(['name' => 'Writing']);
        Interests::create(['name' => 'Dancing']);
        Interests::create(['name' => 'Cooking']);
    }
}

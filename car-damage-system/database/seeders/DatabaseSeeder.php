<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Damage;
use App\Models\History;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory( rand(20, 30) )->create();
        $vehicles = Vehicle::factory( rand(10, 20) )->create();
        $damages = Damage::factory( rand(10,15) )->create();
        $histories = History ::factory( rand(20,30) )->create();

        $histories->each(function($history) use (&$users) {
            $history->user()->associate($users->random())->save();
        });

        $damages->each(function($damage) use (&$vehicles) {
            $damage->vehicles()->attach($vehicles->random(rand(1, 5)));
        });
    }
}

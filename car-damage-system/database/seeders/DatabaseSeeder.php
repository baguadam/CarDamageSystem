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
            $relatedVehicles = $vehicles->random(rand(1, 5)); // kiszedjük a random járműveket
            $damage->vehicles()->attach($relatedVehicles); // hozzáadjuk őket a damage-hez

            // megkeressük a maximum gyártási évet, hogy ennek segítségével a damage időpontját
            // egy biztosan későbbi dátumra állítsuk
            $maxProdYear = -1;
            foreach ($relatedVehicles as $vehicle) {
                if ($vehicle->year > $maxProdYear) {
                    $maxProdYear = $vehicle->year;
                }
            }

            // damage időpontjának átállítása
            $startDate = $maxProdYear . '-01-01';
            $damage->date = fake()->dateTimeBetween($startDate, 'now')->format('Y-m-d');
            $damage->save();
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Configuration;
use App\Models\Option;
use App\Models\Price;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $options = Option::factory()->count(10)->create();
        Car::factory()->count(10)->create()->each(function ($car) use ($options) {
            $configurations = Configuration::factory()->count(rand(1, 3))->create([
                'car_id' => $car->id
            ]);

            $configurations->each(function ($configuration) use ($options) {
                $optionIds = $options->random(rand(1, 5))->pluck('id')->toArray();
                $configuration->options()->attach($optionIds);
                Price::factory()->create([
                    'configuration_id' => $configuration->id,
                ]);
            });
        });
    }
}

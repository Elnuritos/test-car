<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\Configuration;
use App\Models\Option;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarAvailableTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_available_cars_returns_valid_structure()
    {
        $car = Car::create(['name' => 'Toyota Camry']);

        $configuration = Configuration::create([
            'car_id' => $car->id,
            'name' => 'Comfort'
        ]);

        $option1 = Option::create(['name' => 'Climate Control']);
        $option2 = Option::create(['name' => 'Leather Seats']);


        $configuration->options()->attach([$option1->id, $option2->id]);


        $now = now();
        Price::create([
            'configuration_id' => $configuration->id,
            'price' => 35000,
            'start_date' => $now->subDay(),
            'end_date'   => $now->addDay(),
        ]);

        $response = $this->getJson('/api/v1/cars/available');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name',
                         'configurations' => [
                             '*' => [
                                 'id',
                                 'name',
                                 'options',
                                 'current_price',
                             ],
                         ],
                     ],
                 ]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuration>
 */
class ConfigurationFactory extends Factory
{
    protected $model = Configuration::class;

    public function definition()
    {
        return [
            'car_id' => Car::factory(),
            'name'   => ucfirst($this->faker->word),
        ];
    }

}

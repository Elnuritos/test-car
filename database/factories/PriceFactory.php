<?php

namespace Database\Factories;

use App\Models\Price;
use App\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition()
    {

        $start = Carbon::now()->subDays($this->faker->numberBetween(1, 3));
        $end   = Carbon::now()->addDays($this->faker->numberBetween(1, 3));

        return [
            'configuration_id' => Configuration::factory(),
            'price'            => $this->faker->randomFloat(2, 20000, 50000),
            'start_date'       => $start,
            'end_date'         => $end,
        ];
    }
}

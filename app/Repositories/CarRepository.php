<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CarRepository
{
    public function all(): Collection
    {
        return Car::all();
    }

    public function create(array $data): Car
    {
        return Car::create($data);
    }

    public function find(Car $car): Car
    {
        return $car;
    }

    public function update(Car $car, array $data): bool
    {
        return $car->update($data);
    }

    public function delete(Car $car): bool
    {
        return $car->delete();
    }

    public function available(): Collection
    {
        $cars = Cache::remember('available_cars', 600, function () {
            return Car::with(['configurations' => function ($query) {
                $query->whereHas('prices', function ($q) {
                    $q->where('start_date', '<=', now())
                      ->where('end_date', '>=', now());
                })->with(['options', 'prices']);
            }])
            ->whereHas('configurations.prices', function ($q) {
                $q->where('start_date', '<=', now())
                  ->where('end_date', '>=', now());
            })
            ->get();
        });

        return $cars->map(function ($car) {
            return [
                'id' => $car->id,
                'name' => $car->name,
                'configurations' => $car->configurations->map(function ($config) {
                    $activePrice = $config->prices->first(function ($price) {
                        return $price->start_date <= now() && $price->end_date >= now();
                    });
                    return [
                        'id' => $config->id,
                        'name' => $config->name,
                        'options' => $config->options->pluck('name')->toArray(),
                        'current_price' => $activePrice ? $activePrice->price : null,
                    ];
                })->filter(function ($config) {
                    return $config['current_price'] !== null;
                })->values(),
            ];
        })->filter(function ($car) {
            return count($car['configurations']) > 0;
        })->values();
    }
}

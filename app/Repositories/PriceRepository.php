<?php

namespace App\Repositories;

use App\Models\Price;
use Illuminate\Support\Collection;

class PriceRepository
{
    public function all(): Collection
    {
        return Price::with('configuration')->get();
    }

    public function create(array $data): Price
    {
        return Price::create($data);
    }

    public function find(Price $price): Price
    {
        return $price->load('configuration');
    }

    public function update(Price $price, array $data): bool
    {
        return $price->update($data);
    }

    public function delete(Price $price): bool
    {
        return $price->delete();
    }
}

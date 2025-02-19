<?php

namespace App\Repositories;

use App\Models\Option;
use Illuminate\Support\Collection;

class OptionRepository
{
    public function all(): Collection
    {
        return Option::all();
    }

    public function create(array $data): Option
    {
        return Option::create($data);
    }

    public function find(Option $option): Option
    {
        return $option;
    }

    public function update(Option $option, array $data): bool
    {
        return $option->update($data);
    }

    public function delete(Option $option): bool
    {
        return $option->delete();
    }
}

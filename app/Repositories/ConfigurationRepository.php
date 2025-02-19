<?php

namespace App\Repositories;

use App\Models\Configuration;
use Illuminate\Support\Collection;

class ConfigurationRepository
{
    public function all(): Collection
    {
        return Configuration::with(['options', 'prices'])->get();
    }

    public function create(array $data): Configuration
    {
        $configuration = Configuration::create($data);
        if (isset($data['option_ids'])) {
            $configuration->options()->sync($data['option_ids']);
        }
        return $configuration;
    }

    public function find(Configuration $configuration): Configuration
    {
        return $configuration->load(['options', 'prices']);
    }

    public function update(Configuration $configuration, array $data): bool
    {
        $updated = $configuration->update($data);
        if (isset($data['option_ids'])) {
            $configuration->options()->sync($data['option_ids']);
        }
        return $updated;
    }

    public function delete(Configuration $configuration): bool
    {
        return $configuration->delete();
    }
}

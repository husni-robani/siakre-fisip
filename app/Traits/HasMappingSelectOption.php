<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;

trait HasMappingSelectOption
{
    public function mapToOptions(Collection $collection, bool $hasNumber = false)
    {
        return $hasNumber
            ? $collection->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->number . ' - ' . $item->name,
            ])
            : $collection->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
            ]);
    }
}

<?php

namespace App\Models\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    /**
     * @throws Exception
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        if (!isset($this->searchableFields)) {
            throw new Exception('You must define a $searchableFields property in your model');
        }

        foreach ($this->searchableFields as $field) {
            // nested search (e.g. user.name)
            // the user relation must be loaded
            if (str_contains($field, '.')) {
                $query->with([Str::beforeLast($field, '.')]);

                $query->orWhereHas(
                    Str::beforeLast($field, '.'),
                    fn(Builder $query) => $query->whereRaw(
                        Str::afterLast($field, '.') . " LIKE LOWER('%{$search}%')"
                    )
                );

                continue;
            }

            $query->orWhereRaw("LOWER({$field}) LIKE LOWER('%{$search}%')");
        }

        return $query;
    }
}

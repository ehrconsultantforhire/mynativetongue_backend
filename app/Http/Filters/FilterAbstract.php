<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract
{
    abstract public function filter(Builder $builder, $value);

    public function mappings(): array
    {
        return [];
    }

    protected function resolveFilterValue($key)
    {
        /**
         * Filter classes can map query request values to a value as specified in mappings method
         * If query request values does not match mapping, null is returned
         */
        return array_get($this->mappings(), $key);
    }
}

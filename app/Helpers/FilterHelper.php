<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class FilterHelper
{
    public static function sanitize(string $value): Collection
    {
        // split query by delimiter 'space'
        $collection = collect(explode(' ', $value));

        // accept only unique values
        // $collection = $collection->unique();

        // reject any value with less than 2 characters
        $collection = $collection->reject(function ($value) {
            return strlen($value) < 1;
        });

        
        return $collection;
    }
}

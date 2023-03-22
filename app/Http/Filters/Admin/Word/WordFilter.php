<?php

namespace App\Http\Filters\Admin\Word;

use App\Http\Filters\FilterAbstract;
use App\Helpers\FilterHelper;
use Illuminate\Database\Eloquent\Builder;

class WordFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        $collection = FilterHelper::sanitize($value);

        if ($collection->count() === 0) {
            return $builder->where('id', 0); // force return no results
        }

        if ($collection->count() === 1) {
            return $builder->where('word', 'like', '%' . $collection->first() . '%') ;
        }

        if ($collection->count() > 1) {
            $i = 1;
            foreach ($collection as $query) {
                if ($i <= 3) {
                    $builder->where('word', 'like', '%' . $query . '%');
                }
                $i++;
            }
            return $builder;
        }
        return $builder;
    }
}



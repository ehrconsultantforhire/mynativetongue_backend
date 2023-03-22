<?php

namespace App\Http\Filters\Admin\Word;

use App\Http\Filters\FiltersAbstract;

class BaseWordFilter extends FiltersAbstract
{
    /**
     * BaseFilter class extends FiltersAbstract
     * request is passed in the constructor
     * eloquent builder is passed in the filter method
     */

    /**
     * Maps each request query key to the filter class
     * Define the mapping here
     *
     * @var array $filterClasses
     */
    protected $filterClasses = [

        'search' => WordFilter::class,
    ];
}

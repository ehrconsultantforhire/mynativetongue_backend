<?php

namespace App\Http\Filters\Admin\User;

use App\Http\Filters\FiltersAbstract;

class BaseUserFilter extends FiltersAbstract
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

        'search' => UserFilter::class,
    ];
}

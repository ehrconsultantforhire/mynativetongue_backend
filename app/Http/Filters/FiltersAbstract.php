<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    /** @var Request $request */
    protected $request;

    /** @var array $filterClasses */
    protected $filterClasses = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filter(Builder $builder)
    {
        /**
         * array filterClasses maps request query key to filter class
         * eg. ['key' => 'App\Filters\User\DepartmentFilter']
         *
         * this filter method loops through array filterClasses, extracts only the key value pair as
         * defined in the filterClasses array and present the key is present in the query request
         *
         * key value example:
         * ['department' => 'some value']
         * - 'department' exists both in filterClasses array key and query request key
         * - 'some value' is the query request key's value
         */
        foreach ($this->getKeyValuePair() as $key => $value) {
            $this->instantiateFilterClass($key)
                ->filter($builder, $value);
        }

        return $builder;
    }

    protected function getKeyValuePair()
    {
        return $this->resolveKeyValuePair($this->filterClasses);
    }

    protected function resolveKeyValuePair($filterClasses)
    {
        /**
         * return only key value pair - which query keys are present in request
         * - array_keys($filterClasses) returns the keys in $filterClasses
         * - $this->request->only(array_keys($filterClasses)) returns the query request keys' values
         * - end result : ['key' => 'query request key's value']
         */
        return array_filter($this->request->only(array_keys($filterClasses)));
    }

    protected function instantiateFilterClass($key)
    {
        /**
         * new up a filter class
         */
        return new $this->filterClasses[$key];
    }

    public function add(array $filterClasses)
    {
        /**
         * Allows option for additional filter classes to be added
         */
        $this->filterClasses = array_merge($this->filterClasses, $filterClasses);

        return $this;
    }
}

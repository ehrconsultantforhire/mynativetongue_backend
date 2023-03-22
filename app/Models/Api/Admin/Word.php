<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Admin\Word\BaseWordFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Word extends Model
{
    protected $fillable = ['word','plan_id','language_id','status'];

	public function scopeFilter(Builder $builder, Request $request, array $filters = [])
	{
		return (new BaseWordFilter($request))->add($filters)->filter($builder);
	}
}

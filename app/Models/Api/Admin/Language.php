<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Admin\Language\BaseLanguageFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Api\User\SubscriptionPlanLanguage as PlanLanguage;

class Language extends Model
{
    protected $fillable = ['code','name', 'native_name'];

    public function subscriptionPlanLanguage()
    {
        return $this->hasMany(PlanLanguage::class,'language_id','id');
    }

	public function scopeFilter(Builder $builder, Request $request, array $filters = [])
	{
		return (new BaseLanguageFilter($request))->add($filters)->filter($builder);
	}
}

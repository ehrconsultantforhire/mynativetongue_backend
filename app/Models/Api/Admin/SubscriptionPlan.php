<?php

namespace App\Models\Api\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Api\User\SubscriptionPlanLanguage as PlanLanguage;

class SubscriptionPlan extends Model
{
    protected $fillable = ['name','price', 'words','max_words','team_type','teams','game_play_time','random_words','sound_effects','plan_type','status'];


    public function planLanguages()
    {
        return $this->hasMany(PlanLanguage::class,'plan_id','id');
    }

	public function languages()
	{
	    return $this->hasManyThrough(
	      Language::class,
	      PlanLanguage::class,
	      'plan_id',
	      'id',
	      'id',
	      'language_id'
	    );
	}
}

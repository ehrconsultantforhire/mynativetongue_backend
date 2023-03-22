<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SubscriptionPlanLanguage extends Model
{
    protected $fillable = ['plan_id','language_id','status',];

}

<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Api\Admin\SubscriptionPlan as Plan;

class UserSubscriptionPlan extends Model
{
    protected $fillable = ['user_id','plan_id','transaction_id','subscription_start_date','subscription_end_date','status',];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function plan()
    {
        return $this->hasOne(Plan::class,'id','plan_id');
    }
}

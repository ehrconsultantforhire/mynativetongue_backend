<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanTransaction extends Model
{
    protected $fillable = ['id','user_id','plan_id','transaction_id','transaction_time','transaction_amount','transaction_status','created_at','updated_at'];
}

<?php

namespace App\Models\Api\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Http\Filters\Admin\User\BaseUserFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','age','email','password','role_id','country_code','mobile_no','status','is_subscribed','show_ad','profile_image','email_verified','email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscribedUser()
    {
        return $this->hasOne(UserSubscriptionPlan::class,'user_id','id');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new BaseUserFilter($request))->add($filters)->filter($builder);
    }
}

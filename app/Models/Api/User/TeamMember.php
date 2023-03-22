<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TeamMember extends Model
{
    protected $fillable = ['team_id','member_name','avatar_url','language_id'];

    public function memberGamePlay()
    {
        return $this->hasMany(PlayGame::class,'member_id','id');
    }
}

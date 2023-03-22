<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Team extends Model
{
    protected $fillable = ['user_id','game_id'];

    public function teamMembers()
    {
        return $this->hasMany(TeamMember::class,'team_id','id');
    }
}

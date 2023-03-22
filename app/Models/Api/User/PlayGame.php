<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PlayGame extends Model
{
    protected $casts = 
    [
    	'word_time' => 'mm:ss'
	];
    protected $fillable = ['member_id','word_id','word_status','word_time'];
}

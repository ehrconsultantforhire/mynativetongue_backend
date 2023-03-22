<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Api\User\PlayGame;

class LeaderBoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'rank' => $this['rank'],
            'team_id' => $this['t_id'],
            'member_id' => $this['m_id'],
            'member_name' => $this['member_name'],
            'avatar_url' => $this['avatar_url'],
            'game_id' => $this['game_id'],
            // 'game_time'=> $this->convertTime($this['time_in_sec']),
            'game_time'=> $this->gameTime($this['m_id']),
            // 'count'=> $this['count']
        ];
    }

    private function convertTime($time)
    {
        $day = floor($time / 86400);
        $hours = floor(($time -($day*86400)) / 3600);
        $minutes = floor(($time / 60) % 60);
        $seconds = $time % 60;

        if ($hours   < 10) {$hours   = "0".$hours;}
        if ($minutes < 10) {$minutes = "0".$minutes;}
        if ($seconds < 10) {$seconds = "0".$seconds;}

        // only mm:ss
        if ($hours == "00")
        {
            $time = $minutes.':'.$seconds;
        }
        else
        {
            $time = $hours.':'.$minutes.':'.$seconds;
        }

        return $time;
    }

    private function gameTime($member_id)
    {
        $game_time = \DB::table('play_games')->selectRaw('min(word_time) as play_time')->where('member_id', '=', $member_id)->groupBy('member_id')->get()->toArray();
        $acctual_str_time = strtotime('00:01:00') - strtotime($game_time[0]->play_time);
        return $this->convertTime($acctual_str_time);
    }
}

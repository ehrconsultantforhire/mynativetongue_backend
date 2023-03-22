<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Api\Admin\Language;
use App\Models\Api\User\UserSubscriptionPlan;
use Auth;

class TeamMemberResource extends JsonResource
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
            'id' => $this->id,
            'team_id' => $this->team_id,
            'avatar_url' => $this->avatar_url,
            'member_name' => $this->member_name,
            'langauge_id' => $this->language_id,
            'plan_id' => $this->getPlanId(),
            'langauge_code' => $this->getLanguageCode($this->language_id),
        ];
    }

    private function getLanguageCode($language_id)
    {
        $language = Language::where('id',$language_id)->first();
        if(isset($language->code))
        {
            return $language->code;
        }
        else
        {
            return 'N/A';
        }
    }

    private function getPlanId()
    {
        $plan = UserSubscriptionPlan::where('user_id',Auth::User()->id)->first();
        return $plan->plan_id;
    }
}

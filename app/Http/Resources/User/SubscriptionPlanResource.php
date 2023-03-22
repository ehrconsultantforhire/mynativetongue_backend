<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Api\Admin\Language;
use App\Models\Api\Admin\SubscriptionPlan;

class SubscriptionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       if(isset($this->id))
       {
           return [
                'plan_name'=>isset($this->name) ? $this->name : 'N/A' ,
                'plan_type'=>$this->plan_type == "free" ? "Free" : '$'.$this->price,
                'words'=>$this->words.' Words',
                'about_game'=>[$this->manageLanguages($this->planLanguages->toArray()),$this->manageTeams($this->id),$this->aboutGame($this->id),$this->sound_effects == 'yes' ? 'Sound Effect(s)' : 'No Sound Effect(s)'],
                // 'languages' => $this->manageLanguages($this->planLanguages->toArray()),
                // 'teams'=> $this->manageTeams($this->id),
                // 'about_game'=> $this->aboutGame($this->id),
                // 'sound_effect'=> $this->sound_effects == 'yes' ? 'Sound Effect(s)' : 'No Sound Effect(s)',
                'product_id' => $this->planProductId($this->id)
            ];
       }
       else
       {
         return [];
       }
    }

    private function manageLanguages($languages)
    {
        if(!empty($languages))
        {
            $languages_name_array = [];
            foreach ($languages as $key => $language) 
            {
                $languages_name_array[] = Language::where('id',$language['language_id'])->first()->name;
            }
            return implode(",  ",$languages_name_array);
        }
        else
        {
            return 'N/A';
        }
    }

    private function manageTeams($plan_id)
    {
        // if($plan_id && $plan_id != 3 && $plan_id != 4)
        // {
            
        //     return $this->teams.' team';
        // }
        // else
        // {
        //     if($plan_id && $plan_id == 3)
        //     {
        //         return 'Add additional 1 team';
        //     }
        //     else
        //     {
        //         return 'Untimited Teams';
        //     }
        // }
        return 'Untimited Teams';
    }

    private function aboutGame($plan_id)
    {
        if($this->random_words == 'yes')
        {
            $value = 'Random words -';
        }
        else
        {
            $value = 'No Random words -';
        }

        return "1 min to play -".' '.$value.' Hold Phone to your mouth;';
    }

    private function planProductId($plan_id)
    {
        $product_id = env('FREE_PLAN_ID');

        if($plan_id == 2){
            $product_id = env('GOLD_PLAN_ID');
        }
        elseif ($plan_id == 3) {
            $product_id = env('DIAMOND_PLAN_ID');
        }
        elseif ($plan_id == 4) {
            $product_id = env('PLATINUM_PLAN_ID');
        }
        return $product_id;
    }
}

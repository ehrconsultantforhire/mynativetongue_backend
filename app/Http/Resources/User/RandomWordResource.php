<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\Api\Admin\Language;

class RandomWordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return [
       //      'id' => $this->id,
       //      'acctual_word' => $this->word,
       //      'translated_word' => $this->translateWord($this->word,$request->language_id)['translated_word'],
       //      'pronounced_word' => $this->translateWord($this->word,$request->language_id)['pronounced_word'],
       //      'status' => $this->status,
       //      'created_at' => $this->created_at->format('jS M Y h:i A'),
       //      'updated_at' => $this->updated_at->format('jS M Y h:i A')
       //  ];

        return [
            'id' => $this->id,
            'plan_id' => $this->plan_id,
            'language_id' => $this->language_id,
            'word' => $this->word,
            'status' => $this->status,  
        ];
    }

    private function translateWord($word,$language_id)
    {
        if($word && $language_id != null)
        {
            $translation = [];
            $language = Language::where('id',$language_id)->first();
            if($language && isset($language->code))
            {
                $translate = new GoogleTranslate();
                $translate->setSource('en');
                $translate->setTarget($language->code);
                $pronounce = $translate->getResponse($word);
                $translation['translated_word'] = $translate->translate($word);
                $translation['pronounced_word'] = isset($pronounce[0][1][2]) ? $pronounce[0][1][2] :  $translation['translated_word'];
                return $translation;
            }
            else
            {
                return 'N/A';
            }
        }
        else
        {
            return 'N/A';
        }
    }
}

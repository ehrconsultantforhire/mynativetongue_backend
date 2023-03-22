<?php

namespace App\Http\Requests\Admin\Word;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Models\Api\Admin\Word;
use App\Models\Api\Admin\SubscriptionPlan;
use App\Models\Api\Admin\Language;


class EditValidation extends FormRequest
{
  use \App\Http\Requests\Response;

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
    'word' => 'required',
    'plan_id' => 'required',
    'language_id' => 'required',
    ];
  }

  public function messages()
  {
    return [];
  }

  public function withValidator($validator)
  {
    $word_id = last(request()->segments());
    $plan = SubscriptionPlan::where('id',$this->plan_id)->first();
    $language = Language::where('id',$this->language_id)->first();
    if(is_numeric((int)$word_id))
    {
      $word = Word::where(['word'=>$this->word])->where('id','!=',$word_id)->first();
    }
    else
    {
      $word = Word::where(['word'=> $this->word])->first();
   
    }
    $validator->after(function ($validator) use($word,$plan,$language) {
      if(isset($word['word']))
      {
        $validator->errors()->add('word', 'The word has already been taken.');
      }
      elseif(empty($plan))
      { 
        $validator->errors()->add('plan_id', 'Plan not exist');
      }
      elseif(empty($language))
      {
        $validator->errors()->add('language_id', 'Language not exist');
      }
    });
    return;
  }
}

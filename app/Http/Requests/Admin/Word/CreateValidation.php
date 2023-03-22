<?php

namespace App\Http\Requests\Admin\Word;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Api\Admin\SubscriptionPlan;
use App\Models\Api\Admin\Language;


class CreateValidation extends FormRequest
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
    'word'    => 'required|unique:words,word,',
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
    $plan = SubscriptionPlan::where('id',$this->plan_id)->first();
    $language = Language::where('id',$this->language_id)->first();
    $validator->after(function ($validator) use($plan,$language) 
    {
      if(empty($plan))
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

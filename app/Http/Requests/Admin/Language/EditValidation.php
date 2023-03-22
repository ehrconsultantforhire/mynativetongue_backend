<?php

namespace App\Http\Requests\Admin\Language;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
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
    'code' => 'required',
    'name' => 'required',
    'native_name' => 'required',
    ];
  }

  public function messages()
  {
    return [];
  }

  public function withValidator($validator)
  {
    $language_id = last(request()->segments());
    if(is_numeric($language_id))
    {
      $language = Language::where(['code'=>$this->code])->where('id','!=',$language_id)->first();
    }
    else
    {
      $language= Language::where(['code'=> $this->code])->first();
   
    }
    $validator->after(function ($validator) use($language) {
      if ($language['code']) 
      {
        $validator->errors()->add('code', 'The code has already been taken.');
      }
    });
    return;
  }
}

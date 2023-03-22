<?php

namespace App\Http\Requests\Admin\Language;

use Illuminate\Foundation\Http\FormRequest;


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
    'code' => 'required|unique:languages,code,',
    'name' => 'required',
    'native_name' => 'required',
    'status' => 'required',
    ];
  }

  public function messages()
  {
    return [];
  }

  public function withValidator($validator)
  {
    //
  }
}

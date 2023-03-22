<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Api\User\User;
use Auth;

class RegisterValidation extends FormRequest
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
   
    if($this->email != null)
    {
      return [
      // 'name' => 'required',
      // 'age' => 'numeric',
      'email' =>'regex:/^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$/|unique:users,email,',
      // 'mobile_no' =>'required|regex:/^(\d{10,10})$/|unique:users,mobile_no,',
      'mobile_no' =>'required|unique:users,mobile_no,',
      'role_id'=> 'required',
      // 'country_code'=> 'required'
      ];
    }
    else
    {
      return [
      // 'name' => 'required',
      // 'age' => 'numeric',
      // 'email' =>'regex:/^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$/|unique:users,email,',
      // 'mobile_no' =>'required|regex:/^(\d{10,10})$/|unique:users,mobile_no,',
      'mobile_no' =>'required|unique:users,mobile_no,',
      'role_id'=> 'required',
      // 'country_code'=> 'required'
      ];
    }
  }

  public function messages()
  {
    return [
      'mobile_no.regex' => 'Mobile no. value should be digit and It should have 10 digit. ',
    ];
  }

  public function withValidator($validator)
  {
    //
  }
}

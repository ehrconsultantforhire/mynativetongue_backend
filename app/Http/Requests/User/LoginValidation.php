<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Api\User\User;

class LoginValidation extends FormRequest
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
    if($this->user_type == 'admin')
    {
      return [
        'user_id' => 'required',
        'password' => 'required',
      ];
    }
    elseif($this->user_type == 'user')
    {
      return [
        'user_id' => 'required',
      ];
    }
    else
    {
      return [
        'user_type' => 'required',
      ];
    }
  }

  public function messages()
  {
    return [
      'email.required' => 'This field is required',
      'password.required' => 'This field is required',
      'user_id.required' => 'This field is required',
    ];
  }

  public function withValidator($validator)
  {
    if(isset($this->user_type) && $this->user_type == 'admin')
    {
      $is_user_exist = User::where(['email'=>$this->user_id,'role_id'=>1])->first();
    }
    elseif (isset($this->user_type) && $this->user_type == 'user') 
    {
      $is_user_exist = User::where(function($q)  
      {
        return $q
         ->where('email', $this->user_id)
         ->orWhere('mobile_no', $this->user_id);
      })->where('role_id', '=',2)->first();
    }
    else
    {
      return 'Something went wrong!!';
    }
  
    $validator->after(function ($validator) use ($is_user_exist) 
    {
        if(empty($is_user_exist)) 
        { 
          if($this->user_type == 'admin')
          {
            $validator->errors()->add('user_id', 'Email does not exist!');
          }
          elseif ($this->user_type == 'user') 
          {
            $validator->errors()->add('user_id', 'User id does not exist!');
          }
        }
        elseif (!\Hash::check($this->password, $is_user_exist->password) && $this->user_type == 'admin') 
        {
          $validator->errors()->add('password', 'Wrong Password');
        }
        elseif ($is_user_exist->email_verified == "no") 
        {
          if($this->user_type == 'admin')
          {
            $validator->errors()->add('user_id', 'Please verify your account.');
          }
          // elseif ($this->user_type == 'user') 
          // {
          //   $validator->errors()->add('user_id', 'Please verify your account.');
          // } 
        }
        elseif($is_user_exist->status == "inactive")
        {
          if($this->user_type == 'admin')
          {
            $validator->errors()->add('user_id', 'Please activate your account.');
          }
          elseif ($this->user_type == 'user') 
          {
            $validator->errors()->add('user_id', 'Please activate your account.');
          } 
        }
        elseif (isset($this->user_type) && ($this->user_type == 'admin') )
        {
          if($is_user_exist->role_id != 1)
          {
            $validator->errors()->add('user_id', 'Please enter valid admin email.');
          }
        }
    });
    return;
  }
}

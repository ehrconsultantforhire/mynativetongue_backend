<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Request;
use Illuminate\Support\Arr;

/**
*
*/
trait Response
{

 protected function failedValidation(Validator $validator)
 {

   $errors = [] ;
   foreach ($validator->errors()->getMessages() as $key => $value) {

     $errors[$key] = Arr::first($value) ? : '';
     
   }

   throw new HttpResponseException(
     response()->json([
       'status'  => false,
       'code'    => 200,
       'action'  => isset($this->action) ? $this->action : "",
       'message' => $validator->errors()->first(),
       'errors'  => (object)$errors,
       'data'    => ""
     ], 200) );

 }
}
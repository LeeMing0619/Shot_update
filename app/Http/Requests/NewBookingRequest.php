<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Auth;

class NewBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      if(Auth::User())
      {
        if(Auth::User()->account_type == 'client')
        {
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          // 'pro_type' => 'required|unique:business_infos',
          // 'looking_to_shoot' => 'required'
          // 'event_address' => 'required'
          // 'looking_to_shoot' => 'required'
          // 'looking_to_shoot' => 'required'
        ];
    }
}

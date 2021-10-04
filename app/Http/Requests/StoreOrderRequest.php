<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules  = [
                'first_name'        =>  'required|string' ,
                'last_name'         =>  'required|string' ,
                'email'             =>  'required|string|email' ,
                'phone_number'      =>  'required|numeric|digits:10|starts_with:98' ,
                'city'              =>  'required|string' ,
                'street_address'    =>  'required|string' ,
                'house_number'      =>  'required|numeric' ,
                'payment_method'    =>  'required|string'
            ];
        if(request()->payment_method === 'stripe'){
            $rules += ['token' => 'required|string'];
        }

        return $rules;
    }
}

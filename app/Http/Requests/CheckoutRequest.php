<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckoutRequest extends Request
{
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
            'email' => 'sometimes|required|email',
            'name'  => 'required',
            'phone' => 'required',
            'address'   => 'required',
            'city'  => 'required',
            'state' => 'required',
            'country'   => 'required',
            'password'  => 'sometimes|required|min:6|confirmed',
            'password_confirmation' => 'sometimes|required',
            'terms' => 'accepted',
        ];
    }
}

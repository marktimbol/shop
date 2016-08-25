<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required',
            'phone' => 'required',
            'address'   => 'required',
            'city'  => 'required',
            'state' => 'required',
            'country'   => 'required',
        ];
    }
}

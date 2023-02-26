<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [

            'id'=>'required_if:id,true|exists:users,id',
            'name'=>'required_if:name,true|string',
            // 'phone'=>'required_if:phone,true|numeric|max:12',
            'role_id'=>'required_if:role_id,true|exists:roles,id',
            // 'senior_id'=>'required_if:senior_id,true|exists:users,id',
            // 'warehouse_id'=>'required_if:warehouse_id,true|exists:ware_houses,id',
            'email' => 'required_if:email,true|email',
            'password'=>'required_if:password,true|string|min:4',

        ];
    }
}

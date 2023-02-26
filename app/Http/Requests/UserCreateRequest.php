<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|min:4|max:50',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role_id' => 'required_if:role_id,true|exists:roles,id'
        ];
    }
}

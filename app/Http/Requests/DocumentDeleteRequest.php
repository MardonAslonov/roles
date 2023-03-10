<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "id" => "required_if:id,true|exists:documents,id",
        ];
    }
}

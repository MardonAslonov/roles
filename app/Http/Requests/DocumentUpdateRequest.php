<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "id" => "required_if:id,true|exists:documents,id",
            "title" => "required|string",
            "address" => "required|string",
            "products" => "required|array|min:1",
            "products.*.title" => "required|string",
            "products.*.measure" => "required|string",
            "products.*.price" => "required|int",
            "products.*.count" => "required|int",
        ];
    }
}

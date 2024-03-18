<?php

namespace App\Http\Requests\Infrastructure;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfrastructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [            
            "name" => "required",
            "path" => "nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg",
            "description" => "nullable",
            "latitude" => "required",
            "longitude" => "required"
        ];
    }
}

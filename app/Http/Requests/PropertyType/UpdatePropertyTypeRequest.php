<?php

namespace App\Http\Requests\PropertyType;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($args): array
    {
        return [
            'name' => ['filled', 'unique:property_types,name,' . $args['id'], 'max:255'],
        ];
    }
}

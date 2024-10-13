<?php

namespace App\Http\Requests\Property;

use App\Models\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
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
            'name' => ['filled', 'unique:properties,name,' . $args['id'], 'max:255'],
            'is_top' => 'nullable',
            'type' => 'filled|in:checkbox,select,input',
            'unit' => 'filled|max:255',
            'property_type_id' => 'filled|numeric|' . Rule::exists(PropertyType::class, 'id'),
        ];
    }
}

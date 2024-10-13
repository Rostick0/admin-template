<?php

namespace App\Http\Requests\Property;

use App\Models\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|unique:properties,name|max:255',
            'is_top' => 'nullable',
            'type' => 'required|in:checkbox,select,input',
            'unit' => 'required|max:255',
            'property_type_id' => 'required|numeric|' . Rule::exists(PropertyType::class, 'id'),
        ];
    }
}

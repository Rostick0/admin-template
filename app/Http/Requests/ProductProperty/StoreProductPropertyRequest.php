<?php

namespace App\Http\Requests\ProductProperty;

use App\Models\Property;
use App\Models\PropertyValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductPropertyRequest extends FormRequest
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
            'value' => 'nullable|max:255',
            'property_id' => 'required|' . Rule::exists(Property::class, 'id'),
            'property_value_id' => 'nullable|' . Rule::exists(PropertyValue::class, 'id'),
            // 'product_id' => 'required',
        ];
    }
}

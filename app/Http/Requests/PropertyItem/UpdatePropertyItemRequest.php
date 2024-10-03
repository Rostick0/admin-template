<?php

namespace App\Http\Requests\PropertyItem;

use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyItemRequest extends FormRequest
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
            'name' => 'filled|max:255',
            'type' => 'filled|in:checkbox,select,input',
            'unit' => 'filled|max:255',
            'property_id' => 'filled|numeric|' . Rule::exists(Property::class, 'id'),
            'property_type_id' => 'required|numeric|' . Rule::exists(PropertyType::class, 'id'),
        ];
    }
}

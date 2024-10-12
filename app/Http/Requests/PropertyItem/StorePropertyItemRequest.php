<?php

namespace App\Http\Requests\PropertyItem;

use App\Enum\PropertyItemType;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyItemRequest extends FormRequest
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

        $rules = [
            'name' => 'required|max:255',
            'is_top' => 'nullable',
            'type' => 'required|in:checkbox,select,input',
            'value' => 'nullable|max:255',
            'unit' => 'required|max:255',
            'property_id' => 'required|numeric|' . Rule::exists(Property::class, 'id'),
            'property_type_id' => 'required|numeric|' . Rule::exists(PropertyType::class, 'id'),
        ];
        if ($args['type'] == PropertyItemType::select->value) {
            $rules['value'] = 'required|max:255';
        }

        return $rules;
    }
}

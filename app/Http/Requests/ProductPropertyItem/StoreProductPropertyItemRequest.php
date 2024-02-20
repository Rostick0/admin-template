<?php

namespace App\Http\Requests\ProductPropertyItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductPropertyItemRequest extends FormRequest
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
            'value' => 'nullable|max:255',
            'property_item_id' => 'required|' . Rule::exists('property_items', 'id'),
            // 'product_id' => 'required',
        ];
    }
}

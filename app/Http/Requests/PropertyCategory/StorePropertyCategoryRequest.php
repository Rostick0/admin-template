<?php

namespace App\Http\Requests\PropertyCategory;

use App\Models\Category;
use App\Models\PropertyItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyCategoryRequest extends FormRequest
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
            'property_item_id' => 'required|numeric|' . Rule::exists(PropertyItem::class, 'id'),
            'category_id' => 'required|numeric|' . Rule::exists(Category::class, 'id'),
        ];
    }
}

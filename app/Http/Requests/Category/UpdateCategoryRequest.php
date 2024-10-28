<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'filled|max:255',
            'link_name' => 'filled|' . Rule::unique(Category::class)->ignore($args['id']),
            'description' => 'nullable|max:65536',
            'parent_id' => 'nullable|numeric|' . Rule::exists('categories', 'id'),
        ];
    }
}

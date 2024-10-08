<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'title' => 'filled|max:255',
            'link_name' => 'filled|' . Rule::unique(Product::class)->ignore($args['id']),
            'description' => 'filled|max:65536',
            'price' => ['filled', 'regex:/^\d+(\.\d{1,2})?$/'],
            'old_price' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            'count' => 'nullable|numeric',
            'is_infinitely' => 'nullable',
            'vendor_id' => 'filled|' . Rule::exists('vendors', 'id'),
            'category_id' => 'filled|' . Rule::exists('categories', 'id'),
            'date_publication' => 'nullable|date',
        ];

        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'nullable|in:publish,pending,draft,future';
        } else {
            $rules['status'] = 'nullable|in:pending,draft';
        }

        return $rules;
    }
}

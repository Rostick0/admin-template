<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:65536',
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'old_price' => ['nullable', 'regex:/^\d+(\.\d{1,2})?$/'],
            'count' => 'nullable|numeric',
            'is_infinitely' => 'nullable',
            'vendor_id' => 'required|' . Rule::exists('vendors', 'id'),
            'category_id' => 'required|' . Rule::exists('categories', 'id'),
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

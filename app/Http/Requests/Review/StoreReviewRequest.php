<?php

namespace App\Http\Requests\Review;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
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
            'mark' => 'required',
            'dignities' => 'nullable|max:300',
            'disadvantages' => 'nullable|max:300',
            'comment' => 'nullable|max:300',
            'product_id' => 'required|' . Rule::exists(Product::class, 'id'),
        ];
    }
}

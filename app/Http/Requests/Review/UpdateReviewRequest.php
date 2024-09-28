<?php

namespace App\Http\Requests\Review;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest
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
            'mark' => 'filled|numeric|min:1|max:5',
            'dignities' => 'nullable|max:300',
            'disadvantages' => 'nullable|max:300',
            'comment' => 'nullable|max:300',
            'product_id' => 'filled|' . Rule::exists(Product::class, 'id'),
        ];
    }
}

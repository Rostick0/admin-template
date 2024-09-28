<?php

namespace App\Http\Requests\StatisticDay;

use App\Enum\StatisticType;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncrementStatisticDayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:' . StatisticType::view->value],
            'model' => ['required', 'in:' . implode(',', [Product::class, Post::class])],
            'id' => ['required', Rule::exists($this->model)],
        ];
    }
}

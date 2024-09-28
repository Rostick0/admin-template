<?php

namespace App\Http\Requests\Comment;

use App\Models\Post;
use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
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
            'text' => 'required|max:255',
            'model' => ['required', 'in:' . implode(',', [Review::class, Post::class])],
            'id' => ['required', Rule::exists($args['model'])],
        ];
    }
}

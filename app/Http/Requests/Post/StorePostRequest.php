<?php

namespace App\Http\Requests\Post;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'link_name' => 'required|' . Rule::unique(Post::class),
            'description' => 'nullable|max:255',
            'content' => 'required|max:65536',
            'rubric_id' => 'required|' . Rule::exists('rubrics', 'id'),
            'source' => 'nullable|max:255',
            'is_private' => 'nullable',
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

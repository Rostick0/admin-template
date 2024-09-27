<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => 'filled|max:255',
            'description' => 'nullable|max:255',
            'content' => 'filled|max:65536',
            'rubric_id' => 'filled|' . Rule::exists('rubrics', 'id'),
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

<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($args): array
    {
        $rules = [
            'content' => 'max:65536',
        ];

        if (!isset($args['images']) && !isset($args['files'])) $rules['content'] .= '|required';

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Message;

use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMessageRequest extends FormRequest
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
        $rules = [
            'content' => 'max:65536',
        ];

        if (auth()->user()->role !== 'admin') {
            $rules['chat_id'] = Rule::exists(ChatUser::class)->where('user_id', auth()->id());
        }

        if (!isset($args['images']) && !isset($args['files'])) $rules['content'] .= '|required';

        return $rules;
    }
}

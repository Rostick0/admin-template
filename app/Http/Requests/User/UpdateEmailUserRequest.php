<?php

namespace App\Http\Requests\User;

use App\Enum\EmailCodeType;
use App\Models\EmailCode;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmailUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true || auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_old' => 'required',
            'email' => 'required|' .  Rule::unique(User::class)->ignore($this->user()->id),
            'code' => 'required|' . Rule::exists(EmailCode::class)
                ->where('email', $this->email_old)
                ->where('type', EmailCodeType::update_email->value),
        ];
    }
}

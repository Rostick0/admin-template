<?php

namespace App\Http\Requests\Auth;

use App\Enum\EmailCodeType;
use App\Models\EmailCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterAuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:255',
            'code' => 'required|' . Rule::exists(EmailCode::class, 'code')
                ->where('email', $this->email)
                ->where('type', EmailCodeType::register->value),
        ];
    }
}

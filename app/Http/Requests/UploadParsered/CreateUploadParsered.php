<?php

namespace App\Http\Requests\UploadParsered;

use App\Enum\UploadParseredType;
use App\Utils\EnumFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUploadParsered extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() || true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:json',
            'type' => ['required', 'in:' . EnumFields::getValidateValues(UploadParseredType::class)]
        ];
    }
}

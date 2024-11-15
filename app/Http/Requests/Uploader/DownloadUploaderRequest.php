<?php

namespace App\Http\Requests\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class DownloadUploaderRequest extends FormRequest
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
            'model' => 'required|in:Product',
            'type' => 'required|in:Csv,Json,Xml'
        ];
    }
}

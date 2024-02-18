<?php

namespace App\Http\Requests\Ordering;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderingRequest extends FormRequest
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
            'name' => 'required|max:255',
            'date' => 'nullable|date',
            'address' => 'required|max:255',
            'status' => 'required|in:pending,draft',
        ];

        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'required|in:pending,canceled,draft,completed,rejected';

            $rules['reason'] = 'nullable';
        }

        return $rules;
    }
}

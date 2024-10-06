<?php

namespace App\Http\Requests\Ordering;

use App\Enum\OrderingStatusType;
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
            'date' => 'required|date',
            'address' => 'required|max:255',
            'status' => 'filled|in:' . implode(',', [OrderingStatusType::canceled->value, OrderingStatusType::draft->value, OrderingStatusType::pending->value]),
            'product_ids' => ['required', 'regex:/^\d+(,\d+)*$/'],
            'product_quantity' => ['required', 'regex:/^\d+(,\d+)*$/'],
        ];

        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'required|in:pending,canceled,draft,completed,rejected';

            $rules['reason'] = 'nullable';
        }

        return $rules;
    }
}

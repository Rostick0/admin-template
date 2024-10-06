<?php

namespace App\Http\Requests\Ordering;

use App\Enum\OrderingStatusType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false && auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($args): array
    {
        $rules = [
            'name' => 'filled|max:255',
            'date' => 'filled|date',
            'address' => 'filled|max:255',
            'status' => 'filled|in:' . implode(',', [OrderingStatusType::canceled->value, OrderingStatusType::draft->value, OrderingStatusType::pending->value]),
            'product_ids' => ['required', 'regex:/^\d+(,\d+)*$/'],
            'product_quantity' => ['required', 'regex:/^\d+(,\d+)*$/'],
        ];

        if (auth()->user()->role === 'admin') {
            $rules['status'] = 'filled|in:' . implode(',', [OrderingStatusType::working->value, OrderingStatusType::completed->value, OrderingStatusType::rejected->value]);

            if ($args['status'] === OrderingStatusType::rejected->value) {
                $rules['reason'] = 'required|max:255';
            }
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Rubric;

use App\Models\Rubric;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRubricRequest extends FormRequest
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
        return [
            'name' => ['filled', 'unique:rubrics,name,' . $this->rubric, 'max:255'],
            'link_name' => 'filled|' . Rule::unique(Rubric::class)->ignore($args['id']),
        ];
    }
}

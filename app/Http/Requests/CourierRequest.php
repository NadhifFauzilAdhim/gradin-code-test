<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courierId = $this->route('courier')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('couriers', 'code')->ignore($courierId)],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('couriers', 'email')->ignore($courierId)],
            'phone' => ['nullable', 'string', 'max:30'],
            'service_area' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'integer', 'between:1,5'],
            'is_active' => ['sometimes', 'boolean'],
            'registered_at' => ['nullable', 'date'],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated($key, $default);
        $validated['is_active'] = $this->boolean('is_active');

        return $validated;
    }
}

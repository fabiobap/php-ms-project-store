<?php

namespace App\Http\Requests\Public;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'uuid', 'exists:products,uuid'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'card' => ['required', 'array'],
            'card.number' => ['required', 'string'],
            'card.exp_month' => ['required', 'string'],
            'card.exp_year' => ['required', 'string'],
            'card.cvc' => ['required', 'string'],
            'card.name' => ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\PropertyType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class PropertyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', new Enum(PropertyType::class)],
            'cost_of_acquisition' => ['numeric','min:0'],
            'rooms' => ['numeric','min:0'],
            'baths' => ['numeric','min:0'],
            'parking' => ['numeric','min:0'],
            'area' => ['numeric','min:0'],
            'street' => ['required', 'string'],
            'street_number' => ['required', 'string'],
            'address' => ['string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}

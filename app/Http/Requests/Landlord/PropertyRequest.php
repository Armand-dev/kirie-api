<?php

namespace App\Http\Requests\Landlord;

use App\Enums\CurrencyEnum;
use App\Enums\Landlord\PropertyType;
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
        return auth()->user()->hasRole('landlord');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', new Enum(PropertyType::class)],
            'cost_of_acquisition' => ['numeric','min:0'],
            'cost_of_acquisition_currency' => ['string', new Enum(CurrencyEnum::class)],
            'rooms' => ['numeric','min:0'],
            'baths' => ['numeric','min:0'],
            'parking' => ['numeric','min:0'],
            'area' => ['numeric','min:0'],
            'address.city' => ['required', 'string'],
            'address.country' => ['required', 'string'],
            'address.street' => ['required', 'string'],
            'address.street_number' => ['required', 'string'],
            'address.address' => ['required', 'string'],
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

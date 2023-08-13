<?php

namespace App\Http\Requests\Landlord;

use App\Enums\Landlord\PropertyType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class EquipmentRequest extends FormRequest
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
            'brand' => ['string'],
            'price' => ['numeric', 'min:0'],
            'model' => ['string'],
            'serial' => ['string'],
            'installation_time' => ['date'],
            'warranty_expiration' => ['date'],
            'description' => ['string'],
            'property_id' => ['required', 'exists:App\Models\Landlord\Property,id'],
            'category_id' => ['required', 'exists:App\Models\Landlord\EquipmentCategory,id'],
            'subcategory_id' => ['required', 'exists:App\Models\Landlord\EquipmentSubcategory,id'],
            'thumbnail' => ['file', 'mimes:png,jpg,jpeg'],
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

<?php

namespace App\Http\Requests\Landlord;

use App\Enums\CurrencyEnum;
use App\Enums\Landlord\LeaseStatus;
use App\Enums\Landlord\SignatureType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class LeaseRequest extends FormRequest
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
            'number' => ['required', 'string', 'max:255'],
            'body' => ['required'],
            'signature_type' => ['required','string', new Enum(SignatureType::class)],
            'status' => ['required','string', new Enum(LeaseStatus::class)],
            'start_date' => ['required','date'],
            'end_date' => ['required','date', 'after_or_equal:start_date'],
            'duration' => ['required','numeric', 'min:0'],
            'rent_amount' => ['required','numeric', 'min:0'],
            'rent_currency' => ['required','string', new Enum(CurrencyEnum::class)],
            'additional_people' => ['numeric', 'min:0'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'deposit_currency' => ['required','string', new Enum(CurrencyEnum::class)],
            'due_day' => ['required', 'numeric', 'min:1', 'max:31'],
            'property.id' => ['required', 'numeric', 'exists:App\Models\Landlord\Property,id,deleted_at,NULL'],
            'tenant.id' => ['numeric', 'exists:App\Models\Landlord\Tenant,id,deleted_at,NULL'],
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

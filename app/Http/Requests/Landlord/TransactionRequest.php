<?php

namespace App\Http\Requests\Landlord;

use App\Enums\CurrencyEnum;
use App\Enums\Landlord\TransactionStatus;
use App\Enums\Landlord\TransactionType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
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
            'type' => ['required', 'string', new Enum(TransactionType::class)],
            'date' => ['required', 'date'],
            'status' => ['required', new Enum(TransactionStatus::class)],
            'description' => ['required', 'string', 'max: 20000'],
            'total' => ['required', 'numeric','min:0'],
            'total_currency' => ['required', 'string', new Enum(CurrencyEnum::class)],
            'lease_id' => ['numeric', 'exists:App\Models\Landlord\Lease,id,deleted_at,NULL'],
            'property.id' => ['required', 'numeric', 'exists:App\Models\Landlord\Property,id,deleted_at,NULL'],
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

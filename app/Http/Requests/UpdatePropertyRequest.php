<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePropertyRequest extends FormRequest
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
            'number' => ['string', 'max:255'],
            'body' => ['string'],
            'signature_type' => ['string','in:manual,digital'],
            'status' => ['string','in:active,inactive,pending_signature,pending_commencement,canceled'],
            'start_date' => ['date'],
            'end_date' => ['date', 'after_or_equal:start_date'],
            'duration' => ['numeric', 'min:0'],
            'rent_amount' => ['numeric', 'min:0'],
            'additional_people' => ['numeric', 'min:0'],
            'deposit' => ['numeric', 'min:0'],
            'due_day' => ['numeric', 'min:1', 'max:31'],
            'property_id' => ['numeric', 'min:1', 'max:31', 'exists:App\Models\Property,id'],
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

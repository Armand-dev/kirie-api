<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLeaseRequest extends FormRequest
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
            'number' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'signature_type' => ['required','string','in:manual,digital'],
            'status' => ['required','string','in:active,inactive,pending_signature,pending_commencement,canceled'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date', 'after_or_equal:start_date'],
            'duration' => ['required','numeric', 'min:0'],
            'rent_amount' => ['required','numeric', 'min:0'],
            'additional_people' => ['numeric', 'min:0'],
            'deposit' => ['required', 'numeric', 'min:0'],
            'due_day' => ['required', 'numeric', 'min:1', 'max:31'],
            'property_id' => ['required', 'numeric', 'min:1', 'max:31', 'exists:App\Models\Property,id'],
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

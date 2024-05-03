<?php

namespace App\Http\Requests\Landlord;

use App\Enums\Landlord\DocumentType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Enum;

class DocumentRequest extends FormRequest
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
            'documentable_type' => ['required', 'string', 'in:App\Models\Landlord\Property,App\Models\Landlord\Lease'],
            'documentable_id' => ['required', 'string', 'exists:' . $this->get('documentable_type') . ',id'],
            'type' => ['required', 'string', new Enum(DocumentType::class)],
            'document' => ['required', 'file', 'mimes:pdf,docx,doc'],
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

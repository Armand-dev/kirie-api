<?php

namespace App\Http\Requests\Landlord;

use App\Enums\CurrencyEnum;
use App\Enums\Landlord\PropertyType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;

class OlxListingRequest extends FormRequest
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
            'property.id' => ['required', 'numeric', 'exists:App\Models\Landlord\Property,id,deleted_at,NULL'],
            'platform_category_id' => ['required', 'numeric', 'min:1'],
            'title' => [
                'required',
                'min:16',
                'max:70',
                'not_regex:/[\w.-]+@[\w.-]+\.\w+/', // does not allow emails
                'not_regex:/(\+?(\d{1,3}))?[-. (]*(\d{1,3})[-. )]*(\d{1,4})[-. ]*(\d{1,9})/', // does not allow phone numbers
                function ($attribute, $value, $fail) {
                    $disallowed_characters = ['!', '?', '.', ',', '-', '=', '+', '#', '%', '&', '@', '*', '_', '>', '<', ':', '(', ')', '|'];

                    foreach ($disallowed_characters as $char) {
                        if (substr_count($value, str_repeat($char, 3)) > 0) {
                            $fail($attribute.' contains a disallowed character sequence.');
                        }
                    }

                    $uppercase_letters = preg_match_all('/[A-Z]/', $value);
                    if ($uppercase_letters > (mb_strlen($value) / 2)) {
                        $fail($attribute.' contains more than 50% upper case letters.');
                    }
                }
            ],
            'description' => [
                'required',
                'min:80',
                'max:9000',
                'not_regex:/[\w.-]+@[\w.-]+\.\w+/', // does not allow emails
                'not_regex:/(\+?(\d{1,3}))?[-. (]*(\d{1,3})[-. )]*(\d{1,4})[-. ]*(\d{1,9})/', // does not allow phone numbers
                function ($attribute, $value, $fail) {
                    $disallowed_characters = ['!', '?', '.', ',', '-', '=', '+', '#', '%', '&', '@', '*', '_', '>', '<', ':', '(', ')', '|'];

                    foreach ($disallowed_characters as $char) {
                        if (substr_count($value, str_repeat($char, 3)) > 0) {
                            $fail($attribute.' contains a disallowed character sequence.');
                        }
                    }

                    $uppercase_letters = preg_match_all('/[A-Z]/', $value);
                    if ($uppercase_letters > (mb_strlen($value) / 2)) {
                        $fail($attribute.' contains more than 50% upper case letters.');
                    }
                }
            ],
            'price' => ['required', 'numeric', 'min:50', 'max:999999'],
            'currency' => ['required', 'string', new Enum(CurrencyEnum::class)],
            'negotiable' => ['required', 'boolean'],
            'attributes' => ['required', 'array'],
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

<?php

namespace App\Http\Requests\Guest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:40',
            'prenom' => 'required|string|max:40',
            'email' => 'required|email|',
            'devise' => 'required|in:XAF,XOF',
            'pack_id' => 'nullable|exists:packs,id',
            'certif_id' => 'nullable|exists:certifs,id',
            'customer_email' => 'nullable|email',
            'customer_phone_number' => 'nullable|string',
            'customer_address' => 'nullable|string',
            'customer_city' => 'nullable|string',
            'customer_country' => 'nullable|string|max:2',
            'customer_state' => 'nullable|string|max:2',
            'customer_zip_code' => 'nullable|string|max:5',
        ];
    }

    /**
     * Get the custom error messages for validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nom.max' => 'Le nom ne peut pas dépasser 40 caractères.',
            'nom.required' => 'Le nom est requis.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',

            'prenom.required' => 'Le prénom est requis.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser 40 caractères.',

            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email n\'est pas valide.',

            'devise.in' => 'La devise doit être soit XAF, soit XOF.',

            'pack_id.exists' => 'Le pack sélectionné est invalide.',
            'certif_id.exists' => 'Le certificat sélectionné est invalide.',

            'customer_email.email' => 'L\'email du client doit être une adresse valide.',

            'customer_phone_number.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',

            'customer_country.max' => 'Le code du pays ne peut pas dépasser 2 caractères.',

            'customer_state.max' => 'Le code de l\'état ne peut pas dépasser 2 caractères.',

            'customer_zip_code.max' => 'Le code postal ne peut pas dépasser 5 caractères.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'status' => 422,
            'message' => 'Échec de la validation des données.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

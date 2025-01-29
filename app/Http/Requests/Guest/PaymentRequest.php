<?php

namespace App\Http\Requests\Guest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Récupère les règles de validation pour la requête.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'pack_id' => 'required|exists:packs,id',
            'email' => 'required|email',
            'telephone' => 'nullable|regex:/^[0-9]/',
        ];
    }



    /**
     * Récupère les messages d'erreur personnalisés.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'pack_id.required' => 'Le pack est doit etre spécifié',
            'pack_id.exists' => 'Le pack_id doit correspondre à un pack existant.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'telephone.regex' => 'Le numéro de téléphone doit être valide .',
        ];
    }


    /**
     * Gérer l'échec de la validation.
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

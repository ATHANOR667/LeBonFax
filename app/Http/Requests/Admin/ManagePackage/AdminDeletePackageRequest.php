<?php

namespace App\Http\Requests\Admin\ManagePackage;

use Illuminate\Foundation\Http\FormRequest;

class AdminDeletePackageRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Récupère les règles de validation pour la requête.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:packs,id'
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
            'id.required' => 'L\'ID du pack est obligatoire.',
            'id.exists' => 'Le pack n\'existe pas.',
        ];
    }

    /**
     * Gérer l'échec de la validation.
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'status' => 422,
            'message' => 'Échec de la validation des données.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

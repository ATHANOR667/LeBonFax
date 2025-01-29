<?php

namespace App\Http\Requests\Admin\ManagePackage;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdatePackageRequest extends FormRequest
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
            'id' => 'required|exists:packs,id',
            'nom' => 'nullable|string|min:2|max:255',
            'reduction' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'nom.string' => 'Le nom du pack doit être une chaîne de caractères.',
            'nom.min' => 'Le nom du pack doit comporter au moins 2 caractères.',
            'nom.max' => 'Le nom du pack ne peut pas dépasser 255 caractères.',
            'reduction.numeric' => 'La reduction doit être un nombre.',
            'reduction.min' => 'La reduction doit être un nombre positif ou égal à zéro.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les types d\'image autorisés sont : jpeg, png, jpg, gif, svg.',
            'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
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

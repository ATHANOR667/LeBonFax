<?php

namespace App\Http\Requests\Admin\ManageCertif;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateCertifRequest extends FormRequest
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
            'id' => 'required|exists:certifs,id',
            'nom' => 'nullable|string|min:2|max:255',
            'categorie' => 'nullable|string|min:2|max:255',
            'prix' => 'nullable|numeric|min:0',
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
            'id.required' => 'L\'ID de la certif est obligatoire.',
            'id.exists' => 'La certif n\'existe pas.',
            'nom.string' => 'Le nom de la certif doit être une chaîne de caractères.',
            'nom.min' => 'Le nom de la certif doit comporter au moins 2 caractères.',
            'nom.max' => 'Le nom de la certif ne peut pas dépasser 255 caractères.',
            'categorie.string' => 'La categorie du pack doit être une chaîne de caractères.',
            'categorie.min' => 'La categorie du pack doit comporter au moins 2 caractères.',
            'categorie.max' => 'La categorie du pack ne peut pas dépasser 255 caractères.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être un nombre positif ou égal à zéro.',
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

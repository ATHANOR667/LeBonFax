<?php

namespace App\Http\Requests\Admin\ManageCertif;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminCreateCertifRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Récupère les règles de validation pour la requête.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|min:2|max:255',
            'categorie' => 'required|string|min:2|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'lien' => 'nullable|string|max:1000',
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
            'nom.required' => 'Le nom du pack est obligatoire.',
            'nom.string' => 'Le nom du pack doit être une chaîne de caractères.',
            'nom.min' => 'Le nom du pack doit comporter au moins 2 caractères.',
            'nom.max' => 'Le nom du pack ne peut pas dépasser 255 caractères.',
            'categorie.required' => 'La categorie du pack est obligatoire.',
            'categorie.string' => 'La categorie du pack doit être une chaîne de caractères.',
            'categorie.min' => 'La categorie du pack doit comporter au moins 2 caractères.',
            'categorie.max' => 'La categorie du pack ne peut pas dépasser 255 caractères.',
            'prix.required' => 'La prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être un nombre positif ou égal à zéro.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'lien.string' => 'Le lien doit être une chaîne de caractères.',
            'lien.max' => 'Le lien ne peut pas dépasser 1000 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les types d\'image autorisés sont : jpeg, png, jpg, gif, svg.',
            'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
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

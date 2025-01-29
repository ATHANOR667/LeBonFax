<?php

namespace App\Http\Requests\Admin\ManagePackage;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminCreatePackageRequest extends FormRequest
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
            'reduction' => 'required|numeric|min:0',
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
            'nom.required' => 'Le nom du pack est obligatoire.',
            'nom.string' => 'Le nom du pack doit être une chaîne de caractères.',
            'nom.min' => 'Le nom du pack doit comporter au moins 2 caractères.',
            'nom.max' => 'Le nom du pack ne peut pas dépasser 255 caractères.',
            'reduction.required' => 'La reduction est obligatoire.',
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

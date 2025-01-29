<?php

namespace App\Http\Requests\Admin\ManageEvent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminCreateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|min:2|max:255',
            'description' => 'required|string|max:1000',
            'date' => 'required|date',
            'lien' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre de l\'événement est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.min' => 'Le titre doit comporter au moins 2 caractères.',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'description.max' => 'La description ne peut pas dépasser 1000 caractères.',
            'description.required' => 'La description est obligatoire.',
            'date.required' => 'La date de l\'événement est obligatoire.',
            'date.date' => 'La date doit être une date valide.',
            'lien.string' => 'Le lien doit être une chaîne de caractères.',
            'lien.max' => 'Le lien ne peut pas dépasser 1000 caractères.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les types d\'image autorisés sont : jpeg, png, jpg, gif, svg.',
            'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'status' => 422,
            'message' => 'Échec de la validation des données.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

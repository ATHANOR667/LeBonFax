<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ContactUsRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette demande.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la demande.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:20|string',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:3|max:500|string',
        ];
    }

    /**
     * Messages personnalisés pour la validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le champ nom est obligatoire',
            'name.min' => 'le champ name fait minimum 3 caractères',
            'name.max' => 'le champ name fait maximum 20 caractères',
            'email.required' => 'Le champ email est obligatoire',
            'email.email' => 'Le champ email n\'est pas valide',
            'subject.required' => 'le champ sujet est obligatoire',
            'message.required' => 'le champ message est obligatoire',
            'message.min' => 'le champ message fait minimum 3 caractères',
            'message.max' => 'le champ message fait maximum 500 caractères',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'status' => 422,
            'message' => 'Échec de la validation des données.',
            'errors' => $validator->errors(),
        ], 422));
    }
}

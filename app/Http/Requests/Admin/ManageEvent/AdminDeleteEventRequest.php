<?php

namespace App\Http\Requests\Admin\ManageEvent;

use Illuminate\Foundation\Http\FormRequest;

class AdminDeleteEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:events,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'L\'ID de l\'événement est obligatoire.',
            'id.exists' => 'L\'événement n\'existe pas.',
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

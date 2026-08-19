<?php

namespace App\Http\Requests\Administration;

use App\Lib\FieldName;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('admin');
        return [
            FieldName::NOM => 'sometimes|string|max:255',
            FieldName::PRENOM => 'sometimes|string|max:255',
            FieldName::TELEPHONE => 'sometimes|numeric', 
            FieldName::EMAIL => 'sometimes|email|unique:' . User::class . ',' . FieldName::EMAIL . ',' . $adminId . ',' . FieldName::ID,
            FieldName::PASSWORD => ['sometimes','string','confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&]).{8,}$/'
            ],
            FieldName::ROLE_ID => 'sometimes|exists:role,id',
        ];
    }

    public function messages(): array
    {
        return [
            FieldName::TELEPHONE . '.numeric' => 'Le numéro de téléphone doit être un nombre.',
            FieldName::EMAIL . '.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            FieldName::EMAIL . '.unique' => 'L\'adresse e-mail est déjà utilisée.',
            FieldName::PASSWORD . '.regex' => 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.',
            FieldName::PASSWORD . '.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            FieldName::ROLE_ID . '.exists' => 'Le rôle sélectionné est invalide.',
        ];
    }
}

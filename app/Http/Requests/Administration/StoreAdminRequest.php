<?php

namespace App\Http\Requests\Administration;

use App\Lib\FieldName;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
        return [
            FieldName::NOM => 'required|string',
            FieldName::PRENOM => 'required|string',
            FieldName::TELEPHONE => 'required|numeric',
            FieldName::EMAIL => 'required|email|unique:' . User::class . ',' . FieldName::EMAIL,
            FieldName::PASSWORD => ['required','string','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&]).{8,}$/'],
            FieldName::ROLE_ID => 'required|exists:role,id',
        ];
    }

     public function messages(): array
    {
        return [
            FieldName::NOM . '.required' => 'Le nom est requis.',
            FieldName::PRENOM . '.required' => 'Le prénom est requis.',
            FieldName::TELEPHONE . '.required' => 'Le numéro de téléphone est requis.',
            FieldName::TELEPHONE . '.numeric' => 'Le numéro de téléphone doit être un nombre.',
            FieldName::EMAIL . '.required' => 'L\'adresse e-mail est requise.',
            FieldName::EMAIL . '.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            FieldName::EMAIL . '.unique' => 'L\'adresse e-mail est déjà utilisée.',
            FieldName::PASSWORD . '.required' => 'Le mot de passe est requis.',
            FieldName::PASSWORD . '.regex' => 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.',
            FieldName::ROLE_ID . '.required' => 'Le rôle est requis.',
            FieldName::ROLE_ID . '.exists' => 'Le rôle sélectionné est invalide.',    
        ];
    }
}

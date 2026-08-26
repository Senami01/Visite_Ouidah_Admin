<?php

namespace App\Http\Requests\UtilisateursMobile;
use App\Lib\FieldName;
use App\Lib\TableName;
use Illuminate\Validation\Rule;
use App\Lib\Constant;
use Illuminate\Foundation\Http\FormRequest;

class StoreUtiliMobileRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            FieldName::NOM => 'required|string|max:255',
            FieldName::PRENOM => 'required|string|max:255',
            FieldName::EMAIL => 'required|string|email|max:255|unique:utilisateurs_mobile,' . FieldName::EMAIL,
            FieldName::TELEPHONE => 'required|numeric',
            FieldName::PAYS => 'required|string|max:100',
            FieldName::ROLE => 'required|string|max:50',
             FieldName::ACTEUR_MOBILE_ID => [
                'required',
                'uuid',
                Rule::exists(TableName::USERS, FieldName::ID)->where(function ($query) {
                    $query->where(FieldName::TYPE, Constant::ACTEUR_MOBILE);
                }),
            ],
            FieldName::STATUT => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            FieldName::EMAIL . '.unique' => 'Cette adresse email est déjà utilisée.',
            FieldName::ACTEUR_MOBILE_ID . '.exists' => 'L\'acteur mobile sélectionné n\'existe pas.',
        ];
    }
}

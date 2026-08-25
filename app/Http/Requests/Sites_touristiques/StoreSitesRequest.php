<?php

namespace App\Http\Requests\Sites_touristiques;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Lib\FieldName;
use App\Lib\Constant;
use App\Lib\TableName;
use Illuminate\Validation\Rule;

class StoreSitesRequest extends FormRequest
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
            FieldName::CATEGORIE => 'required|string',
            FieldName::LATITUDE => 'required|numeric',
            FieldName::LONGITUDE => 'required|numeric',
            FieldName::ACCES => 'required|string',
            FieldName::COURTE_DESCRIPTION => 'required|string',
            FieldName::A_PROPOS_TITRE => 'required|string',
            FieldName::A_PROPOS_DESCRIPTION => 'required|string',
            FieldName::CONSEILS_PRATIQUES => 'required|string',
            FieldName::TYPE_TARIFICATION => ['required', Rule::in([Constant::UNIQUE, Constant::DOUBLE])],
            FieldName::OUVERT_24_7 => 'required|boolean',
            FieldName::STATUT => ['required', Rule::in([Constant::BROUILLON, Constant::PUBLIE, Constant::DESACTIVE])],
            FieldName::ACTEUR_MOBILE_ID => ['required', 'uuid', Rule::exists(TableName::UTILISATEURS_MOBILE, FieldName::ID)],
            FieldName::CREATED_BY => [
                'required',
                'uuid',
                Rule::exists(TableName::USERS, FieldName::ID)->where(function ($query) {
                    $query->where(FieldName::TYPE, Constant::ADMINISTRATEUR);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            FieldName::NOM . '.required' => 'Le nom est requis.',
            FieldName::CATEGORIE . '.required' => 'La catégorie est requise.',
            FieldName::INDICATIONS . '.required' => 'Les indications sont requises.',
            FieldName::LATITUDE . '.numeric' => 'La latitude doit être un nombre valide.',
            FieldName::LONGITUDE . '.numeric' => 'La longitude doit être un nombre valide.',
            FieldName::ACTEUR_MOBILE_ID . '.uuid' => "L'ID de l'acteur mobile doit être un UUID valide.",
            FieldName::CREATED_BY . '.required' => 'L\'ID de l\'utilisateur créateur est requis.',
            FieldName::CREATED_BY . '.uuid' => "L'ID de l'utilisateur créateur doit être un UUID valide.",
            FieldName::OUVERT_24_7 . '.boolean' => 'Le champ "ouvert 24/7" doit être vrai ou faux.',
            FieldName::STATUT . '.required' => 'Le statut est requis.',
            FieldName::ACCES . '.required' => "Le champ d'accès est requis.",
            FieldName::A_PROPOS_TITRE . '.required' => 'Le titre "À propos" est requis.',
            FieldName::A_PROPOS_DESCRIPTION . '.required' => 'La description "À propos" est requise.',
            FieldName::CONSEILS_PRATIQUES . '.required' => 'Les conseils pratiques sont requis.',
            FieldName::TYPE_TARIFICATION . '.required' => 'Le type de tarification est requis.',
           
        ];
    }
}

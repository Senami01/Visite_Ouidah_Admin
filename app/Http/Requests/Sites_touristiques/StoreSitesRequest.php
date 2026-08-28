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
            
            FieldName::ACTEUR_MOBILE_ID => ['required', 'uuid', Rule::exists(TableName::USERS, FieldName::ID)->where(function ($query) {
                $query->where(FieldName::TYPE, Constant::ACTEUR_MOBILE);
            })],
            FieldName::CREATED_BY => ['required', 'uuid', Rule::exists(TableName::USERS, FieldName::ID)->where(function ($query) {
                $query->where(FieldName::TYPE, Constant::ADMINISTRATEUR);
            })],

            'medias' => 'nullable|array',
            'medias.*.' . FieldName::TYPE => 'required|string',
            'medias.*.' . FieldName::URL => 'required|string',
            'medias.*.' . FieldName::EST_COUVERTURE => 'required|boolean',
            'medias.*.' . FieldName::ORDRE => 'required|integer',

            'horaires' => 'nullable|array',
            'horaires.*.' . FieldName::JOUR => 'required|string',
            'horaires.*.' . FieldName::OUVERTURE => 'required|date_format:H:i',
            'horaires.*.' . FieldName::FERMETURE => 'required|date_format:H:i',

            'tarifs' => 'nullable|array',
            'tarifs.*.' . FieldName::LIBELLE => 'required|string',
            'tarifs.*.' . FieldName::CODE => 'nullable|string',
            'tarifs.*.' . FieldName::MONTANT => 'required|numeric',

            'frais_supp' => 'nullable|array',
            'frais_supp.*.' . FieldName::LIBELLE => 'required|string',
            'frais_supp.*.' . FieldName::MONTANT => 'required|numeric',
            'frais_supp.*.' . FieldName::PAR_EPASS => 'required|boolean',
        ];

    }

    public function messages(): array
    {
        return [
            FieldName::NOM . '.required' => 'Le nom est requis.',
            FieldName::CATEGORIE . '.required' => 'La catégorie est requise.',
            FieldName::LATITUDE . '.numeric' => 'La latitude doit être un nombre valide.',
            FieldName::LONGITUDE . '.numeric' => 'La longitude doit être un nombre valide.',
            FieldName::ACTEUR_MOBILE_ID . '.uuid' => "L'ID de l'acteur mobile doit être un UUID valide.",
            FieldName::OUVERT_24_7 . '.boolean' => 'Le champ "ouvert 24/7" doit être vrai ou faux.',
            FieldName::STATUT . '.required' => 'Le statut est requis.',
            FieldName::ACCES . '.required' => "Le champ d'accès est requis.",
            FieldName::A_PROPOS_TITRE . '.required' => 'Le titre "À propos" est requis.',
            FieldName::A_PROPOS_DESCRIPTION . '.required' => 'La description "À propos" est requise.',
            FieldName::CONSEILS_PRATIQUES . '.required' => 'Les conseils pratiques sont requis.',
            FieldName::TYPE_TARIFICATION . '.required' => 'Le type de tarification est requis.',
            
            'horaires.*.' . FieldName::JOUR . '.required' => 'Le jour de la semaine est obligatoire.',
            'horaires.*.' . FieldName::OUVERTURE . '.required' => "L'heure d'ouverture est obligatoire.",
            'horaires.*.' . FieldName::OUVERTURE . '.date_format' => "L'heure d'ouverture doit être au format HH:MM.",
            'horaires.*.' . FieldName::FERMETURE . '.required' => 'Le heure de fermeture est obligatoire.',
            'horaires.*.' . FieldName::FERMETURE . '.date_format' => 'Le heure de fermeture doit être au format HH:MM.',

            'medias.*.' . FieldName::TYPE . '.required' => 'Le type de média (image/vidéo) est obligatoire.',
            'medias.*.' . FieldName::URL . '.required' => "L'URL du média est obligatoire.",
            'medias.*.' . FieldName::EST_COUVERTURE . '.boolean' => 'Le champ couverture doit être un booléen (vrai ou faux).',

            'tarifs.*.' . FieldName::LIBELLE . '.required' => 'Le libellé du tarif est obligatoire.',
            'tarifs.*.' . FieldName::MONTANT . '.required' => 'Le montant du tarif est obligatoire.',
            'tarifs.*.' . FieldName::MONTANT . '.numeric' => 'Le montant du tarif doit être un nombre.',

            'frais_supplementaires.*.' . FieldName::LIBELLE . '.required' => 'Le libellé des frais supplémentaires est obligatoire.',
            'frais_supplementaires.*.' . FieldName::MONTANT . '.required' => 'Le montant des frais supplémentaires est obligatoire.',
            'frais_supplementaires.*.' . FieldName::MONTANT . '.numeric' => 'Le montant des frais supplémentaires doit être un nombre.',
        ];
    }
}

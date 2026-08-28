<?php
namespace App\Http\Requests\Sites_touristiques;

use App\Lib\FieldName; // Ajustez le namespace selon votre projet
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Lib\Constant;

class UpdateSiteRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prépare les données pour la validation.
     * On en profite pour vérifier le format de l'ID ici.
     */
    protected function prepareForValidation()
    {
        $siteId = $this->route('id') ?? $this->route('sites_touristique');

        if (!Str::isUuid($siteId)) {
            abort(response()->json([
                'success' => false,
                'message' => "Site touristique non trouvé.",
                'data' => []
            ], 404));
        }
    }

    /**
     * Obtenir les règles de validation qui s'appliquent à la requête.
     */
    public function rules(): array
    {
        return [
            FieldName::NOM                => 'sometimes|required|string',
            FieldName::CATEGORIE           => 'nullable|string',
            FieldName::LATITUDE            => 'nullable|numeric',
            FieldName::LONGITUDE           => 'nullable|numeric',
            FieldName::ACTEUR_MOBILE_ID    => 'nullable|uuid',
            FieldName::COURTE_DESCRIPTION => 'nullable|string',
            FieldName::INDICATIONS         => 'nullable|string',
            FieldName::A_PROPOS_TITRE      => 'nullable|string',
            FieldName::A_PROPOS_DESCRIPTION => 'nullable|string',
            FieldName::CONSEILS_PRATIQUES  => 'nullable|string',
            FieldName::TYPE_TARIFICATION   => 'nullable|string',
            FieldName::OUVERT_24_7         => 'nullable|boolean',
            FieldName::STATUT              => 'nullable|string',
            'medias' => 'nullable|array',
            'medias.*.' . FieldName::ID => 'sometimes|uuid',
            'medias.*.' . FieldName::TYPE => ['required', Rule::in([Constant::IMAGE, Constant::VIDEO])],
            'medias.*.' . FieldName::URL => 'nullable|string',
            'medias.*.' . FieldName::EST_COUVERTURE => 'nullable|boolean',
            'medias.*.' . FieldName::ORDRE => 'nullable|integer',
            'horaires' => 'nullable|array',
            'horaires.*.' . FieldName::ID => 'sometimes|uuid',
            'horaires.*.' . FieldName::JOUR => 'nullable|string',
            'horaires.*.' . FieldName::OUVERTURE => 'nullable|date_format:H:i',
            'horaires.*.' . FieldName::FERMETURE => 'nullable|date_format:H:i',
            'tarifs' => 'nullable|array',
            'tarifs.*.' . FieldName::ID => 'sometimes|uuid',
            'tarifs.*.' . FieldName::LIBELLE => 'nullable|string',
            'tarifs.*.' . FieldName::CODE => 'nullable|string',
            'tarifs.*.' . FieldName::MONTANT => 'nullable|numeric',

            'frais_supp' => 'nullable|array',
            'frais_supp.*.' . FieldName::ID => 'sometimes|uuid',
            'frais_supp.*.' . FieldName::LIBELLE => 'nullable|string',
            'frais_supp.*.' . FieldName::MONTANT => 'nullable|numeric',
            'frais_supp.*.' . FieldName::PAR_EPASS => 'nullable|boolean',

        ];
    }
}

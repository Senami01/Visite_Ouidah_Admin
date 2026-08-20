<?php

namespace App\Http\Requests\Sites_touristiques;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Lib\FieldName;

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
            FieldName::CATEGORIE => 'nullable|string',
            FieldName::LATITUDE => 'nullable|numeric',
            FieldName::LONGITUDE => 'nullable|numeric',
            FieldName::ACTEUR_MOBILE_ID => 'nullable|uuid',
            FieldName::COURTE_DESCRIPTION => 'nullable|string',
            FieldName::INDICATIONS => 'nullable|string', 
            FieldName::CREATED_BY => 'required|uuid',
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
        ];
    }
}

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
            FieldName::LATITUDE => 'nullable|decimal',
            FieldName::LONGITUDE => 'nullable|decimal',
            FieldName::SITE_ID => 'nullable|string',

        ];
    }
}

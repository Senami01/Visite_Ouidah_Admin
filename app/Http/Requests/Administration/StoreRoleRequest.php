<?php

namespace App\Http\Requests\Administration;

use App\Lib\FieldName;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            FieldName::NOM => 'required|string|unique:role,' . FieldName::NOM,
            FieldName::DESCRIPTION => 'nullable|string',
        ];
    }

     public function messages(): array
    {
        return [
            FieldName::NOM . '.required' => 'Le nom du rôle est requis.',
            FieldName::NOM . '.unique' => 'Ce nom de rôle existe déjà.',
        ];
    }
}

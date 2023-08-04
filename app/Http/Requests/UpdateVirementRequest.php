<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVirementRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'beneficiaire_id' => ["nullable", "numeric", "sometimes"],
            "nom_banque" => ["nullable", "string", "sometimes"],
            "rib" => ["nullable", "string","min:24", "max:24", "sometimes"],
            "code_swift" => ["nullable", "string","min:8", "max:11", "sometimes"],
            "adresse" => ["nullable", "string", "sometimes"],
            'montant' => ['required', 'numeric', "sometimes"],
            'date' => ['required', 'date', "sometimes"],
            'description' => ['required', "sometimes"],
        ];
    }
}

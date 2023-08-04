<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdreVirement extends FormRequest
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
            'beneficiaire_id' => ["nullable", "numeric"],
            "nom_banque" => ["nullable", "string"],
            "rib" => ["nullable", "string", "min:24", "max:24"],
            "code_swift" => ["nullable", "string", "min:8", "max:11"],
            "adresse" => ["nullable", "string"],
            'montant' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['required'],
        ];
    }
}

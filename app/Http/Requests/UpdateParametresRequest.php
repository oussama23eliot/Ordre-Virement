<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParametresRequest extends FormRequest
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
            "nom_societe" => ["sometimes", "nullable", "string"],
            "adresse_societe" => ["sometimes", "nullable", "string"],
            "numero_societe" => ["sometimes", "nullable", "string"],
            "email_societe" => ["sometimes", "nullable", "email"],
            "adresse_banque" => ["sometimes", "nullable", "string"],
            "nom_banque" => ["sometimes", "nullable", "string"],
            "rib" => ["sometimes", "nullable", "string", "min:24", "max:24"],
            "code_swift" => ["sometimes", "nullable", "string", "min:8", "max:11"],
        ];
    }
}

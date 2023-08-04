<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virements extends Model
{
    use HasFactory;
    protected $fillable = ['beneficiaires_id', "nom_beneficiaire", "nom_banque", "rib", "code_swift", 'montant', "adresse_agence", 'date', 'description', 'status'];

    protected function nom_beneficiaire()
    {
        return ucfirst($this->nom_beneficiaire);
    }
    public function beneficiaire()
    {
        return $this->belongsTo(Beneficiaires::class);
    }
}

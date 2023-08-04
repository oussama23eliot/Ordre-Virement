<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaires extends Model
{
    use HasFactory;
    protected $fillable = ["nom_beneficiaire", "nom_banque", "rib", "code_swift",  "adresse_agence"];
    protected function nom_beneficiaire()
    {
        return ucfirst($this->nom_beneficiaire);
    }
    public function virements()
    {
        return $this->hasMany(Virements::class);
    }
}

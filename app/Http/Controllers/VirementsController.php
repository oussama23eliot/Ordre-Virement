<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdreVirement;
use App\Http\Requests\UpdateVirementRequest;
use App\Models\Beneficiaires;
use App\Models\Parametres;
use App\Models\Virements;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Inertia\Response;

use PDF;


class VirementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Virements::all();
        return Inertia::render('OrdreVirement', [
            'orders' => $data,
            'loggedin' => auth()->user(),
            'fournisseurs' => Beneficiaires::all(['id', 'nom_beneficiaire'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdreVirement $request)
    {
        $virement = new Virements();
        if ($request['beneficiaire_id']) {
            $virement->beneficiaire_id = $request['beneficiaire_id'];
            $beneficiare = Beneficiaires::FindOrFail($virement->beneficiaire_id);
            $virement->nom_beneficiaire = $beneficiare->nom_beneficiaire;
            $virement->nom_banque = $beneficiare->nom_banque;
            $virement->rib = $beneficiare->rib;
            $virement->code_swift = $beneficiare->code_swift;
            $virement->adresse_agence = $beneficiare->adresse_agence;
        } else {
            $virement->beneficiaire_id = null;
            $virement->nom_beneficiaire = $request['nom_beneficiaire'];
            $virement->nom_banque = $request['nom_banque'];
            $virement->rib = $request['rib'];
            $virement->code_swift = $request['code_swift'];
            $virement->adresse_agence = $request['adresse_agence'];
        }
        $virement->montant = $request['montant'];
        $virement->date = $request['date'];
        $virement->description = $request['description'];
        if ($virement->save()) {
            return to_route('virements.index')->with('message', 'Ordre de virement créer avec succès!');
        }
        return to_route('virements.index')->with('error', "Création de l'ordre de virement a échoué!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Virements $virements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVirementRequest $request, $id)
    {
        $virement = Virements::FindOrFail($id);
        if ($virement->update($request->all()))
            return to_route('virements.index')->with('message', 'Ordre de virement est mis à jour avec succès!');
        return to_route('virements.index')->with('error', 'mise à jour de ordre de virement a échouée!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $virement = Virements::FindOrFail($id);
        if ($virement) {
            $virement->delete();
            return to_route('virements.index')->with('message', 'Ordre de virement Supprimé avec succès!');
        };
        return to_route('virements.index')->with('error', 'Erreur apprut lors de suppression Ordre de virement !!');
    }

    public function generate_pdf($id)
    {
        $virement = Virements::FindOrFail($id);
        $virement = ['title' => "ordre_de_virement_" . $virement['nom_beneficiaire'] . "_" . $virement['date'], "virement" => $virement, "contact" => Parametres::all()];
        $pdf = PDF::loadView('pdf_virement', $virement);
        return $pdf->stream();
    }
}

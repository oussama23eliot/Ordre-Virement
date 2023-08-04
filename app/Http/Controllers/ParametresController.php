<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateParametresRequest;
use App\Models\Parametres;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ParametresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = [
            "nom_societe" => Parametres::get("nom_societe"),
            "adresse_societe" => Parametres::get("adresse_societe"),
            "numero_societe" => Parametres::get("numero_societe"),
            "email_societe" => Parametres::get("email_societe"),
            "nom_banque" => Parametres::get("nom_banque"),
            "adresse_banque" => Parametres::get("adresse_banque"),
            "rib" => Parametres::get("rib"),
            "code_swift" => Parametres::get("code_swift")
        ];
        return Inertia::render('ProfileSociete', [
            'data' => $data,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Parametres $parametres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parametres $parametres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAll(UpdateParametresRequest $request)
    {
        $requestData = $request->all();
        try {
            Parametres::set("nom_societe", $requestData["nom_societe"]);
            Parametres::set("adresse_societe", $requestData["adresse_societe"]);
            Parametres::set("numero_societe", $requestData["numero_societe"]);
            Parametres::set("email_societe", $requestData["email_societe"]);
            Parametres::set("nom_banque", $requestData["nom_banque"]);
            Parametres::set("adresse_banque", $requestData["adresse_banque"]);
            Parametres::set("rib", $requestData["rib"]);
            Parametres::set("code_swift", $requestData["code_swift"]);
        } catch (Exception $err) {
            return Redirect::route('params')->with('error', 'Erreur apprut lors de modification !!');
        }
        return Redirect::route('params')->with('message', 'Modification  avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parametres $parametres)
    {
        //
    }
}

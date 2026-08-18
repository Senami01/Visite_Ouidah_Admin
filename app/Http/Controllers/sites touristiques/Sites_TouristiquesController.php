<?php

namespace App\Http\Controllers;
use App\Models\Sites_Touristiques;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController\BaseController;

class Sites_TouristiquesController extends BaseController
{
    public function index()
    {
        $sites = Sites_Touristiques::all();
        return $this->sendResponse(
            $sites,
            "Liste des sites touristiques récupérée avec succès."
        );
    }

    public function changementStatus($id)
    {
        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", 404);
        }

        $site->statut = $site->statut === 'actif' ? 'inactif' : 'actif';
        $site->save();

        return $this->sendResponse(
            $site, "Statut du site touristique mis à jour avec succès."
        );
    }

     public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'adresse' => 'nullable|string|max:255',
        ]);

        $site = Sites_Touristiques::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'adresse' => $request->adresse,
            'statut' => 'actif',
        ]);

        return $this->sendResponse(
            $site,
            "Site touristique créé avec succès.",
            201
        );
    }

    public function show($id)
    {
         

    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
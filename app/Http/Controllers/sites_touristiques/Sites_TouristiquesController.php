<?php

namespace App\Http\Controllers\sites_touristiques;
use App\Models\Sites_Touristiques;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Sites_touristiques\StoreSitesRequest;
use App\Http\Resources\Sites_Touristiques\SitesTouristiquesResource;

class Sites_TouristiquesController extends BaseController
{
    public function index()
    {
        $sites = Sites_Touristiques::all();
        return $this->sendResponse(SitesTouristiquesResource::collection($sites),
            "Liste des sites touristiques récupérée avec succès."
        );
    }

    public function changementStatus($id)
    {
        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site->statut = $site->statut === 'actif' ? 'inactif' : 'actif';
        $site->save();

        return $this->sendResponse(
            new SitesTouristiquesResource($site), "Statut du site touristique mis à jour avec succès."
        );
    }

     public function store(StoreSitesRequest $request)
    {   
       $validation = $request->validated();
    $site = Sites_Touristiques::create($validation);
    
    return $this->sendResponse(
        new SitesTouristiquesResource($site),
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
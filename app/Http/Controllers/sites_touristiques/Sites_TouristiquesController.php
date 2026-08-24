<?php

namespace App\Http\Controllers\sites_touristiques;

use App\Models\Sites_Touristiques;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Sites_touristiques\StoreSitesRequest;
use App\Http\Resources\Sites_Touristiques\SitesTouristiquesResource;
use Illuminate\Support\Str;
use App\Lib\FieldName;
use App\Lib\Constant;

class Sites_TouristiquesController extends BaseController
{
    public function index()
    {
        $sites = Sites_Touristiques::all();
        return $this->sendResponse(
            SitesTouristiquesResource::collection($sites),
            "Liste des sites touristiques récupérée avec succès."
        );
    }

    public function changementStatus($id)
    {
        if (!Str::isUuid($id)) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site->statut = $site->statut === Constant::PUBLIE ? Constant::DESACTIVE : Constant::PUBLIE;
        $site->save();

        return $this->sendResponse(
            new SitesTouristiquesResource($site), 
            "Statut du site touristique mis à jour avec succès."
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
        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }
        return $this->sendResponse(
            new SitesTouristiquesResource($site), 
            "Site touristique récupéré avec succès."
        );
    }

    public function update(Request $request, $id)
    {
        if (!Str::isUuid($id)) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $validatedData = $request->validate([
            FieldName::NOM => 'sometimes|required|string',
            FieldName::CATEGORIE => 'nullable|string',
            FieldName::LATITUDE => 'nullable|numeric',
            FieldName::LONGITUDE => 'nullable|numeric',
            FieldName::ACTEUR_MOBILE_ID => 'nullable|uuid',
            FieldName::COURTE_DESCRIPTION => 'nullable|string',
            FieldName::INDICATIONS => 'nullable|string',
        ]);

        $site->update($validatedData);
        
        return $this->sendResponse(
            new SitesTouristiquesResource($site),
            "Site touristique modifié avec succès."
        );
    }

    public function destroy($id)
    {
        
        if (!Str::isUuid($id)) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site = Sites_Touristiques::find($id);
        if (!$site) {
            return $this->sendError("Site touristique non trouvé.", [], 404);
        }

        $site->delete();
        return $this->sendResponse(null, "Site touristique supprimé avec succès.");
    }
}

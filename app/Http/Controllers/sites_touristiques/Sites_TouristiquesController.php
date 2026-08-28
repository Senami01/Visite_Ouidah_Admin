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
use App\Lib\Helper;

class Sites_TouristiquesController extends BaseController
{
    protected $recherche = [
        FieldName::TYPE_TARIFICATION,
        FieldName::CATEGORIE,
    ];

    public function index()
    {
        $requete = Sites_Touristiques::orderBy(FieldName::CREATED_AT, 'desc'); 
        $requete = Helper::filtrer($requete, $this->recherche);
        $page = $requete->paginate(env('PAGE'));
        $reponse = SitesTouristiquesResource::collection($page)->toResponse(request())->getData();
        return $this->sendResponse($reponse, "Liste des sites touristiques récupérée avec succès.");
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
        $siteDonnee = collect($validation)->except(['horaires', 'medias', 'tarifs', 'frais_supp'])->toArray();
        $site = Sites_Touristiques::create($siteDonnee);

        if (!empty($validation['horaires'])) {
            $site->horaires()->createMany($validation['horaires']);
        }

        if (!empty($validation['medias'])) {
            $site->medias()->createMany($validation['medias']);
        }

        if (!empty($validation['tarifs'])) {
            $site->tarifs()->createMany($validation['tarifs']);
        }

        if (!empty($validation['frais_supp'])) {
            $site->fraisSupplementaires()->createMany($validation['frais_supp']);
        }
        $site->load(['horaires', 'medias', 'tarifs', 'fraisSupplementaires']);

        return $this->sendResponse(new SitesTouristiquesResource($site), 'Site touristique et ses configurations enregistrés avec succès.',201);
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

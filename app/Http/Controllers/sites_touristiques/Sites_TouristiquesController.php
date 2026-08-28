<?php

namespace App\Http\Controllers\sites_touristiques;

use App\Models\Sites_Touristiques;
use App\Http\Requests\Sites_touristiques\UpdateSiteRequest;
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


public function update(UpdateSiteRequest $request, $id) 
{ 
    $site = Sites_Touristiques::find($id); 
    
    if (!$site) { 
        return $this->sendError("Site touristique non trouvé.", [], 404); 
    } 
    $validatedData = $request->validated(); 

    $siteData = $validatedData;
    unset(
        $siteData['horaires'],
        $siteData['medias'],
        $siteData['tarifs'],
        $siteData['frais_supp']
    );

    $site->update($siteData);

    $this->modifierHoraires($site, $validatedData);
    $this->modifierMedias($site, $validatedData);
    $this->modifierTarifs($site, $validatedData);
    $this->modifierFraisSupplementaires($site, $validatedData);

    $site->load(['horaires', 'medias', 'tarifs', 'fraisSupplementaires']);
    
    return $this->sendResponse( 
        new SitesTouristiquesResource($site), 
        "Site touristique modifié avec succès." 
    ); 
}

    private function modifierHoraires(Sites_Touristiques $site, array $data): void
    {
        if (!empty($data['horaires'])) {
            foreach ($data['horaires'] as $horaire) {
                $this->modifierRelation($site->horaires(), $horaire);
            }
        }
    }

    private function modifierMedias(Sites_Touristiques $site, array $data): void
    {
        if (!empty($data['medias'])) {
            foreach ($data['medias'] as $media) {
                $this->modifierRelation($site->medias(), $media);
            }
        }
    }

    private function modifierTarifs(Sites_Touristiques $site, array $data): void
    {
        if (!empty($data['tarifs'])) {
            foreach ($data['tarifs'] as $tarif) {
                $this->modifierRelation($site->tarifs(), $tarif);
            }
        }
    }

    private function modifierFraisSupplementaires(Sites_Touristiques $site, array $data): void
    {
        if (!empty($data['frais_supp'])) {
            foreach ($data['frais_supp'] as $frais) {
                $this->modifierRelation($site->fraisSupplementaires(), $frais);
            }
        }
    }

    private function modifierRelation($relation, array $donnee): void
    {
        $id = $donnee[FieldName::ID] ?? null;
        unset($donnee[FieldName::ID]);

        if ($id) {
            $relation->where(FieldName::ID, $id)->update($donnee);
            return;
        }

        $relation->create($donnee);
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

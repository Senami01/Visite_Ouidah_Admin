<?php

namespace App\Http\Controllers\visiteurs;

use App\Lib\FieldName;
use App\Lib\Helper;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Resources\Visiteurs\VisiteursResource;
use App\Models\Visiteurs;
use Illuminate\Http\Request;

class VisiteursController extends BaseController
{
    protected $visitefiltre = [
            FieldName::DATE_VISITE,
            FieldName::STATUT,
            FieldName::SITE_ID,
    ];
    protected $recherche = [
            FieldName::DATE_VISITE,
            FieldName::PAYS,
            FieldName::SITE_ID,
    ];
    protected $tri = [FieldName::PAYS];
    public function index()
    {
        $requete = Visiteurs::orderBy(FieldName::CREATED_AT, 'desc');
        $requete = Helper::filtrer($requete, $this->recherche, $this->tri);
        $page = $requete->paginate(env('PAGE'));
        $reponse = VisiteursResource::collection($page)->toResponse(request())->getData();
        return $this->sendResponse($reponse, "Liste des visiteurs récupérée avec succès.");
    }

    public function show($id)
    {
        $visiteur = Visiteurs::withCount(['epasse', 'visite'])->find($id);
        if (!$visiteur) {
            return $this->sendError("Visiteur non trouvé.", [], 404);
        }

        $visites = $visiteur->visite()->getQuery()
            ->with(['epasse', 'siteTouristique', 'visiteur']);
        $visites = Helper::filtrer($visites, $this->visitefiltre)->get();
        $visiteur->setRelation('visite', $visites);

        return $this->sendResponse(new VisiteursResource($visiteur), 'Détails du visiteur récupérés avec succès.');
    }
}

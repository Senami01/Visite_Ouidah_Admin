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
        $visiteur = Visiteurs::find($id);
        if (!$visiteur) {
            return $this->sendError("Visiteur non trouvé.", [], 404);
        }
        return $this->sendResponse(new VisiteursResource($visiteur), 'Détails du visiteur récupérés avec succès.');
    }
}

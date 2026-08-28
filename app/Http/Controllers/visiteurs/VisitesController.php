<?php

namespace App\Http\Controllers\Visiteurs;

use App\Http\Controllers\BaseController\BaseController;
use App\Http\Resources\Visiteurs\VisitesResource ;
use Illuminate\Http\Request;
use App\Lib\FieldName;
use App\Lib\Helper;
use App\Models\Visites; 

class VisitesController extends BaseController
{
    protected $recherche = [
        FieldName::STATUT,
        FieldName::SITE_ID,
        FieldName::DATE_VISITE,
    ];
    public function index(string $id)
    {
        /*$requete = Visites::where(FieldName::VISITEUR_ID, $id)
            ->orderBy(FieldName::CREATED_AT, 'desc');
        $requete = Helper::filtrer($requete, $this->recherche);
        $page = $requete->paginate(env('PAGE'));
        $reponse = VisitesResource::collection($page)->toResponse(request())->getData();
        
        return $this->sendResponse($reponse, "Liste des visites récupérée avec succès.");
    */}


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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

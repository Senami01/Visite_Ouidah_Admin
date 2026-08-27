<?php

namespace App\Http\Controllers\Epasses;

use App\Models\Epasses;
use App\Lib\FieldName;
use App\Lib\Helper;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Resources\Epasses\EpassesResource;
use Illuminate\Http\Request;

class EpassesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $recherche = [
        FieldName::STATUT,
        FieldName::TYPE_INITIATEUR,
        FieldName::DATE_REALISATION,
        FieldName::PAYS,
    ];

    public function index()
    {
        $requete = Epasses::with([
            'acteurmobile',
            'visiteur',
            'lignes',
            'personnes',
            'taxes',
        ])->orderBy(FieldName::CREATED_AT, 'desc');
        $requete = Helper::filtrer($requete, $this->recherche);
        $page = $requete->paginate(env('PAGE'));
        $reponse = EpassesResource::collection($page)->toResponse(request())->getData();
        
        return $this->sendResponse($reponse, "Liste des e-passes récupérée avec succès.");
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
    public function show(string $id)
    {
        $requete = Epasses::with([
            'acteurmobile',
            'visiteur',
            'lignes',
            'personnes',
            'taxes',
        ]);
        $requete = Helper::filtrer($requete, $this->recherche);
        $epasse = $requete->find($id);

        if (!$epasse) {
            return $this->sendError("E-pass non trouvé.", [], 404);
        }

        return $this->sendResponse(
            new EpassesResource($epasse),
            "E-pass récupéré avec succès."
        );
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

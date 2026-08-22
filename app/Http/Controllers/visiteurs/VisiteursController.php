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
        'search_in' => [
            FieldName::NOM,
            FieldName::PRENOM,
            FieldName::PAYS,
        ],
        'champs' => [
            FieldName::PAYS,
        ]
    ];
    public function index()
    {
        $requete = Visiteurs::query();
        $requete = Helper::filtrer($requete, $this->recherche);
        if (request()->filled('sort')) {
        $sort = request()->input('sort');
            if ($sort === 'pays_az') {
                $requete->orderBy(FieldName::PAYS, 'asc');
            } elseif ($sort === 'pays_za') {
                $requete->orderBy(FieldName::PAYS, 'desc');
            }
        } else {
            $requete->latest(); 
        }
        $page = $requete->paginate(env('PAGE'));
        $reponse = VisiteursResource::collection($page)->toResponse(request())->getData();
        return $this->sendResponse($reponse, "Liste des visiteurs récupérée avec succès.");
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

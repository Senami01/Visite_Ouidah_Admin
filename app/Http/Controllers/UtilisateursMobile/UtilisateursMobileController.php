<?php

namespace App\Http\Controllers\UtilisateursMobile;

use App\Models\Utilisateurs_Mobile;
use App\Http\Requests\UtilisateursMobile\StoreUtiliMobileRequest;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Resources\UtilisateursMobile\UtilisateursMobileResource;
use Illuminate\Http\Request;
use App\Lib\FieldName;
use App\Lib\Helper;

class UtilisateursMobileController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $re = [
        FieldName::TYPE,
        FieldName::STATUT,
    ];
    public function index()
    {
       $utilisateur = Utilisateurs_Mobile::orderBy(FieldName::CREATED_AT, 'desc');
        $utilisateur = Helper::filtrer($utilisateur, $this->re);
        $pa = $utilisateur->paginate(env('PAGE'));
        $reponse = UtilisateursMobileResource::collection($pa)->toResponse(request())->getData(true);
        return $this->sendResponse($reponse,
            "Liste des utilisateurs mobile récupérée avec succès."
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    /*public function store(StoreUtiliMobileRequest $request)
    {   
        $validation = $request->validated();
        $utilisateur = Utilisateurs_Mobile::create($validation);
        return $this->sendResponse(new UtilisateursMobileResource($utilisateur),"Utilisateur mobile créé avec succès.", 201);
    }
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
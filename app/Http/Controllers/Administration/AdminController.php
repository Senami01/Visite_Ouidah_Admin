<?php

namespace App\Http\Controllers\Administration;

use App\Lib\FieldName;
use App\Lib\Constant;
use App\Lib\Helper;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Resources\Administration\AdminResource;
use App\Http\Requests\Administration\StoreAdminRequest;
use App\Http\Requests\Administration\UpdateAdminRequest;
use App\Http\Controllers\BaseController\BaseController;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    private const TYPE_ADMIN = Constant::ADMINISTRATEUR;
    protected $recherche = [
        FieldName::NOM,
        FieldName::PRENOM,
        FieldName::EMAIL,
        FieldName::TELEPHONE,
        FieldName::STATUT,
    ];
    public function index()
    {
        $requete = User::with('role')->where(FieldName::TYPE, 'administrateur');
        
        $requete = Helper::filtrer($requete, $this->recherche);
        $paginer = $requete->paginate(env('PAGE'));
        $reponse = AdminResource::collection($paginer)->toResponse(request())->getData(true);

        return $this->sendResponse($reponse, 'Liste des administrateurs récupérée avec succès.');
    }

    public function store(StoreAdminRequest $request)
    {
        $champs = $request->validated();
        $champs[FieldName::TYPE] = self::TYPE_ADMIN;
        $champs[FieldName::PASSWORD] = Hash::make($champs[FieldName::PASSWORD]);

        $user = User::create($champs);
        $user->load('role');

        return $this->sendResponse(new AdminResource($user), 'Administrateur créé avec succès.', 201);
    }

    public function show($id)
    {
        $admin = User::where(FieldName::ID, $id)->where(FieldName::TYPE, self::TYPE_ADMIN)->first();
        if (!$admin) {
            return $this->sendError('Administrateur non trouvé.', [], 404);
        }
        $admin->load('role');
        return $this->sendResponse(new AdminResource($admin), 'Administrateur récupéré avec succès.');
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        if (!Str::isUuid($id)) {
            return $this->sendError('Administrateur non trouvé.', [], 404);
        }    
        $admin = User::where(FieldName::ID, $id)->where(FieldName::TYPE, self::TYPE_ADMIN)->first();  
        if (!$admin) {
            return $this->sendError('Administrateur non trouvé.', [], 404);
        }

        $champs = $request->validated();
        unset($champs[FieldName::TYPE]);

        if (isset($champs[FieldName::PASSWORD])) {
            $champs[FieldName::PASSWORD] = Hash::make($champs[FieldName::PASSWORD]);
        }

        $admin->update($champs);
        $admin->load('role');
        return $this->sendResponse(new AdminResource($admin), 'Administrateur mis à jour avec succès.');
    }

     public function destroy($id)
    {
        $admin = User::where(FieldName::ID, $id)->where(FieldName::TYPE, self::TYPE_ADMIN)->first();

        if (!$admin) {
            return $this->sendError('Administrateur non trouvé.', [], 404);
        }

        $admin->delete();
        return $this->sendResponse([], 'Administrateur supprimé avec succès.');
    }
}
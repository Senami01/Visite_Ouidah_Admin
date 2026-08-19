<?php

namespace App\Http\Controllers\Administration;

use App\Http\Resources\Administration\RoleResource;
use App\Http\Requests\Administration\StoreRoleRequest;
use App\Http\Requests\Administration\UpdateRoleRequest;
use App\Lib\FieldName;
use App\Lib\Helper;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\BaseController\BaseController;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::query();
        $roles = Helper::filtrer($roles, [FieldName::NOM]);
        return $this->sendResponse(RoleResource::collection($roles), "Liste des rôles récupérée avec succès.");
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        return $this->sendResponse(new RoleResource($role), "Rôle créé avec succès.", 201);

    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }
        return $this->sendResponse(new RoleResource($role), "Rôle récupéré avec succès.");
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }

        $role->update($request->validated());
        return $this->sendResponse(new RoleResource($role), "Rôle mis à jour avec succès.");
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }

        $liaisonExiste = User::where(FieldName::ROLE_ID, $role->id)->exists();
        if ($liaisonExiste) {
            return $this->sendError(
                'Impossible de supprimer ce rôle car des utilisateurs y sont encore rattachés.', [], 400);
        }

        $role->delete();
        return $this->sendResponse([], 'Rôle supprimé avec succès.');
    }
}
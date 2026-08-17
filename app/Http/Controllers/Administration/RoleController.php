<?php

namespace App\Http\Controllers\Administration;

use App\Lib\FieldName;
use App\Models\Role;
use App\Http\Controllers\BaseController\BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::all();
        return $this->sendResponse($roles, "Liste des rôles récupérée avec succès.");
    }

    public function store(Request $request)
    {
        try {
            $champs = $request->validate([
                FieldName::NOM => 'required|string|max:255',
                FieldName::DESCRIPTION => 'nullable|string',
            ],
            [
                FieldName::NOM . '.required' => 'Le nom du rôle est requis.',
            ]);
        
            $role = Role::create($champs);
            return $this->sendResponse($role, "Rôle créé avec succès.", 201);
        } catch (ValidationException $e) {
            return $this->sendError("Erreur de validation.", $e->errors(), 422);
        }

    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }
        return $this->sendResponse($role, "Rôle récupéré avec succès.");
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }

        $champs = $request->validate([
            FieldName::NOM => 'sometimes|string|max:255',
            FieldName::DESCRIPTION => 'nullable|string',
        ]);

        $role->update($champs);
        return $this->sendResponse($role, "Rôle mis à jour avec succès.");
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->sendError("Rôle non trouvé.", [], 404);
        }

        $role->delete();
        return $this->sendResponse([], "Rôle supprimé avec succès.");
    }
}
<?php

namespace App\Http\Controllers\Administration;

use App\Lib\FieldName;
use App\Lib\Constant;
use App\Models\User;
use App\Http\Controllers\BaseController\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends BaseController
{
    private const TYPE_ADMIN = Constant::ADMINISTRATEUR;
    public function index()
    {
        $admin = User::where(FieldName::TYPE, self::TYPE_ADMIN)->get();
         if (!$admin) {
            return $this->sendError("Administrateurs non trouvés.", [], 404);
        }
        
        return $this->sendResponse($admin, 'Liste des administrateurs récupérée avec succès.');
    }

    public function store(Request $request)
    {
        try{
            $champs = $request->validate([
                FieldName::NOM => 'required|string',
                FieldName::PRENOM => 'required|string',
                FieldName::TELEPHONE => 'required|string|max:20',
                FieldName::EMAIL => 'required|email|unique:' . User::class . ',' . FieldName::EMAIL,
                FieldName::PASSWORD => ['required','string','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&]).{8,}$/'],
                FieldName::ROLE_ID => 'required|exists:role,id',
            ],
            [
                FieldName::NOM . '.required' => 'Le nom est requis.',
                FieldName::PRENOM . '.required' => 'Le prénom est requis.',
                FieldName::TELEPHONE . '.required' => 'Le numéro de téléphone est requis.',
                FieldName::EMAIL . '.required' => 'L\'adresse e-mail est requise.',
                FieldName::EMAIL . '.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
                FieldName::EMAIL . '.unique' => 'L\'adresse e-mail est déjà utilisée.',
                FieldName::PASSWORD . '.required' => 'Le mot de passe est requis.',
                FieldName::PASSWORD . '.regex' => 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.',
                FieldName::ROLE_ID . '.required' => 'Le rôle est requis.',
                FieldName::ROLE_ID . '.exists' => 'Le rôle sélectionné est invalide.',
            ]);

            $champs[FieldName::TYPE] = self::TYPE_ADMIN;

            $champs[FieldName::PASSWORD] = Hash::make($champs[FieldName::PASSWORD]);

            $user = User::create($champs);
            $user->load('role');

            return $this->sendResponse($user, 'Administrateur créé avec succès.', 201);
        } catch (ValidationException $e) {
            return $this->sendError("Erreur de validation.", $e->errors(), 422);
        }
    }

    public function show($id)
    {
        $admin = User::where(FieldName::ID, $id)->where(FieldName::TYPE, self::TYPE_ADMIN)->first();

        if (!$admin) {
            return $this->sendError('Administrateur non trouvé.', [], 404);
        }

        return $this->sendResponse($admin, 'Administrateur récupéré avec succès.');
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = User::where(FieldName::ID, $id)->where(FieldName::TYPE, self::TYPE_ADMIN)->first();

            if (!$admin) {
                return $this->sendError('Administrateur non trouvé.', [], 404);
            }

            $champs = $request->validate([
                FieldName::NOM => 'sometimes|string|max:255',
                FieldName::PRENOM => 'sometimes|string|max:255',
                FieldName::TELEPHONE => 'sometimes|string|max:20',
                FieldName::EMAIL => 'sometimes|email|unique:' . User::class . ',' . FieldName::EMAIL . ',' . $id . ',' . FieldName::ID,
                FieldName::PASSWORD => ['sometimes|required','string','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&]).{8,}$/'],
                FieldName::ROLE_ID => 'sometimes|exists:role,id',
            ],
            [
                FieldName::EMAIL . '.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
                FieldName::EMAIL . '.unique' => 'L\'adresse e-mail est déjà utilisée.',
                FieldName::PASSWORD . '.regex' => 'Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial.',
                FieldName::PASSWORD . '.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
                FieldName::ROLE_ID . '.exists' => 'Le rôle sélectionné est invalide.',
            ]);

            unset($champs[FieldName::TYPE]);

            if (isset($champs[FieldName::PASSWORD])) {
                $champs[FieldName::PASSWORD] = Hash::make($champs[FieldName::PASSWORD]);
            }

            $admin->update($champs);
            $admin->load('role');

            return $this->sendResponse($admin, 'Administrateur mis à jour avec succès.');
        } catch (ValidationException $e) {
            return $this->sendError("Erreur de validation.", $e->errors(), 422);
        }
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
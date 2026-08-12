<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseController extends Controller
{
    public function sendResponse(mixed $resultat, string $message = 'Opération réussie', int $code = 200): JsonResponse
    {
        $reponse = [
            'success' => true,
            'message' => $message,
            'data'    => $resultat,
        ];

        return response()->json($reponse, $code);
    }

    public function sendError(string $erreur, array $messagesErreurs = [], int $code = 404): JsonResponse
    {
        $reponse = [
            'success' => false,
            'message' => $erreur,
        ];

        if (!empty($messagesErreurs)) {
            $reponse['errors'] = $messagesErreurs;
        }

        return response()->json($reponse, $code);
    }
}

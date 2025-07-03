<?php

namespace App\Http\Controllers;

use App\Server\ViaCepService;

class CepController
{
    public function consult($cep, ViaCepService $viaCepService) {
        $data = $viaCepService->getCep($cep);

        if(is_null($data)) {
            return response()->json([
                'success' => false,
                'message' => 'The ZIP code must have 8 numbers'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}

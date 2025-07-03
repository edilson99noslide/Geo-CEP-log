<?php

namespace App\Server;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function getCep(string $cep): ?array
    {
        if(strlen($cep) !== 8) return null;

        $responseViaCEP = Http::get("https://viacep.com.br/ws/$cep/json/");
        $responseNominatim = Http::withHeaders([
            'User-Agent' => 'MeuAppCEP/1.0 (contato@meusite.com)',
            'Accept-Language' => 'pt-br'
        ])
        ->get("https://nominatim.openstreetmap.org/search?postalcode=$cep&country=Brazil&format=json");

        $cep = $responseViaCEP->json();
        $location = $responseNominatim->json();

        if(isset($cep['erro'])) $cep = 'not found';

        return [
            'cepData'     => $cep,
            'latitude'    => $location[0]['lat'] ?? 'not found',
            'longitude'   => $location[0]['lon'] ?? 'not found',
            'information' => $location[0]['display_name'] ?? 'not found'
        ];
    }
}

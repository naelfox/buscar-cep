<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CepController extends Controller
{
    public function search($cep)
    {

        $cep = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cep) !== 8) {
            return response()->json(['error' => true, 'message' => 'CEP inválido'], 400);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful() && !isset($response['erro'])) {

            $data = [
                'cep' => $response['cep'],
                'logradouro' => $response['logradouro'],
                'complemento' => $response['complemento'],
                'bairro' => $response['bairro'],
                'localidade' => $response['localidade'],
                'uf' => $response['uf'],
            ];


            return response()->json($data);
        }

        return response()->json(['error' => true, 'message' => 'CEP não encontrado'], 404);

    }


}

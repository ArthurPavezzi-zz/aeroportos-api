<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllAirports(Request $request): JsonResponse
    {
        return $this->sendJsonResponse(json_decode($this->getAirports()));
    }

    public function getSingleAirport(Request $request): JsonResponse
    {
        $id = strtoupper($request->route('id'));
        $airports = json_decode($this->getAirports($request), true);

        if (!preg_match('/^[A-Z]{3}/', $id) || strlen($id) !== 3) {
            return $this->sendJsonResponse(['erro' => 'Código IATA inválido'], 400);
        }

        try {
            if (array_key_exists($id, $airports)) {
                return $this->sendJsonResponse($airports[$id]);
            } else {
                return $this->sendJsonResponse(['erro' => 'Aeroporto não encontrado'], 404);
            }
        } catch (\Exception $e) {
            echo $e;
            return $this->sendJsonResponse(['erro' => 'Erro interno'], 500);
        }
    }

    public function handleOtherVerbs(): JsonResponse {
        return $this->sendJsonResponse(['erro' => 'Opção não suportada'], 400);
    }

    private function getAirports(): string
    {
        $airports = file_get_contents(public_path('airports_br.json'));
        return $airports;
    }

    private function sendJsonResponse($data, int $code = 200): JsonResponse
    {
        return Response()->json(
            $data,
            $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}

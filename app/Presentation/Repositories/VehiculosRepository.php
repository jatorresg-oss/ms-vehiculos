<?php

namespace App\Presentation\Repositories;

use App\Controllers\VehiculosController;
use Illuminate\Database\QueryException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VehiculosRepository
{
    public function all(Request $request, Response $response, array $args): Response
    {
        try {
            $controller = new VehiculosController();
            $rows = $controller->all();

            return $this->json($response, $rows);
        } catch (QueryException $ex) {
            return $this->json($response, [
                'message' => 'No fue posible consultar la base de datos logitrans_vehiculos.',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    private function json(Response $response, $data, int $status = 200): Response
    {
        $payload = json_encode($data, JSON_UNESCAPED_UNICODE);
        $response->getBody()->write($payload === false ? '{}' : $payload);

        return $response
            ->withStatus($status)
            ->withHeader('Content-Type', 'application/json');
    }
}
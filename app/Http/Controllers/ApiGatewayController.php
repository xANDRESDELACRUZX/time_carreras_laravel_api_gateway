<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiGatewayController extends Controller
{
    public function service1(Request $request)
    {
        // Aquí ya se validó el token JWT gracias al middleware 'jwt.auth'
        dd("hola");
        $client = new Client();
        $response = $client->post('http://microservice1/api/endpoint', [
            'headers' => $request->headers->all(),
            'json' => $request->all(),
        ]);

        return $response->getBody();
    }

    public function service2(Request $request)
    {
        // Petición al segundo microservicio
        $client = new Client();
        $response = $client->post('http://microservice2/api/endpoint', [
            'headers' => $request->headers->all(),
            'json' => $request->all(),
        ]);

        return $response->getBody();
    }
}

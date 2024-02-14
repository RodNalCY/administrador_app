<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIExternoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reniec_dni_api(Request $request)
    {
        try {
            $token = 'apis-token-7404.jcjeQWJpBgW3UPOfcVHwHuOuRWzqjRmC';
            $dni = $request->_DNI;

            // Realizar solicitud a la API
            $response = Http::withHeaders([
                'Referer' => 'https://apis.net.pe/consulta-dni-api',
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni);

            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {

                return response()->json([
                    'message' => 'API Reniec Exitoso',
                    'status' => true,
                    'data' =>  $response->json()
                ]);
            } else {
                // Manejar errores de solicitud
                return response()->json([
                    'message' => "Error en la solicitud: " . $response->status(),
                    'status' => false,                    
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
            ], 500);
        }
    }
}

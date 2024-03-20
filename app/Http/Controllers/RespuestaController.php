<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;

class RespuestaController extends Controller
{
    public function index()
    {
        $respuestas = Respuesta::all();
        return response()->json($respuestas);
    }

    public function store(Request $request)
    {
        try {
        
            $datos = $request->all();

            $respuesta = Respuesta::create($datos);

            return response()->json($respuesta, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }    
    }


    
}

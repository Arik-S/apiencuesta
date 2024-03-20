<?php

namespace App\Http\Controllers;

use App\Models\ProductoFaltante;
use Illuminate\Http\Request;

class ProductoFaltanteController extends Controller
{
    public function index()
    {
        $productosFaltantes = ProductoFaltante::all();
        return response()->json($productosFaltantes);
    }

    public function store(Request $request)
    {
        try {
            // Obtiene la lista de productos y sectores del cuerpo de la solicitud
            $productosYSectores = $request->input('productos');
    
            // Itera sobre la lista de productos y sectores
            foreach ($productosYSectores as $productoSector) {
                // Crea un nuevo registro de ProductoFaltante para cada producto y sector
                ProductoFaltante::create([
                    'producto_faltante' => $productoSector['producto'],
                    'sector_producto_faltante' => $productoSector['sector'],
                    'id_respuesta' => $request->id_respuesta, // Asigna el id de la respuesta
                ]);
            }
    
            return response()->json(['message' => 'Productos faltantes almacenados correctamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar la solicitud: ' . $e->getMessage()], 500);
        }    
    }

}

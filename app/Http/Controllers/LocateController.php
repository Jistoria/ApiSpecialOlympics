<?php

namespace App\Http\Controllers;
use App\Models\Lugar;
use Exception;


use Illuminate\Http\Request;

class LocateController extends Controller
{
    public function index()
    {
        $lugares = Lugar::orderBy('lugar_id')->get();
        return response()->json($lugares);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|unique:lugares,nombre',
                'descripcion' => 'required'
            ]);
            Lugar::create($request->all());
            return response()->json(['success'=>'true','message' => 'Creado el lugar exitosamente'], 200);
        }  catch (Exception $e) {
            // Captura el mensaje de error
        $errorMessage = $e->getMessage();
        // Retorna el mensaje de error en un JSON de respuesta
        return response()->json(['success'=>'false','error' => 'Ha ocurrido un error al crear el lugar' . $errorMessage], 500);
        }
    }

    public function delete($id)
    {
        $lugar = Lugar::find($id);
        if ($lugar) {
            $lugar->delete();
            return response()->json(['success'=>'true','message' => 'Lugar eliminado correctamente'], 200);
        } else {
            return response()->json(['success'=>'false','error' => 'El lugar no existe.'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $lugar = Lugar::find($id);
        if ($lugar) {
            $request->validate([
                'nombre' => 'required|unique:lugares,nombre,' . $id . ',lugar_id',
                'descripcion' => 'required'
            ]);
            $lugar->nombre = $request->nombre;
            $lugar->descripcion = $request->descripcion;
            $lugar->save();
            return response()->json(['success'=>'true','message' => 'Lugar actualizado correctamente'], 200);
        } else {
            return response()->json(['success'=>'false','error' => 'El lugar no existe.'], 404);
        }
    }
    
}

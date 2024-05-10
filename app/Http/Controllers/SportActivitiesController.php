<?php

namespace App\Http\Controllers;
use App\Models\ActividadDeportiva;
use Exception;

use Illuminate\Http\Request;

class SportActivitiesController extends Controller
{
    public function index()
    {
        $sportActivities = ActividadDeportiva::orderBy('actividad_id')->get();
        return response()->json($sportActivities);
    }
    public function indexf($deporte)
    {
        $sportActivities = ActividadDeportiva::where('deporte_id', $deporte)->orderBy('actividad_id')->get();
        return response()->json($sportActivities);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'deporte_id' => 'required|exists:deportes,deporte_id',
                'actividad' => 'required|unique:actividades_deportivas,actividad',
                'descripcion' => 'required'
            ]);
            ActividadDeportiva::create($request->all());
            return response()->json(['success'=>'true','message' => 'Creada la actividad con exito' ], 200);
        } catch (Exception $e) {
                // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['success'=>'false','error' => 'Ha ocurrido un error al crear la actividad deportiva: ' . $errorMessage], 500);
        }
    }

    public function delete($id)
    {
        $sportActivity = ActividadDeportiva::find($id);
        if ($sportActivity) {
            $sportActivity->delete();
            return response()->json(['success'=>'true','message' => 'Actividad deportiva eliminada correctamente'], 200);
        } else {
            return response()->json(['success'=>'false','error' => 'La actividad deportiva no existe.'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $sportActivity = ActividadDeportiva::find($id);
        if ($sportActivity) {
            $request->validate([
                'deporte_id' => 'required|exists:deportes,deporte_id',
                'actividad' => 'required|unique:actividades_deportivas,actividad,'.$id.',actividad_id',
                'descripcion' => 'required'
            ]);
            $sportActivity->deporte_id = $request->deporte_id;
            $sportActivity->actividad = $request->actividad;
            $sportActivity->descripcion = $request->descripcion;
            $sportActivity->save();
            return response()->json(['success'=>'true','message' => 'Actividad deportiva actualizada correctamente'], 200);
        } else {
            return response()->json(['success'=>'false','error' => 'La actividad deportiva no existe.'], 404);
        }
    }
}

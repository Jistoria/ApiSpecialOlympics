<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almuerzo;
use App\Models\HorarioComida;
use Exception;
use Illuminate\Support\Facades\DB;

class LunchController extends Controller
{
    public function index()
    {
        $almuerzos = Almuerzo::orderBy('id')->get();
        return response()->json($almuerzos);
    }
    public function store(Request $request){
        try {
            $request->validate([
                'array' => 'required|array',
                'horario_comida_id' => 'required|exists:horario_comida,id',
                'type' => 'required|in:1,2', // Asegura que el valor de 'type' sea 1 o 2
            ]);

            $horario_comida_id = $request->horario_comida_id;
            HorarioComida::where('id', $horario_comida_id);
            $type = $request->type;

            foreach ($request->array as $id) {
                Almuerzo::firstOrCreate([
                    'horario_comida_id' => $horario_comida_id,
                    $type == 1 ? 'deportista_id' : 'invitado_id' => $id,
                ]);
            }


            return response()->json(['success' => true, 'message' => 'Almuerzos Actualizados y agregados'], 200);
        }  catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar almuerzos', 'error'=>$e->getMessage()], 400);
        }
    }
    public function delete(Request $request){
        try{
            $request->validate([
                'horario_comida_id' => 'required',
                'type' => 'required|in:1,2', // Asegura que el valor de 'type' sea 1 o 2
            ]);
            if ($request->type == 1) {
                // Obtén los ID de deportistas asociados con el horario de comida dado
                $deportistasIds = DB::table('almuerzos')
                    ->where('horario_comida_id', $request->horario_comida_id)
                    ->pluck('deportista_id');

                // Elimina los almuerzos donde el ID del deportista coincide con los IDs obtenidos
                DB::table('almuerzos')
                    ->whereIn('deportista_id', $deportistasIds)
                    ->delete();
            }
            elseif ($request->type == 2) {
                // Obtén los ID de invitados asociados con el horario de comida dado
                $invitadosIds = DB::table('almuerzos')
                    ->where('horario_comida_id', $request->horario_comida_id)
                    ->pluck('invitado_id');

                // Elimina los almuerzos donde el ID del invitado coincide con los IDs obtenidos
                DB::table('almuerzos')
                    ->whereIn('invitado_id', $invitadosIds)
                    ->delete();
            }
            return response()->json(['success' => true, 'message' => 'Almuerzos eliminados exitosamente'], 200);

        }catch(Exception $e){
            // Manejo de excepciones
            return response()->json(['success' => false, 'message' => 'Error al eliminar almuerzos'], 400);
        }
    }
}

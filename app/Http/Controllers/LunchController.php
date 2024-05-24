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
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i',
            ]);

            $horario_comida_id = $request->horario_comida_id;
            HorarioComida::where('id', $horario_comida_id)->update([
                'hora_inicio' => $request->time_start,
                'hora_fin' => $request->time_end,
            ]);
            $type = $request->type;

            $usuariosConAlmuerzo = []; // Lista para almacenar usuarios con almuerzos

            foreach ($request->array as $id) {
                // Verificar si ya existe un almuerzo para este usuario en el mismo horario de comida
                $almuerzoExistente = Almuerzo::where('horario_comida_id', $horario_comida_id)
                    ->where(function ($query) use ($id, $type) {
                        if ($type == 1) {
                            $query->where('deportista_id', $id);
                        } elseif ($type == 2) {
                            $query->where('invitado_id', $id);
                        }
                    })
                    ->first();

                // Si ya existe un almuerzo para este usuario en el mismo horario de comida, agrega el usuario a la lista y continúa con el siguiente usuario
                if ($almuerzoExistente) {
                    $usuariosConAlmuerzo[] = $id;
                    continue;
                }else{
                    // Crear el registro de almuerzo para este usuario
                    Almuerzo::create([
                        'type' => $type,
                        $type == 1 ? 'deportista_id' : 'invitado_id' => $id,
                        'horario_comida_id' => $horario_comida_id,
                    ]);
                }
            }

            if (!empty($usuariosConAlmuerzo)) {
                return response()->json(['success' => false, 'message' => 'Algunos usuarios ya tienen almuerzo en este horario, pero se crearon los faltantes', 'usuarios_con_almuerzo' => $usuariosConAlmuerzo], 400);
            }

            return response()->json(['success' => true, 'message' => 'Creado el almuerzo exitosamente'], 200);
        }  catch (Exception $e) {
            // Manejo de excepciones
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

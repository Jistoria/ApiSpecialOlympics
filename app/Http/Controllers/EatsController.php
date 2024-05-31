<?php

namespace App\Http\Controllers;

use App\Models\Almuerzo;
use App\Models\Deportista;
use App\Models\Invitado;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;

class EatsController extends Controller
{
    public function index($cedula)
    {
        try{
            $data = Invitado::where('cedula',$cedula)->first() ?? Deportista::where('cedula',$cedula)->first();

            if (!$data) {
                return response()->json(['message' => 'No se encontró el usuario'], 404);
            }
            $data->load('almuerzos','almuerzos.horarioComida')
                ->whereHas('almuerzos.horarioComida',function($query){
                    $query->whereDate('fecha',now()->toDateString());
                })->select('id', 'nombre', 'apellido', 'numero_deportista');

            if ($data->almuerzos->isEmpty()) {
                // No se encontraron almuerzos para el día actual
                return response()->json(['message' => 'No se encontraron almuerzos para hoy'], 404);
            }
            $dataProfile = [
                'id' => $data->id ?? $data->invitado_id,
                'cedula' => $data->cedula,
                'nombre' => $data->nombre,
                'apellido' => $data->apellido,
                'almuerzos' => $data->almuerzos->sortBy('horarioComida.hora_inicio'),

                'url_image' => $data->url_imagen,
            ];


            return response()->json(['success'=>true,'data'=>$dataProfile]);
        }catch(\Exception $e){
            return response()->json(['message'=>'Ha ocurrido un error','error'=> $e->getMessage()],500);
        }
    }
    public function mark(Almuerzo $almuerzo)
    {
        try{
            $almuerzo->load('horarioComida');
            $horaInicio = Carbon::createFromFormat('H:i:s', $almuerzo->horarioComida->hora_inicio,'America/Guayaquil');
            $horaFin = Carbon::createFromFormat('H:i:s', $almuerzo->horarioComida->hora_fin,'America/Guayaquil');

            // Obtener la fecha y hora actual en la zona horaria del servidor
            $now = Carbon::now(new DateTimeZone('America/Guayaquil'));

            // Verificar si la fecha del almuerzo es hoy y la hora actual está dentro del rango permitido
            if ($now->isSameDay($almuerzo->horarioComida->fecha) && $now->between($horaInicio, $horaFin)) {
                $almuerzo->update(['completado'=>1]);
                return response()->json(['message'=>'Almuerzo marcado como completado']);
            }
            return response()->json(['message' => 'No se puede marcar el almuerzo fuera de la fecha y hora programada'], 422);
        }catch(\Exception $e){
            return response()->json(['message' => 'Error al marcar el almuerzo como completado','e'=>$e->getMessage()], 500);
        }
    }
    // {
    //     // try{
    //     //     $almuerzo = $deportista->almuerzos()
    //     //     ->whereDate('fecha',now()->toDateString())
    //     //     ->whereTime('hora_inicio','<=',now()->toTimeString())
    //     //     ->whereTime('hora_fin','>=',now()->toTimeString())
    //     //     ->first();
    //     //     $almuerzo->update(['completado'=>1]);
    //     //     return response()->json(['message'=>'Almuerzo marcado como completado']);
    //     // }catch(\Exception $e){
    //     //     return response()->json(['message'=>'No se encontro almuerzo'],404);
    //     // }
    // }
}

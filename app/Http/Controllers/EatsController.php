<?php

namespace App\Http\Controllers;

use App\Models\Almuerzo;
use App\Models\Deportista;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;

class EatsController extends Controller
{
    public function index(Deportista $deportista)
    {
        try{
            $deportista->load('almuerzos','almuerzos.horarioComida')
                ->whereHas('almuerzos.horarioComida',function($query){
                    $query->whereDate('fecha',now()->toDateString());
                });

            if ($deportista->almuerzos->isEmpty()) {
                // No se encontraron almuerzos para el día actual
                return response()->json(['message' => 'No se encontraron almuerzos para hoy'], 404);
            }

            return response()->json(['success'=>true,'deportista'=>$deportista]);
        }catch(\Exception $e){
            return response()->json(['message'=>'Ha ocurrido un error','error'=> $e->getMessage()],500);
        }
    }
    public function mark(Almuerzo $almuerzo)
    {
        try{
            $horaInicio = Carbon::createFromFormat('H:i:s', $almuerzo->hora_inicio);
            $horaFin = Carbon::createFromFormat('H:i:s', $almuerzo->hora_fin);
            // Obtener la fecha y hora actual en la zona horaria del servidor
            $now = Carbon::now(new DateTimeZone('America/Guayaquil'));
            // Verificar si la fecha del almuerzo es hoy y la hora actual está dentro del rango permitido
            if ($now->isSameDay($almuerzo->fecha) && $now->between($horaInicio, $horaFin)) {
                return response()->json(['message' => 'No se puede marcar el almuerzo fuera de la fecha y hora programada'], 422);
            }

            $almuerzo->update(['completado'=>1]);
            return response()->json(['message'=>'Almuerzo marcado como completado']);
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

<?php

namespace App\Services;

use App\Models\ActividadDeportiva;
use App\Models\Deporte;
use App\Models\Deportista;
use App\Models\Lugar;
use App\Models\Provincia;
use Illuminate\Support\Facades\DB;

class DataPublicService
{
    private $sportman;
    private $sport;

    private $address;
    private $activity;

    private $place;
    public function __construct(Deportista $sportman,
    Deporte $sport,
    ActividadDeportiva $activity,
    Provincia  $provincia,
    Lugar $lugar)
    {
        $this->sportman = $sportman;
        $this->sport = $sport;
        $this->activity = $activity;
        $this->place = $lugar;
        $this->address = $provincia;
    }

    public function get_sportman()
{
    $sportman = $this->sportman->with('provincia','actividades_deportivas','Deporte')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'dni' => $item->cedula,
            'name' => $item->nombre . ' ' . $item->apellido,
            'age' => $item->edad,
            'gender' => $item->genero,
            'sportsman_number' => $item->numero_deportista ?? 'N/A',
            'birthday' => $item->fecha_nacimiento,
            'img_url' => 'https://specialolimpics--production-jistoria.sierranegra.cloud/'.$item->url_imagen,
            'address' => $item->provincia->select('provincia_id as id', 'provincia as address'), // Nombre de la provincia
            'sport' => $item->deporte->select('deporte_id as id','deporte as name','icon','descripcion as description'),// Nombre del deporte
            'activity' => $item->actividades_deportivas->map(function ($actividad) {
                return [
                    'id' => $actividad->actividad_id,
                    'name' => $actividad->actividad,
                    'sport' => $actividad->deporte_id,
                    'description' => $actividad->descripcion,
                ];
            }),
        ];
    });

    return $sportman;
}

    public function get_sportman_by_id($cedula)
    {
        $sportman = $this->sportman->where('cedula', $cedula)->first();
        return $sportman;
    }

    public function get_sport()
    {
        $sport = $this->sport->select('deporte_id as id','deporte as name','icon','descripcion as description')->get();
        return $sport;
    }

    public function get_activity()
    {
        $activity = $this->activity->with(['deporte' => function($query) {
            $query->select('deporte_id as id', 'deporte as sport_name', 'descipcion as description'); // Ajusta los campos y alias según sea necesario
        }])->select('actividad_id as id', 'actividad as name', 'deporte_id as sport', 'descripcion as description')
        ->get();

        return $activity;
    }

    public function get_address()
    {
        $lugar = $this->address->select('provincia_id as id','provincia as name')->get();
        return $lugar;
    }

    public function get_place()
    {
        $lugar = $this->place->select('lugar_id as id','nombre as name','descripcion as description','url_images')->get();
        return $lugar;
    }
}

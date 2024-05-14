<?php

namespace App\Services;

use App\Models\ActividadDeportiva;
use App\Models\Deporte;
use App\Models\Deportista;
use Illuminate\Support\Facades\DB;

class DataPublicService
{
    private $sportman;
    private $sport;

    private $activity;
    public function __construct(Deportista $sportman, Deporte $sport, ActividadDeportiva $activity)
    {
        $this->sportman = $sportman;
        $this->sport = $sport;
        $this->activity = $activity;
    }

    public function get_sportman()
{
    $sportman = $this->sportman->with('provincia')->get()->map(function ($item) {
        return [
            'id' => $item->id,
            'dni' => $item->cedula,
            'name' => $item->nombre . ' ' . $item->apellido,
            'age' => $item->edad,
            'gender' => $item->genero,
            'sportsman_number' => $item->numero_deportista,
            'birthday' => $item->fecha_nacimiento,
            'img_url' => $item->url_imagen,
            'address' => optional($item->provincia)->provincia, // Nombre de la provincia
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
        $activity = $this->activity->select('actividad_id as id','actividad as name','deporte_id as sport','descripcion as description')
        ->get();
        return $activity;
    }
}

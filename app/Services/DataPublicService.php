<?php

namespace App\Services;

use App\Models\Deporte;
use App\Models\Deportista;
use Illuminate\Support\Facades\DB;

class DataPublicService
{
    private $sportman;
    private $sport;
    public function __construct(Deportista $sportman, Deporte $sport)
    {
        $this->sportman = $sportman;
        $this->sport = $sport;
    }

    public function get_sportman()
    {
        $sportman = $this->sportman->select(
            'cedula as dni',
            DB::raw("CONCAT(nombre, ' ', apellido) as name"),
            'edad as age',
            'genero as gender',
            'fecha_nacimiento as birthday',
            'url_imagen as img_url'
        )->get();
        return $sportman;
    }

    public function get_sportman_by_id($cedula)
    {
        $sportman = $this->sportman->where('cedula', $cedula)->first();
        return $sportman;
    }

    public function get_sport()
    {
        $sport = $this->sport->select('deporte_id as id','deporte as sport')->get();
        return $sport;
    }
}

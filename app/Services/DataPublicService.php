<?php

namespace App\Services;

use App\Models\Deportista;

class DataPublicService
{
    private $sportman;
    public function __construct(Deportista $sportman)
    {
        $this->sportman = $sportman->where('activo',1);
    }

    public function get_sportman()
    {
        $sportman = $this->sportman->get();
        $sportman = $sportman->map(function($item){
            return $item->getAll();
        });
        return $sportman;
    }

    public function get_sportman_by_id($cedula)
    {
        $sportman = $this->sportman->where('cedula', $cedula)->first();
        return $sportman;
    }

}

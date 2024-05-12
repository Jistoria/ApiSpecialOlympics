<?php

namespace App\Services;

use App\Models\Deportista;
use Exception;

class SportmanService
{
    private $sportman;
    public function __construct(Deportista $sportman)
    {
        $this->sportman = $sportman;
    }

    public function paginate($search = null)
    {
        $sportman_paginate = $this->sportman->
                with(['deporte','provincia','actividades_deportivas','actividades_deportivas.lugar'])
                    ->when($search, function($query) use ($search){
                        return $query->where('nombre','like','%'.$search.'%');
                    })
                    ->paginate(20);
        return $sportman_paginate;
    }

    public function create($data)
    {
        try{
            $this->sportman->create($data);
            return true;
        }catch(Exception $e){
            return ['success'=>false, 'message'=>'Ha ocurrido un error '.$e->getMessage()];
        }
    }

    public function edit($id, $data)
    {
        try{
            $sportman = $this->sportman->find($id);
            $sportman->update($data);
            return true;
        }catch(Exception $e){
            return ['success'=>false,
            'message'=>'Ha ocurrido un error al actualizar '.$e->getMessage()];
        }
    }

    public function active($id)
    {
            $sportman = $this->sportman->find($id);
            $sportman->update(['activo'=>!$sportman->activo]);
            return true;
    }

    public function find($id)
    {
        return $this->sportman->find($id);
    }
}

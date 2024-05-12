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

    public function paginate($filters)
    {
        $search= $filters['search'] ?? null;
        $provincia= $filters['provincia'] ?? null;
        $deporte= $filters['deporte'] ?? null;
        $sportman_paginate = $this->sportman
    ->with(['deporte', 'provincia', 'actividades_deportivas', 'actividades_deportivas.lugar'])
    ->when($search, function ($query) use ($search) {
        return $query->where(function ($query) use ($search) {
            $query->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('apellido', 'like', '%' . $search . '%')
                ->orWhere('cedula', 'like', '%' . $search . '%');
        });
    })
    ->when($provincia, function ($query) use ($provincia) {
        return $query->where('provincia_id', $provincia);
    })
    ->when($deporte, function ($query) use ($deporte) {
        return $query->whereHas('actividades_deportivas', function ($query) use ($deporte) {
            $query->where('deporte_id', $deporte);
        });
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

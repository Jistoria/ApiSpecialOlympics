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

    ->paginate(10);

        return $sportman_paginate;
    }

    public function create($data)
    {
        try{
            $provincia = \App\Models\Provincia::find($data['provincia_id']);
            $image = $data['imagen'];
            $name_file = $data['nombre'].' '.$data['apellido'].' '.$data['cedula'].'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images/'.$provincia->provincia.'/',$name_file);
            $data['url_imagen'] = 'storage/images/'.$provincia->provincia.'/'.$name_file;
            $this->sportman->create($data);
            return true;
        }catch(Exception $e){
            return ['success'=>false, 'message'=>'Ha ocurrido un error '.$e->getMessage()];
        }
    }

    public function edit($id, $data)
    {
            $sportman = $this->sportman->find($id);
            $sportman->update($data);

            return $sportman;
    }

    public function active($id)
    {
            $sportman = $this->sportman->find($id);
            $sportman->update(['activo'=>!$sportman->activo]);
            $message = $sportman->activo ? 'Desactivado' : 'Activado';
            return ['success'=>true, 'message'=>'Deportista '.$message.' correctamente'];
    }

    public function find($id)
    {
        return $this->sportman->find($id);
    }

    public function activitiesAttach($id, $data)
    {
        $sportman = $this->sportman->find($id);
        $sportman->actividades_deportivas()->sync($data);
        return ['success'=>true, 'message'=>'Actividades asignadas correctamente'];
    }

    public function pluckSport()
    {
        return $this->sportman->select('id', 'nombre', 'apellido')->get();
    }
}

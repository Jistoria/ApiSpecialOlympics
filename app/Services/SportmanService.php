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
        $sportman_paginate = $this->sportman
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

    public function delete($id)
    {
        try{
            $sportman = $this->sportman->find($id);
            $sportman->delete();
            return true;
        }catch(Exception $e){
            return ['success'=>false,
            'message'=>'Ha ocurrido un error al eliminar '.$e->getMessage()];
        }
    }

    public function find($id)
    {
        try{
            return $this->sportman->find($id);
        }catch(Exception $e){
            return ['success'=>false,
            'message'=>'Ha ocurrido un error al obtener los datos '.$e->getMessage()];
        }
    }
}

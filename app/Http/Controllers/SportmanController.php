<?php

namespace App\Http\Controllers;

use App\Services\SportmanService;
use Illuminate\Http\Request;

class SportmanController extends Controller
{
    private $sportmanService;
    public function __construct(SportmanService $sportmanService)
    {
        $this->sportmanService = $sportmanService;
    }

    /**
     * Obtiene una respuesta JSON con los datos paginados de los deportistas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            // Llama al método paginate() del servicio de deportistas
            $paginatedData = $this->sportmanService->paginate($request->all());
            // Devuelve una respuesta JSON con los datos paginados
            return response()->json($paginatedData);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }
    /**
     * Almacena un nuevo deportista en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $request->validate(['cedula'=>'nullable|unique:deportistas,cedula','provincia_id' =>'required|exists:provincias,provincia_id','deporte_id' =>'required|exists:deportes,deporte_id']);
            $new_sportman = $this->sportmanService->create($request->all());
            return response()->json(['success'=>true,'message'=>'Deportista creado correctamente','deportista'=>$new_sportman]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Actualiza un deportista en la base de datos.
     *
     * @param Request $request
     * @param $sportman
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $this->sportmanService->delete($id);
            return response()->json(['success'=>true,'message'=>'Se ha eliminado el deportista correctamente']);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    /**
     * Mostrar un deportista de la base de datos.
     *
     * @param Request $request
     * @param $sportman
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($sportman)
    {
        try{
            $sportman = $this->sportmanService->find($sportman);
            return response()->json(['success'=>true,'deportista'=>$sportman]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function update(Request $request, $sportman)
    {
        try{
            $data = $this->sportmanService->edit($sportman, $request->except('actividad_id'));
            return response()->json(['success'=>true,'message'=>'Deportista actualizado correctamente', 'deportista'=>$data]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function active($sportman)
    {
        $response = $this->sportmanService->active($sportman);
        return response()->json($response);
    }

    public function activitiesAttach($spotman, Request $request)
    {
        try{
            $request->validate(['ids'=>'required|array','ids.*'=>'required|exists:actividades_deportivas,actividad_id']);
            $response = $this->sportmanService->activitiesAttach($spotman, $request->ids);
            return response()->json($response);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function pluck()
    {
        $response = $this->sportmanService->pluckSport();
        return response()->json($response);
    }

}

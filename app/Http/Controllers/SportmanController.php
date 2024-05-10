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
    public function index()
    {
        try{
            // Llama al método paginate() del servicio de deportistas
            $paginatedData = $this->sportmanService->paginate();
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
    public function destroy($sportman)
    {
        try{
            $this->sportmanService->delete($sportman);
            return response()->json(['success'=>true,'message'=>'Deportista desactivado']);
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

}

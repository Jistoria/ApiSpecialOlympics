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
        // Llama al método paginate() del servicio de deportistas
        $paginatedData = $this->sportmanService->paginate();

        // Devuelve una respuesta JSON con los datos paginados
        return response()->json($paginatedData);
    }
    /**
     * Almacena un nuevo deportista en la base de datos.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json($this->sportmanService->create($request->all()));
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
        $this->sportmanService->delete($sportman);
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
        return response()->json($this->sportmanService->find($sportman));
    }

}

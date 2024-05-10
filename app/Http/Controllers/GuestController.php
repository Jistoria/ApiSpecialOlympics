<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitado;
use Exception;

class GuestController extends Controller
{
    public function index()
    {
        // Método index: Muestra una lista de recursos (en este caso, invitados)
        $guests = Invitado::all();
        return response()->json($guests);
    }
    public function indexf($tipo_invitado_id)
{
        // Método indexf: Muestra una lista paginada de recursos (en este caso, invitados) filtrados por tipo de invitado
        $query = Invitado::where('tipo_invitado_id', $tipo_invitado_id)->orderBy('invitado_id');

        // Pagina los resultados a 5 por página
        $guests = $query->paginate(5);

        return response()->json($guests);
    }
    public function show($nombreCompleto)
    {
        // Método show: Muestra recursos (en este caso, invitados) que coincidan con el nombre completo en 'nombre' o 'apellido'
        $guests = Invitado::where('nombre', 'like', "%$nombreCompleto%")
                          ->orWhere('apellido', 'like', "%$nombreCompleto%")
                          ->paginate(5);
    
        if ($guests->isEmpty()) {
            return response()->json(['success'=>'false','error' => 'Invitados no encontrados'], 404);
        } else {
            return response()->json($guests);
        }
    }
    public function store(Request $request)
    {
        // Método store: Almacena un recurso (en este caso, un invitado)
        try {
            $request->validate([
                'provincia_id' => 'nullable',
                'tipo_invitado_id' => 'required',
                'nombre' => 'required|unique:invitados,nombre',
                'apellido' => 'required',
                'cedula' => 'required',
                'edad' => 'required',
                'genero' => 'required',

            ]);
            Invitado::create($request->all());
            return response()->json(['success'=>'true','message' => 'Creado el invitado exitosamente'], 200);
        }  catch (Exception $e) {
            // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['success'=>'false','error' => 'Ha ocurrido un error al crear el invitado' . $errorMessage], 500);
        }
    }
    public function delete($id)
    {
        try {
            // Buscar al invitado por su ID
            $guest = Invitado::find($id);
    
            if ($guest) {
                // Verificar si el invitado ya está deshabilitado
                if (!$guest->activo) {
                    // Si ya está deshabilitado, se habilita cambiando el estado a true
                    $guest->activo = true;
                    $guest->save();
                    // Devolver una respuesta JSON indicando el éxito de la operación
                    return response()->json(['success' => true, 'message' => 'Invitado habilitado correctamente'], 200);
                }
                // Si no está deshabilitado, se deshabilita cambiando el estado a false
                $guest->activo = false;
                $guest->save();
                // Devolver una respuesta JSON indicando el éxito de la operación
                return response()->json(['success' => true, 'message' => 'Invitado deshabilitado correctamente'], 200);
            } else {
                // Devolver un mensaje de error si el invitado no se encuentra
                return response()->json(['success' => false, 'error' => 'Invitado no encontrado'], 404);
            }
        } catch (Exception $e) {
            // Capturar el mensaje de error
            $errorMessage = $e->getMessage();
            // Devolver un mensaje de error en caso de que ocurra una excepción
            return response()->json(['success' => false, 'error' => 'Ha ocurrido un error al modificar el estado del invitado: ' . $errorMessage], 500);
        }
    }
    public function update(Request $request, $id)
    {
        // Método update: Actualiza un recurso (en este caso, un invitado)
        try {
            $guest = Invitado::find($id);
            if ($guest) {
                $request->validate([
                    'provincia_id' => 'required',
                    'tipo_invitado_id' => 'required',
                    'nombre' => 'required|unique:invitados,nombre,' .$id. ',invitado_id',
                    'apellido' => 'required',
                    'cedula' => 'required',
                    'edad' => 'required',
                    'genero' => 'required',

                ]);
                $guest->update($request->all());
                return response()->json(['success'=>'true','message' => 'Invitado actualizado exitosamente'], 200);
            } else {
                return response()->json(['success'=>'false','error' => 'Invitado no encontrado'], 404);
            }
        } catch (Exception $e) {
            // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['success'=>'false','error' => 'Ha ocurrido un error al actualizar el invitado' . $errorMessage], 500);
        }
    }
}

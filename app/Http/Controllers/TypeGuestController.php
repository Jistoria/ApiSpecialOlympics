<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoInvitado;
use Exception;

class TypeGuestController extends Controller
{
    public function index()
    {
        // Método index: Muestra una lista de recursos (en este caso, tipos de invitados)
        $typeGuests = TipoInvitado::all();
        return response()->json($typeGuests);
    }
    public function store(Request $request)
    {
        // Método store: Almacena un recurso (en este caso, un tipo de invitado)
        try {
            $request->validate([
                'tipo_invitado_nombre' => 'required|unique:tipos_invitados,tipo_invitado_nombre'
            ]);
            TipoInvitado::create($request->all());
            return response()->json(['message' => 'Creado el tipo de invitado exitosamente'], 200);
        }  catch (Exception $e) {
            // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['error' => 'Ha ocurrido un error al crear el tipo de invitado' . $errorMessage], 500);
        }
    }
    public function delete($id)
    {
        // Método delete: Elimina un recurso (en este caso, un tipo de invitado)
        try {
            $typeGuest = TipoInvitado::find($id);
            if ($typeGuest) {
                $typeGuest->delete();
                return response()->json(['message' => 'Tipo de invitado eliminado exitosamente'], 200);
            } else {
                return response()->json(['error' => 'Tipo de invitado no encontrado'], 404);
            }
        } catch (Exception $e) {
            // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['error' => 'Ha ocurrido un error al eliminar el tipo de invitado' . $errorMessage], 500);
        }
    }
    public function update(Request $request, $id)
    {
        // Método update: Actualiza un recurso (en este caso, un tipo de invitado)
        try {
            $typeGuest = TipoInvitado::find($id);
            if ($typeGuest) {
                $request->validate([
                    'tipo_invitado_nombre' => 'required|unique:tipos_invitados,tipo_invitado_nombre,' .$id. ',tipo_invitado_id'
                ]);
                $typeGuest->update($request->all());
                return response()->json(['message' => 'Tipo de invitado actualizado exitosamente'], 200);
            } else {
                return response()->json(['error' => 'Tipo de invitado no encontrado'], 404);
            }
        } catch (Exception $e) {
            // Captura el mensaje de error
            $errorMessage = $e->getMessage();
            // Retorna el mensaje de error en un JSON de respuesta
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el tipo de invitado' . $errorMessage], 500);
        }
    }
}

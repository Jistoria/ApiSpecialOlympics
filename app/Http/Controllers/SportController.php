<?php

namespace App\Http\Controllers;
use App\Models\Deporte;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Exception;

class SportController extends Controller
{
    public function index()
    {
        // Método index: Muestra una lista de recursos (en este caso, deportes)
        $sports = Deporte::all();
        return response()->json($sports);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'deporte' => 'required|unique:deportes', // El nombre del deporte es requerido y debe ser único en la tabla deportes
            'descripcion' => 'required' // La descripción del deporte es requerida
        ]);
        // Llamar al método createSport para crear el deporte
        $sport = $this->createSport($request->all());

        // Verificar si el deporte se creó correctamente
        if ($sport instanceof Deporte) {
            // Si la creación del deporte fue exitosa, devuelve una respuesta JSON con el deporte creado
            return response()->json(['message' => 'Deporte creado correctamente'], 201);
        } else {
            // Si ocurrió un error durante la creación del deporte, devuelve una respuesta JSON con un mensaje de error
            return response()->json(['error' => 'Ha ocurrido un error al crear el deporte.'], 500);
        }
    }

    public function createSport($data)
    {
        try {
            // Crear un nuevo registro de deporte utilizando los datos proporcionados
            return Deporte::create($data);
        } catch (Exception $e) {
            // Si ocurre un error durante la creación del deporte, devuelve null
            return null;
        }
    }
    
    public function delete($id)
    {
        // Buscar el deporte por su ID
        $sport = Deporte::find($id);
        // Verificar si el deporte existe
        if ($sport) {
            // Si el deporte existe, eliminarlo de la base de datos
            $sport->delete();
            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json(['message' => 'Deporte eliminado correctamente'], 200);
        } else {
            // Si el deporte no existe, devolver una respuesta JSON con un mensaje de error
            return response()->json(['error' => 'Deporte no encontrado'], 404);
        }
    }
    public function update($id,Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'deporte' => [
                'required',
                Rule::unique('deportes')->ignore($id, 'deporte_id'),
            ],
            'descripcion' => 'required'
        ]);
        
        try {
            // Buscar el deporte por su ID
            $sport = Deporte::find($id);

            // Verificar si el deporte existe
            if ($sport) {
                // Si el deporte existe, actualizar sus datos con los nuevos datos proporcionados
                $sport->update($request->all());
                // Devolver una respuesta JSON con un mensaje de éxito
                return response()->json(['message' => 'Deporte actualizado correctamente'], 200);
            } else {
                // Si el deporte no existe, devolver una respuesta JSON con un mensaje de error
                return response()->json(['error' => 'Deporte no encontrado'], 404);
            }
        } catch (Exception $e) {
            // Si ocurre un error durante la actualización del deporte, devolver una respuesta JSON con un mensaje de error
            return response()->json(['error' => 'Ha ocurrido un error al actualizar el deporte.'], 500);
        }
    }

}

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
        $guests = Invitado::where('tipo_invitado_id', '!=', 10)->get();
        return response()->json($guests);
    }
    public function indexf()
{
        // Método indexf: Muestra una lista paginada de recursos (en este caso, invitados) filtrados por tipo de invitado
        $query = Invitado::when($search = request('search'), function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('apellido', 'like', '%' . $search . '%')
                    ->orWhere('cedula', 'like', '%' . $search . '%');
            });
        })->when(
            $tipo_invitado_id = request('tipo_invitado_id'),
            function ($query) use ($tipo_invitado_id) {
                return $query->where('tipo_invitado_id', $tipo_invitado_id);
            }
        )->orderBy('invitado_id');

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
                'nombre' => 'nullable',
                'apellido' => 'nullable',
                'cedula' => 'nullable',
                'edad' => 'nullable',
                'genero' => 'nullable'
            ]);
            $data = $request->all();
            if(!request('imagen') == '' && $request->hasFile('imagen')) {
                $image = $request->file('imagen');
                $name_file = $request->nombre.' '.$request->apellido.' '.$request->cedula.'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/images/Invitado/',$name_file);
                $url_imagen = 'storage/images/Invitado/'.$name_file;
                $data['url_imagen'] = $url_imagen;
            }else{
                $data['url_imagen'] = 'nada';
            }
            $data['cedula'] = $data['cedula'] ?? Invitado::factory()->make()->cedula;
            Invitado::create($data);
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

                $guest->delete();
                // Devolver una respuesta JSON indicando el éxito de la operación
                return response()->json(['success' => true, 'message' => 'Invitado eliminado correctamente'], 200);
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
                    'cedula' => 'nullable|unique:invitados,cedula,' .$id. ',invitado_id',
                    'tipo_invitado_id' => 'required'
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

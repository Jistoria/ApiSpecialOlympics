<?php

namespace App\Http\Controllers;

use App\Exports\AlmuerzoExport;
use App\Imports\DataImport;
use App\Imports\DeportistaImport;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class FilesController extends Controller
{
    public function deportistaImport(Request $request)
    {
        try{
            $request->validate([
                'excelLoad' => 'required|mimes:xlsx,xls',
            ]);
            Excel::import(new DataImport,$request->file('excelLoad'),null, \Maatwebsite\Excel\Excel::XLSX);
            return response()->json(['success'=>true,'message'=>'Deportistas importados correctamente']);
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            return response()->json(['success'=>false,'codigo'=>'422','message'=>$e->failures()],422);
        }
    }

    public function deportistaImages(Provincia $provincia, Request $request)
    {
        try{
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Create an instance of the Firebase Storage client
            $name = $provincia->provincia ?? 'Invitado' ;
            foreach($request->file('images') as $image){
                $nameImage = $image->getClientOriginalName();
                $url_imagen = mb_strtolower("public/images/".$name."/".$nameImage);
                $url_imagen = str_replace(' ', '_', $url_imagen);
                $url = $image->storeAs($url_imagen);
            }
            return response()->json(['success'=>true,'message'=>'Imagenes subidas correctamente', 'url'=>$url]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function athleteCredentials(Request $request)
    {
        try{
            $deportistas = \App\Models\Deportista::
            when(request('provincia_id'), function($query){
                $query->where('provincia_id', request('provincia_id'));
            })
            ->when(request('deporte_id'), function($query){
                $query->where('deporte_id', request('deporte_id'));
            })
            ->paginate(4);
            $last_page = $deportistas->lastPage();

            $deportistas = $deportistas->map(function($deportista){
                return $deportista->credentials();
            });
            return response()->json(['atletas'=>$deportistas, 'last_page'=>$last_page]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function guestCredentials()
    {
        try{
            $invitados = \App\Models\Invitado::
            when(request('provincia_id'), function($query){
                $query->where('provincia_id', request('provincia_id'));
            })
            ->when(request('tipo_invitado_id'), function($query){
                $query->where('tipo_invitado_id', request('tipo_invitado_id'));
            })
            ->paginate(4);
            $last_page = $invitados->lastPage();
            $invitados = $invitados->map(function($invitado){
                return $invitado->credentials();
            });
            return response()->json(['invitados'=>$invitados, 'last_page'=>$last_page]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function launchExport(Request $request)
    {
        try{
            $request->validate([
                'horario_id' => 'required|exists:horario_comida,id',
            ]);

            $date = $request->horario_id;
            return Excel::download(new AlmuerzoExport($date), 'almuerzo.xlsx');
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function exportGuest()
    {
        try{
            return Excel::download(new \App\Exports\InvitadoExport, 'invitados', \Maatwebsite\Excel\Excel::CSV);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function exportAthlete()
    {
        try{
            return Excel::download(new \App\Exports\AtletaExport, 'deportistas', \Maatwebsite\Excel\Excel::CSV);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

}

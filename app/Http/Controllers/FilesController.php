<?php

namespace App\Http\Controllers;

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
            $name = $provincia->provincia;
            foreach($request->file('images') as $image){
                $nameImage = str_replace(['ñ','Ñ'],['n','N'],$image->getClientOriginalName());
                $url_imagen = strtolower("public/images/".$name."/".$nameImage);
                $url_imagen = str_replace(' ', '_', $url_imagen);
                $url = $image->storeAs($url_imagen);
            }
            return response()->json(['success'=>true,'message'=>'Imagenes subidas correctamente', 'url'=>$url]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }

    public function athleteCredentials()
    {
        try{
            $deportistas = \App\Models\Deportista::paginate(4);
            $last_page = $deportistas->lastPage();
            $deportistas = $deportistas->map(function($deportista){
                return $deportista->credentials();
            });
            return response()->json(['atletas'=>$deportistas, 'last_page'=>$last_page]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'codigo'=>'500','message'=>$e->getMessage()],500);
        }
    }
}

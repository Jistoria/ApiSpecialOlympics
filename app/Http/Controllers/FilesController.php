<?php

namespace App\Http\Controllers;

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
            Excel::import(new DeportistaImport,$request->file('excelLoad'),null, \Maatwebsite\Excel\Excel::XLSX, $request->provincia_id);
            return response()->json(['success'=>true,'message'=>'Deportistas importados correctamente']);
        }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
            return response()->json(['success'=>false,'message'=>$e->failures()],422);
        }
    }

    public function deportistaImages(Provincia $provincia, Request $request)
    {
        try{
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $name = $provincia->provincia;
            foreach($request->file('images') as $image){
                $image->store('public/images/'.$name);
            }
            return response()->json(['success'=>true,'message'=>'Imagenes subidas correctamente']);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }
}

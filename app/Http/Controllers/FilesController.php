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
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }
}

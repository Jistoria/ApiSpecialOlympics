<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use Exception;

class ProvinceController extends Controller
{
    public function index()
    {
        // Método index: Muestra una lista de recursos (en este caso, provincias)
        $provinces = Provincia::all();
        return response()->json($provinces);
    }
}

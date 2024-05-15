<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HorarioComida;

class LunchDateController extends Controller
{
    public function index()
    {
        $horario_comida = HorarioComida::orderBy('id')->get();
        return response()->json($horario_comida);
    }
    
}

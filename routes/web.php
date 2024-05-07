<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//logica para obtener QR
Route::get('/qr/{cedula}', function ($cedula) {
    // Comprobar si el archivo QR existe en el almacenamiento
    $fileName = $cedula;
    $filePath = 'public/qrcodes/' . $fileName;

    if (Storage::exists($filePath)) {
        // Obtener el contenido del archivo QR
        $qrContent = Storage::get($filePath);

        // Devolver la respuesta con el contenido del código QR
        return $qrContent;
        // return response($qrContent)->header('Content-Type', 'image/png');
    } else {
        // Devolver una respuesta de error si el archivo QR no existe
        abort(404);
    }
});

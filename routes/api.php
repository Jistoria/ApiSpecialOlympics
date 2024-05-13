<?php

use App\Http\Controllers\DataPublicController;
use App\Http\Controllers\EatsController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\SportmanController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportActivitiesController;
use App\Http\Controllers\LocateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TypeGuestController;
use App\Http\Controllers\GuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class, 'login'])->middleware('guest:sanctum');

Route::get('/data_qr',[UserController::class,'dataqr']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[UserController::class,'logout']);
    Route::get('/get_session',[UserController::class,'get_session']);
});


//Ruta solo para repartidor
Route::middleware(['auth:sanctum','role:Voluntario'])->group(function(){
    Route::get('eats/{deportista}',[EatsController::class,'index']);
    Route::post('eats',[EatsController::class,'store']);
    Route::put('eats/{eats}',[EatsController::class,'update']);
    Route::post('eats_mark/{almuerzo}',[EatsController::class,'mark']);
});

Route::middleware(['auth:sanctum','role:Administrador'])->prefix('dashboard')->group(function(){
    Route::resource('sportman', SportmanController::class);
    Route::post('sportman_active/{deportista}',[SportmanController::class,'active']);
    Route::post('sportman_activities/{deportista}',[SportmanController::class,'activitiesAttach']);
    //crudcito de deportes
    Route::get('/get_deporte', [SportController::class, 'index']);
    route::post('/store_deporte', [SportController::class, 'store']);
    route::delete('/delete_deporte/{deporte}', [SportController::class, 'delete']);
    route::put('/update_deporte/{deporte}', [SportController::class, 'update']);
    //crudcito de actividades deportivas
    Route::get('/get_ad', [SportActivitiesController::class, 'index']);
    Route::get('/get_ad_f/{deporte}', [SportActivitiesController::class, 'indexf']);
    route::post('/store_ad', [SportActivitiesController::class, 'store']);
    route::delete('/delete_ad/{actividad}', [SportActivitiesController::class, 'delete']);
    route::put('/update_ad/{actividad}', [SportActivitiesController::class, 'update']);
    //crudcito de lugares
    Route::get('/get_lugar', [LocateController::class, 'index']);
    route::post('/store_lugar', [LocateController::class, 'store']);
    route::delete('/delete_lugar/{lugar}', [LocateController::class, 'delete']);
    route::put('/update_lugar/{lugar}', [LocateController::class, 'update']);
    //crudcito de tipos de invitados
    Route::get('/get_tg', [TypeGuestController::class, 'index']);
    route::post('/store_tg', [TypeGuestController::class, 'store']);
    route::delete('/delete_tg/{tipo_invitado}', [TypeGuestController::class, 'delete']);
    route::put('/update_tg/{tipo_invitado}', [TypeGuestController::class, 'update']);
    //crudcito de invitados
    Route::get('/get_guest', [GuestController::class, 'index']);
    Route::get('/get_guestf/{tipo_invitado_id}', [GuestController::class, 'indexf']);
    Route::get('/get_find/{nombreCompleto}', [GuestController::class, 'show']);
    route::post('/store_guest', [GuestController::class, 'store']);
    route::delete('/delete_guest/{invitado}', [GuestController::class, 'delete']);
    route::put('/update_guest/{invitado}', [GuestController::class, 'update']);
    //crudcito de provincia
    Route::get('/get_provincia', [ProvinceController::class, 'index']);
    //Rutas para archivos
    Route::post('/deportista_import',[FilesController::class,'deportistaImport']);
    Route::post('/deportista_images/{provincia}',[FilesController::class,'deportistaImages']);

    //DataPDF
    Route::get('credentials_athlete',[FilesController::class,'athleteCredentials']);
});

//Rutas publicas
Route::get('/athlete',[DataPublicController::class,'get_sportman']);
Route::get('/sport',[DataPublicController::class,'get_sport']);
Route::get('/activity',[DataPublicController::class,'get_activity']);

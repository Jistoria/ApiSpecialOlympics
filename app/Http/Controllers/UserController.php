<?php

namespace App\Http\Controllers;

use App\Models\Deportista;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function login (Request $request)
    {
        try{
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt($request->all())) {
                // Obtener el usuario autenticado
                $user = Auth::user();
                $token = $user->createToken('token-name')->plainTextToken;
                $cookie = cookie('cookie_token', $token, 60 * 24);
            // Obtener el número de notificaciones del usuario
            // Retornar una respuesta JSON con éxito y el usuario
            return response()->json(['user'=> $user->getSessionDetails()], 200)->withCookie(($cookie));
            } else {
                // La autenticación ha fallado
                return response(['success'=>false, 'message'=>'Credenciales invalidas'], 401);
            }
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    public function logout ()
    {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget('cookie_token');
        return response(['message' => 'Cerró Sesión'], 200)->withCookie($cookie);
    }

    public function get_session()
    {
        $user = auth()->user()->getSessionDetails();
            return response()->json(['success'=>true,'user'=>$user]);
    }

    public function dataqr()
    {
         // Obtener todos los deportistas
    $deportistas = Deportista::all();

    // Iterar a través de cada deportista para agregar su QR code
    foreach ($deportistas as $deportista) {
        // Comprobar si existe el archivo QR para este deportista
        $filePath = 'public/qrcodes/' . $deportista->cedula . '.png'; // Ruta al archivo QR

        if (Storage::exists($filePath)) {
            // Leer el contenido del archivo QR
            $qrCodeContents = Storage::get($filePath);

            // Asignar el QR code al deportista
            $deportista->qrcode = $qrCodeContents;
        } else {
            // En caso de que no se encuentre el archivo QR, asignar null o un mensaje de error
            $deportista->qrcode = null;
        }
    }

    // Retornar los deportistas con sus respectivos QR codes en formato JSON
    return response()->json(['deportistas' => $deportistas]);
    }
}

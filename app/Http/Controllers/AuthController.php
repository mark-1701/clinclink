<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Utils\SimpleJSONResponse;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(LoginRequest $request)
    {
        $user = new User();
        $user->role_id = $request->role_id;
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        return SimpleJSONResponse::successResponse(
            null,
            'Registro de usuario exitoso',
            200
        );

    }
    public function login(Request $request)
    {
        // validations
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                // creamos el tokken
                $token = $user->createToken('auth_token')->plainTextToken;
                // si todo ok
                return SimpleJSONResponse::successResponse(
                    null,
                    'Usuario logueado exitosamente',
                    200
                );
            } else {
                return SimpleJSONResponse::successResponse(
                    null,
                    'Password incorrecta',
                    400
                );
            }
        } else {
            return SimpleJSONResponse::successResponse(
                null,
                'Usuario no encontrado',
                400
            );
        }
    }
    public function userProfile()
    {
        return SimpleJSONResponse::successResponse(
            auth()->user(),
            'Informacin del perfil del usuario',
            200
        );
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return SimpleJSONResponse::successResponse(
            null,
            'Cirre de sesion',
            200
        );
    }
}

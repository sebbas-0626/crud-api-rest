<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validacion de los datos
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'

        ]);

        //validacion
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => 'Usuario registrado',
            'data' => $user
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = User::find(Auth::user()->id); // 1
            return response()->json([
                'status' => 'OK',
                'message' => 'Bienvenido',
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('token')->plainTextToken
                ]
            ]);
        }
        return response()->json([
            'status' => 'ERROR',
            'message' => 'Credenciales invalidas',
            'data' => null
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return response()->json([
            'message' => 'respuesta',
        ]);
    }
    public function login(Request $request)
    {
    }

    public function userProfile(Request $request)
    {
    }
    public function logoout()
    {
    }
    public function allUsers()
    {
    }
}

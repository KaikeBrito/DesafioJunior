<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "email" => "required|string|email|unique:users",
            "name" => "required|string",
            "password" => "required|string|min:6"
        ]);

        $user = User::create([
            "email" => $request->email,
            "name" => $request->name,
            "password" => Hash::make($request->password)
        ]);

        return redirect()->route('register.form')->with('success', 'Registro realizado com sucesso! Você pode fazer login agora.');
    }

    public function login(Request $request)
    {
        $credencial = $request->only('email', 'password');

        if (Auth::attempt($credencial)) {
            $user = $request->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect()->route('dashboard');
        }

        return redirect()->route('login.form')->with('error', 'Credenciais inválidas, por favor, tente novamente.');
    }


    public function loginApi(Request $request)
    {
        $credencial = $request->only('email', 'password');

        if (Auth::attempt($credencial)) {
            $user = $request->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "access_token" => $token,
                "token_type" => 'Bearer'
            ]);
        }

        return response()->json([
            "message" => "Usuário inválido"
        ], 401);
    }

    public function profiles(Request $request)
    {
        return $request->user();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Você foi desconectado com sucesso.');
    }
}

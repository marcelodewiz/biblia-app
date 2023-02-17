<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());

        $token = $user->createToken($request->nameToken)->plainTextToken;

        $response =[
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request){

        $user = User::whereEmail($request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message'=> 'Email ou senha invalidos'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('UsuarioLogado')->plainTextToken;

        $response=[
            'user' => $user,
            'token' => $token
        ];

        return response($response, Response::HTTP_OK);

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Deslogado com sucesso'
        ], Response::HTTP_OK);
    }
}

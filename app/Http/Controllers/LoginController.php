<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{

    public function login(Request $request)
    {

        $user = User::where(['email' => $request->email])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $request->validateWithBag('post', [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if (Auth::attempt($request->only('email', 'password'))){

            return response()->json(['auth'=>Auth::user(),'token'=>$token], 200);
        }
        throw ValidationException::withMessages([
            'email' =>['Las credenciales son incorrectas.']
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::find($request->user);
        $user->tokens()->delete();
        return response()->json(['message'=>'Sesion deleted!','success'=>true], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only(['email','password']);

        if(Auth::attempt($credentials))
        {
            return redirect()->route('bitcoin.index');   
        }
        return redirect()->route('login.index')->with('error','Usuário incorreto');
    }
    public function indexRegister()
    {
        return view('register');
    }
    public function register(UserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password
        ]);
        
        if($user)
        {
            return redirect()->route('login.index');
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();

        return redirect()->route('login.index');
    }
}

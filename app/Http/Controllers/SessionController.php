<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        //validate
        $attributes = request()->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        //Attemp
        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Gak cocok'
            ]);
        };
        //session
        request()->session()->regenerate();

        //redirect
        return redirect('/posts');
    }

    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}

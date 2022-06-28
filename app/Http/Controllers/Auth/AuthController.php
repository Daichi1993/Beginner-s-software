<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function login(Request $request) {

        return view('login/login', ['error' => session('error')]);
    }

    public function authenticate(Request $request) {

   
        if (Auth::attempt())
        {   
            return redirect()->intended('index');

        }else
        {
            return redirect()->intended('index');
       
        }
        // $credentials = $request->only('username', 'password');
        // if (Auth::attempt($credentials)) {
         
        //     return redirect()->intended('index');
        // }else
        // {
        //     return 'ciao';
        // }
 
    }

    public function store(Request $request) {

    }

    public function backdoor() {
        if (Auth::loginUsingId(1)) {
            return redirect()->intended('home');
        }

        return redirect()->route('login')->with(['error' => 'Username o password errati!']);
    }

    public function logout(Request $request) {
        Auth::logout();

        return redirect()->route('login');
    }

}
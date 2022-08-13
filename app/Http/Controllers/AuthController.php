<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(){

        return view('register.register-form');
    }

    public function store(Request $request){
        // $rand=rand(1000,9999);
        $rand= bin2hex(random_bytes(16));
        dd($rand);

        $activation_code= password_hash($rand, PASSWORD_DEFAULT);
        $activation_expiry=Carbon::now()->addDay(1);
        // dd($activation_expiry);
        $password=Hash::make($request->input('password'));
        $data['name']=$request->input('name');
        $data['email']=$request->input('email');
        $data['password']=$password;
        $data['activation_code']=$activation_code;
        $data['activation_expiry']=$activation_expiry;
        
        User::create($data);
        return redirect('/register');

        
    }

    public function loginView(){
        return view('login.login');
    }

    public function login(Request $request){
        dd($request->all());
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        return redirect('login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
}

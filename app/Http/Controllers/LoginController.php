<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(){
        return view('/content/auth/register');
    }
    public function login(){
        return view('/content/auth/login');
    }
    public function proses_auth(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect('dashboard')
                ->withSuccess('You have successfully logged in!');
        }else{
            return back()->with([
                'error' => 'Email dan password salah !',
            ]);
        }
    }
    public function store(Request $request){
        try{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect('/login');
        }catch(Exception $e){
            return redirect('/register');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')
            ->withSuccess('You have logged out successfully!');
    }    
    
}

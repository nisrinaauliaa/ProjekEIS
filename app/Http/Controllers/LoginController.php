<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'min:3', 'max:255'],
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();// untuk menghindari kejahatan session fixation (masuk ke celah keamanan menggunakkan session)
            return redirect()->intended('/dashboard');// intended: akan melakukan redirect user ke URL sebelum melewati sebuah authetication middleware
        }


            return back()->with('loginError', 'Gagal melakukan Log In.'); //kembali ke halaman log in + mengirimkan error-nya
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate(); //supaya tidak bisa digunakan
        request()->session()->regenerateToken(); //supaya tidak bisa dibajak
        return redirect('/'); //kembali ke halaman home

    }
}

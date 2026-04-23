<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $r)
    {
        $r->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = DB::table('users')
            ->where('username', $r->username)
            ->first();

        if ($user && Hash::check($r->password, $user->password)) {
            session(['user' => $user]);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
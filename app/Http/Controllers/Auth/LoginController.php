<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // tampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah!');
        }

        // simpan session
        session([
            'id_user' => $user->id_user,
            'username' => $user->username,
            'role' => $user->role
        ]);

        // redirect sesuai role
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'petugas') {
            return redirect('/petugas/dashboard');
        } else {
            return redirect('/anggota/dashboard');
        }
    }

    // logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
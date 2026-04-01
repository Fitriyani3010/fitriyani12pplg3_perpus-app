<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // tampilkan halaman register
    public function index()
    {
        return view('auth.register');
    }

    // proses register
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'nisn' => 'required|string|max:20'
        ]);

        // simpan ke database
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'nisn' => $request->nisn,
            'role' => 'anggota'
        ]);

        // redirect ke login + pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
}
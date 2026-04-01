<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // ================== INDEX ==================
    public function index(Request $request)
    {
        // Ambil username dari session untuk sidebar
        $username = $request->session()->get('username');

        // Ambil semua petugas
        $petugas = User::where('role', 'petugas')->get();

        // Kirim ke view
        return view('admin.petugas', compact('petugas', 'username'));
    }

    // ================== STORE ==================
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'alamat'   => 'required',
            'no_telp'  => 'required'
        ]);

        // Simpan ke database
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'alamat'   => $request->alamat,
            'no_telp'  => $request->no_telp,
            'nisn'     => null,
            'role'     => 'petugas',
            'status'   => 'aktif'
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Petugas berhasil ditambahkan!');
    }

    // ================== DESTROY ==================
    public function destroy($id)
    {
        User::where('id', $id)->where('role', 'petugas')->delete();

        return redirect()->back()->with('success', 'Petugas berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        // Ambil username dari session
        $username = $request->session()->get('username');

        // Ambil semua kategori
        $kategori = DB::table('kategori')
            ->orderBy('id_kategori', 'desc')
            ->get();

        return view('admin.kategori', compact('kategori', 'username'));
    }

    // ================= SIMPAN =================
    public function simpan(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori');
    }

    // ================= UPDATE =================
    public function update(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'id_kategori' => 'required|integer',
            'nama_kategori' => 'required|string|max:255',
        ]);

        DB::table('kategori')
            ->where('id_kategori', $request->id_kategori)
            ->update([
                'nama_kategori' => $request->nama_kategori
            ]);

        return redirect()->route('admin.kategori');
    }

    // ================= HAPUS =================
public function hapus($id)
{
    $cek = DB::table('buku')
        ->where('id_kategori', $id)
        ->count();

    if($cek > 0){
        return redirect()->back()->with('error', 'Kategori masih digunakan di buku!');
    }

    DB::table('kategori')
        ->where('id_kategori', $id)
        ->delete();

    return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
}
}
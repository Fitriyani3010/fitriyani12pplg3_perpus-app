<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $query = DB::table('buku')
            ->leftJoin('kategori', 'buku.id_kategori', '=', 'kategori.id_kategori')
            ->select('buku.*', 'kategori.nama_kategori');

        // FILTER KATEGORI
        if ($request->kategori) {
            $query->where('buku.id_kategori', $request->kategori);
        }

        // SEARCH
        if ($request->cari) {
            $query->where(function ($q) use ($request) {
                $q->where('buku.judul', 'like', '%' . $request->cari . '%')
                  ->orWhere('buku.penulis', 'like', '%' . $request->cari . '%');
            });
        }

        // DEFAULT ORDER
        $order = ['buku.id_buku', 'desc'];

        // URUT STOK
        if ($request->stok) {
            $order = ['buku.stok', $request->stok];
        }

        // URUT JUDUL
        if ($request->urut) {
            $order = ['buku.judul', $request->urut];
        }

        $buku = $query->orderBy($order[0], $order[1])->get();
        $kategori = DB::table('kategori')->orderBy('nama_kategori')->get();

        // AMBIL USERNAME DARI SESSION
        $username = $request->session()->get('username'); // default 'Guest' kalau belum login

        return view('admin.buku', compact('buku', 'kategori', 'username'));
    }

    // ================= TAMBAH =================
    public function store(Request $request)
    {
        $cover = null;

        if ($request->file('cover')) {
            $cover = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploads'), $cover);
        }

        DB::table('buku')->insert([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'stok' => $request->stok,
            'lokasi' => $request->lokasi,
            'cover' => $cover,
            'id_kategori' => $request->id_kategori
        ]);

        return redirect()->route('admin.buku');
    }

    // ================= UPDATE =================
    public function update(Request $request)
    {
        $data = DB::table('buku')->where('id_buku', $request->id_buku)->first();
        $cover = $data->cover;

        if ($request->file('cover')) {
            // Hapus cover lama jika ada
            if ($cover && file_exists(public_path('uploads/' . $cover))) {
                unlink(public_path('uploads/' . $cover));
            }

            $cover = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->move(public_path('uploads'), $cover);
        }

        DB::table('buku')->where('id_buku', $request->id_buku)->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'stok' => $request->stok,
            'lokasi' => $request->lokasi,
            'cover' => $cover,
            'id_kategori' => $request->id_kategori
        ]);

        return redirect()->route('admin.buku');
    }

    // ================= HAPUS =================
    public function hapus($id)
    {
        $data = DB::table('buku')->where('id_buku', $id)->first();

        if ($data && $data->cover) {
            $path = public_path('uploads/' . $data->cover);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        DB::table('buku')->where('id_buku', $id)->delete();

        return redirect()->route('admin.buku');
    }
}
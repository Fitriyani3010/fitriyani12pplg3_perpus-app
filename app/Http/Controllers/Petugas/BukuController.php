<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // kalau belum login
        if(!session()->has('id_user')){
    return redirect('/login');
}

if(session('role') != 'petugas'){
    return redirect('/login');
}

        $query = DB::table('buku as b')
            ->leftJoin('kategori as k', 'b.id_kategori', '=', 'k.id_kategori')
            ->select('b.*', 'k.nama_kategori');

        // FILTER KATEGORI
        if($request->kategori){
            $query->where('b.id_kategori', $request->kategori);
        }

        // SEARCH
        if($request->cari){
            $query->where(function($q) use ($request){
                $q->where('b.judul','like','%'.$request->cari.'%')
                  ->orWhere('b.penulis','like','%'.$request->cari.'%');
            });
        }

        // ORDER
        if($request->stok){
            $query->orderBy('b.stok', $request->stok);
        } elseif($request->urut){
            $query->orderBy('b.judul', $request->urut);
        } else {
            $query->orderBy('b.id_buku','desc');
        }

        $data_buku = $query->get();
        $data_kategori = DB::table('kategori')->orderBy('nama_kategori')->get();

        $username = session('username');

return view('petugas.buku', compact('data_buku','data_kategori','username'));
    }

    public function store(Request $request)
    {
        $cover = null;

        if($request->hasFile('cover')){
            $cover = time().'.'.$request->cover->extension();
            $request->cover->move(public_path('uploads'), $cover);
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

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $buku = DB::table('buku')->where('id_buku', $request->id_buku)->first();

        $cover = $buku->cover;

        if($request->hasFile('cover')){
            if($cover && file_exists(public_path('uploads/'.$cover))){
                unlink(public_path('uploads/'.$cover));
            }

            $cover = time().'.'.$request->cover->extension();
            $request->cover->move(public_path('uploads'), $cover);
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

        return redirect()->back();
    }

    public function destroy($id)
    {
        $buku = DB::table('buku')->where('id_buku', $id)->first();

        if($buku->cover && file_exists(public_path('uploads/'.$buku->cover))){
            unlink(public_path('uploads/'.$buku->cover));
        }

        DB::table('buku')->where('id_buku', $id)->delete();

        return redirect()->back();
    }
}
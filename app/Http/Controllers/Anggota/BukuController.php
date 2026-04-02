<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // CEK LOGIN
        if (!session('role') || session('role') != 'anggota') {
            return redirect('/login');
        }

        $id_user = session('id_user');
        $username = session('username');

        // DATA USER
        $user = DB::table('user')->where('id_user', $id_user)->first();

        /* ========================
           QUERY UTAMA (FIX GROUP BY ERROR)
        ========================= */
        $query = DB::table('buku')
            ->leftJoin('kategori', 'buku.id_kategori', '=', 'kategori.id_kategori')

            // SUBQUERY TOTAL PINJAM (SOLUSI AMAN)
            ->leftJoin(DB::raw('(
                SELECT id_buku, COUNT(*) as total_pinjam
                FROM peminjaman
                GROUP BY id_buku
            ) as pinjam'), 'buku.id_buku', '=', 'pinjam.id_buku')

            ->select(
                'buku.*',
                'kategori.nama_kategori',
                DB::raw('COALESCE(pinjam.total_pinjam, 0) as total_pinjam')
            );

        /* ========================
           SEARCH
        ========================= */
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('buku.judul', 'like', "%{$request->search}%")
                  ->orWhere('buku.penulis', 'like', "%{$request->search}%");
            });
        }

        /* ========================
           FILTER KATEGORI
        ========================= */
        if ($request->kategori) {
            $query->where('buku.id_kategori', $request->kategori);
        }

        /* ========================
           SORTING
        ========================= */
        if ($request->urut == "az") {
            $query->orderBy('buku.judul', 'asc');
        } elseif ($request->urut == "dipinjam_terbanyak") {
            $query->orderByDesc('total_pinjam');
        }

        /* ========================
           EXECUTE
        ========================= */
        $data = $query->get();

        // DATA KATEGORI
        $kategoriData = DB::table('kategori')->get();

        $halaman = "buku";

        return view('anggota.buku', compact(
            'data',
            'kategoriData',
            'user',
            'username',
            'halaman'
        ));
    }
}
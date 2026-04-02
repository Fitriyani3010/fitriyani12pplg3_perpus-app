<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CEK LOGIN
        if (!session('role') || session('role') != 'anggota') {
            return redirect('/login');
        }

        $username = session('username');
        $id_user  = session('id_user');

        $user = DB::table('user')->where('id_user', $id_user)->first();

        // TOTAL BUKU
        $total_buku = DB::table('buku')->count();

        // TOTAL PINJAM AKTIF
        $total_pinjam = DB::table('peminjaman as p')
            ->leftJoin('pengembalian as pg', 'p.id_peminjaman', '=', 'pg.id_peminjaman')
            ->where('p.id_user', $id_user)
            ->whereNull('pg.id_pengembalian')
            ->count();

        // TOTAL RIWAYAT
        $total_riwayat = DB::table('peminjaman')
            ->where('id_user', $id_user)
            ->count();

        // TOTAL DENDA (belum dibayar)
        $total_denda = DB::table('denda as d')
            ->join('peminjaman as p', 'd.id_peminjaman', '=', 'p.id_peminjaman')
            ->where('p.id_user', $id_user)
            ->where('d.status', 0)
            ->count();

        // TOP BUKU
        $top_buku = DB::table('peminjaman as p')
            ->join('buku as b', 'b.id_buku', '=', 'p.id_buku')
            ->select('b.judul', 'b.cover', DB::raw('COUNT(p.id_buku) as total_pinjam'))
            ->groupBy('p.id_buku', 'b.judul', 'b.cover')
            ->orderByDesc('total_pinjam')
            ->limit(4)
            ->get();

        $halaman = "dashboard";

        return view('anggota.dashboard', compact(
            'username',
            'user',
            'total_buku',
            'total_pinjam',
            'total_riwayat',
            'total_denda',
            'top_buku',
            'halaman'
        ));
    }
}
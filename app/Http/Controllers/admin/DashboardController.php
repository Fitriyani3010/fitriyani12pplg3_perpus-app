<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil session
        $username = session('username');
        $role = session('role');

        // proteksi admin
        if ($role != 'admin') {
            return redirect('/login');
        }

        // TOTAL
        $total_buku = DB::table('buku')->count();

        $total_anggota = DB::table('user')
            ->where('role', 'anggota')
            ->count();

        $total_petugas = DB::table('user')
            ->where('role', 'petugas')
            ->count();

        $total_pinjam = DB::table('peminjaman as p')
            ->leftJoin('pengembalian as pg', 'p.id_peminjaman', '=', 'pg.id_peminjaman')
            ->whereNull('pg.id_pengembalian')
            ->count();

        $total_denda = DB::table('denda')
            ->where('status', 0)
            ->count();

        $kembali_hari_ini = DB::table('pengembalian')
            ->whereDate('tgl_pengembalian', now())
            ->count();

        $total_kembali = DB::table('pengembalian')->count();

        // TOP BUKU
        $top_buku = DB::table('peminjaman as p')
            ->join('buku as b', 'p.id_buku', '=', 'b.id_buku')
            ->select('b.judul', DB::raw('COUNT(p.id_buku) as total'))
            ->groupBy('p.id_buku', 'b.judul')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // CHART 7 HARI
        $data_pinjam = [];
        $data_kembali = [];
        $label_tanggal = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->format('Y-m-d');
            $label_tanggal[] = date('d M', strtotime($tanggal));

            $data_pinjam[] = DB::table('peminjaman')
                ->whereDate('tgl_peminjaman', $tanggal)
                ->count();

            $data_kembali[] = DB::table('pengembalian')
                ->whereDate('tgl_pengembalian', $tanggal)
                ->count();
        }

        // AKTIVITAS TERBARU
        $recent = DB::table('peminjaman as p')
            ->join('user as u', 'p.id_user', '=', 'u.id_user')
            ->join('buku as b', 'p.id_buku', '=', 'b.id_buku')
            ->select('u.username', 'b.judul', 'p.tgl_peminjaman')
            ->orderByDesc('p.tgl_peminjaman')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'username',
            'total_buku',
            'total_anggota',
            'total_petugas',
            'total_pinjam',
            'total_denda',
            'kembali_hari_ini',
            'total_kembali',
            'top_buku',
            'data_pinjam',
            'data_kembali',
            'label_tanggal',
            'recent'
        ));
    }
}
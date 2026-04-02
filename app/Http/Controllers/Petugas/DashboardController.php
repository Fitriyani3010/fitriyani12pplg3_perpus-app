<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // CEK ROLE
        if(session('role') != 'petugas'){
            return redirect('/login');
        }

        $username = session('username');

        // USER
        $user = DB::table('user')->where('username', $username)->first();

        // TOTAL BUKU
        $total_buku = DB::table('buku')->count();

        // TOTAL ANGGOTA
        $total_anggota = DB::table('user')->where('role','anggota')->count();

        // PEMINJAMAN AKTIF
        $total_pinjam = DB::table('peminjaman as p')
            ->leftJoin('pengembalian as pg','p.id_peminjaman','=','pg.id_peminjaman')
            ->whereNull('pg.id_pengembalian')
            ->count();

        // PENGEMBALIAN HARI INI
        $total_kembali_hariini = DB::table('pengembalian')
            ->whereDate('tgl_pengembalian', now())
            ->count();

        // DENDA
        $total_denda = DB::table('denda')
            ->where('status',0)
            ->count();

        // TERLAMBAT
        $total_terlambat = DB::table('peminjaman as p')
            ->leftJoin('pengembalian as pg','p.id_peminjaman','=','pg.id_peminjaman')
            ->whereNull('pg.id_pengembalian')
            ->whereRaw('DATEDIFF(CURDATE(), p.tgl_peminjaman) > 7')
            ->count();

        // PEMINJAMAN TERBARU
        $peminjaman_terbaru = DB::table('peminjaman as p')
            ->join('user as u','u.id_user','=','p.id_user')
            ->join('buku as b','b.id_buku','=','p.id_buku')
            ->leftJoin('pengembalian as pg','p.id_peminjaman','=','pg.id_peminjaman')
            ->whereNull('pg.id_pengembalian')
            ->select(
                'u.username',
                'b.judul',
                'p.tgl_peminjaman',
                DB::raw('DATEDIFF(CURDATE(), p.tgl_peminjaman) as selisih_hari')
            )
            ->orderByDesc('p.id_peminjaman')
            ->limit(4)
            ->get();

        // DATA CHART
        $data_chart = [];
        $data_kembali = [];

        for($i=6; $i>=0; $i--){
            $tanggal = now()->subDays($i)->toDateString();

            $data_chart[] = DB::table('peminjaman')
                ->whereDate('tgl_peminjaman',$tanggal)
                ->count();

            $data_kembali[] = DB::table('pengembalian')
                ->whereDate('tgl_pengembalian',$tanggal)
                ->count();
        }

        return view('petugas.dashboard', compact(
            'username','user','total_buku','total_anggota',
            'total_pinjam','total_kembali_hariini',
            'total_denda','total_terlambat',
            'peminjaman_terbaru','data_chart','data_kembali'
        ));
    }
}
<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // CEK LOGIN
        if (!session('role') || session('role') != 'petugas') {
            return redirect('/login');
        }

        $username = session('username');
        $id_user  = session('id_user');

        $user = DB::table('user')->where('id_user', $id_user)->first();

        // 🔥 AMBIL LAMA PINJAM
        $lama_pinjam = DB::table('pengaturan')
            ->where('nama_pengaturan', 'lama_pinjam')
            ->value('nilai') ?? 7;

        // ================= KEMBALIKAN =================
        if ($request->kembalikan) {

            $pinjam = DB::table('peminjaman')
                ->where('id_peminjaman', $request->kembalikan)
                ->first();

            if ($pinjam && $pinjam->status != 'dikembalikan') {

                $tgl_kembali = date('Y-m-d');

                // 🔥 HITUNG TENGGAT
                $tenggat = date('Y-m-d', strtotime($pinjam->tgl_peminjaman . " +$lama_pinjam days"));

                $terlambat = 0;
                $denda = 0;

                if ($tgl_kembali > $tenggat) {
                    $selisih = (strtotime($tgl_kembali) - strtotime($tenggat)) / 86400;
                    $terlambat = $selisih;
                    $denda = $selisih * 1000;
                }

                // SIMPAN PENGEMBALIAN (TANPA DENDA)
                DB::table('pengembalian')->insert([
                    'id_peminjaman' => $request->kembalikan,
                    'tgl_pengembalian' => $tgl_kembali,
                    'terlambat' => $terlambat,
                    'status_verifikasi' => 1
                ]);

                // 🔥 SIMPAN KE TABEL DENDA
                if ($denda > 0) {
                    DB::table('denda')->insert([
                        'id_peminjaman' => $request->kembalikan,
                        'jumlah_denda' => $denda,
                        'status' => 0
                    ]);
                }

                // UPDATE STATUS
                DB::table('peminjaman')
                    ->where('id_peminjaman', $request->kembalikan)
                    ->update(['status' => 'dikembalikan']);

                // TAMBAH STOK
                DB::table('buku')
                    ->where('id_buku', $pinjam->id_buku)
                    ->increment('stok', $pinjam->jumlah);
            }

            return redirect()->route('petugas.peminjaman');
        }

        // ================= FILTER =================
        $search = $request->search;
        $dari   = $request->dari;
        $sampai = $request->sampai;
        $status = $request->status_pinjam;

        $query = DB::table('peminjaman as p')
            ->join('user as u', 'p.id_user', '=', 'u.id_user')
            ->join('buku as b', 'p.id_buku', '=', 'b.id_buku')
            ->leftJoin('pengembalian as peng', 'p.id_peminjaman', '=', 'peng.id_peminjaman')
            ->leftJoin('denda as d', 'p.id_peminjaman', '=', 'd.id_peminjaman') // 🔥 JOIN DENDA
            ->select(
                'p.id_peminjaman',
                'u.username',
                'b.judul',
                'p.jumlah',
                'p.tgl_peminjaman',

                // 🔥 HITUNG TENGGAT
                DB::raw("DATE_ADD(p.tgl_peminjaman, INTERVAL $lama_pinjam DAY) as tenggat_waktu"),

                'peng.tgl_pengembalian',
                'd.jumlah_denda as denda', // 🔥 AMBIL DENDA DARI TABEL DENDA
                'peng.status_verifikasi'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('u.username', 'like', "%$search%")
                  ->orWhere('b.judul', 'like', "%$search%");
            });
        }

        if ($dari && $sampai) {
            $query->whereBetween('p.tgl_peminjaman', [$dari, $sampai]);
        }

        if ($status == 'dikembalikan') {
            $query->whereNotNull('peng.tgl_pengembalian');
        }

        if ($status == 'dipinjam') {
            $query->whereNull('peng.tgl_pengembalian');
        }

        if ($status == 'terlambat') {
            $query->whereNull('peng.tgl_pengembalian')
                  ->whereRaw("DATE_ADD(p.tgl_peminjaman, INTERVAL $lama_pinjam DAY) < CURDATE()");
        }

        if ($status == 'menunggu') {
            $query->where('peng.status_verifikasi', 0);
        }

        $data = $query->orderByDesc('p.id_peminjaman')->get();

        return view('petugas.peminjaman', compact(
            'data',
            'username',
            'user',
            'search',
            'dari',
            'sampai',
            'status'
        ));
    }
}
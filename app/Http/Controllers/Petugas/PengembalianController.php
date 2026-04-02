<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // ================= CEK LOGIN =================
        if (!session('role') || session('role') != 'petugas') {
            return redirect('/login');
        }

        $username = session('username');
        $id_user  = session('id_user');

        $user = DB::table('user')->where('id_user', $id_user)->first();

        // ================= AMBIL PENGATURAN =================
        $lama_pinjam = DB::table('pengaturan')
            ->where('nama_pengaturan', 'lama_pinjam')
            ->value('nilai');

        $denda_per_hari = DB::table('pengaturan')
            ->where('nama_pengaturan', 'denda')
            ->value('nilai');

        // ================= KONFIRMASI =================
        if ($request->konfirmasi) {

            $data = DB::table('pengembalian as peng')
                ->join('peminjaman as p', 'peng.id_peminjaman', '=', 'p.id_peminjaman')
                ->select('peng.*', 'p.id_buku', 'p.jumlah', 'p.tgl_pinjam')
                ->where('peng.id_pengembalian', $request->konfirmasi)
                ->first();

            if ($data && $data->status_verifikasi == 0) {

                // ================= HITUNG DENDA =================
                $tgl_pinjam = strtotime($data->tgl_pinjam);
                $tgl_kembali = strtotime($data->tgl_pengembalian);

                $batas = strtotime("+$lama_pinjam days", $tgl_pinjam);

                $terlambat = 0;
                if ($tgl_kembali > $batas) {
                    $terlambat = floor(($tgl_kembali - $batas) / (60 * 60 * 24));
                }

                $total_denda = $terlambat * $denda_per_hari;

                // ================= SIMPAN KE TABEL DENDA =================
                if ($total_denda > 0) {
                    DB::table('denda')->updateOrInsert(
                        ['id_peminjaman' => $data->id_peminjaman],
                        [
                            'jumlah_denda' => $total_denda,
                            'status' => 'belum_dibayar'
                        ]
                    );
                }

                // ================= UPDATE STATUS =================
                DB::table('pengembalian')
                    ->where('id_pengembalian', $request->konfirmasi)
                    ->update(['status_verifikasi' => 1]);

                DB::table('peminjaman')
                    ->where('id_peminjaman', $data->id_peminjaman)
                    ->update(['status' => 'dikembalikan']);

                DB::table('buku')
                    ->where('id_buku', $data->id_buku)
                    ->increment('stok', $data->jumlah);
            }

            return redirect()->route('petugas.pengembalian');
        }

        // ================= TOLAK =================
        if ($request->tolak) {

            DB::table('pengembalian')
                ->where('id_pengembalian', $request->tolak)
                ->update(['status_verifikasi' => 2]);

            return redirect()->route('petugas.pengembalian');
        }

        // ================= AMBIL DATA =================
        $data = DB::table('pengembalian as peng')
            ->join('peminjaman as p', 'peng.id_peminjaman', '=', 'p.id_peminjaman')
            ->join('user as u', 'p.id_user', '=', 'u.id_user')
            ->join('buku as b', 'p.id_buku', '=', 'b.id_buku')
            ->leftJoin('denda as d', 'p.id_peminjaman', '=', 'd.id_peminjaman')
            ->where('peng.status_verifikasi', 0)
            ->select(
                'peng.id_pengembalian',
                'u.username',
                'b.judul',
                'p.tgl_peminjaman',
                'peng.tgl_pengembalian',
                'd.jumlah_denda as denda',
                'peng.status_verifikasi'
            )
            ->orderByDesc('peng.id_pengembalian')
            ->get();

        // ================= HITUNG TERLAMBAT OTOMATIS =================
        foreach ($data as $item) {

            $tgl_pinjam = strtotime($item->tgl_pinjam);
            $tgl_kembali = strtotime($item->tgl_pengembalian);

            $batas = strtotime("+$lama_pinjam days", $tgl_pinjam);

            $terlambat = 0;
            if ($tgl_kembali > $batas) {
                $terlambat = floor(($tgl_kembali - $batas) / (60 * 60 * 24));
            }

            $item->terlambat = $terlambat;
            $item->denda = $item->denda ?? ($terlambat * $denda_per_hari);
        }

        return view('petugas.pengembalian', compact('data','username','user'));
    }
}
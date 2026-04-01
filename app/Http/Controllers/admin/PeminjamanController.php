<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengaturan;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // ================== INDEX ==================
    public function index(Request $request)
    {
        // Ambil username dari session untuk sidebar
        $username = $request->session()->get('username');

        // Ambil pengaturan
        $denda_per_hari = Pengaturan::where('nama_pengaturan', 'denda_per_hari')->value('nilai');
        $lama_pinjam    = Pengaturan::where('nama_pengaturan', 'lama_pinjam')->value('nilai');

        $search         = $request->input('search');
        $dari           = $request->input('dari');
        $sampai         = $request->input('sampai');
        $status_pinjam  = $request->input('status_pinjam');

        $query = Peminjaman::with(['user', 'buku', 'pengembalian']);

        if($search){
            $query->whereHas('user', fn($q) => $q->where('username','like',"%$search%"))
                  ->orWhereHas('buku', fn($q) => $q->where('judul','like',"%$search%"));
        }

        if($dari && $sampai){
            $query->whereBetween('tgl_peminjaman', [$dari, $sampai]);
        }

        if($status_pinjam == 'dikembalikan'){
            $query->whereHas('pengembalian', fn($q) => $q);
        } elseif($status_pinjam == 'dipinjam'){
            $query->doesntHave('pengembalian');
        } elseif($status_pinjam == 'terlambat'){
            $query->doesntHave('pengembalian')
                  ->where('tenggat_waktu', '<', Carbon::now()->toDateString());
        } elseif($status_pinjam == 'menunggu'){
            $query->whereHas('pengembalian', fn($q) => $q->where('status_verifikasi',0));
        }

        $peminjaman = $query->orderBy('id_peminjaman','desc')->get();

        return view('admin.peminjaman', compact(
            'peminjaman', 'denda_per_hari', 'lama_pinjam', 
            'search', 'dari', 'sampai', 'status_pinjam', 'username'
        ));
    }

    // ================== UPDATE DENDA ==================
    public function updateDenda(Request $request)
    {
        $request->validate([
            'nilai_denda' => 'required|numeric|min:0'
        ]);

        Pengaturan::where('nama_pengaturan','denda_per_hari')->update(['nilai'=>$request->nilai_denda]);

        return redirect()->route('peminjaman.index')->with('success','Denda berhasil diperbarui');
    }

    // ================== UPDATE LAMA PINJAM ==================
    public function updateLama(Request $request)
    {
        $request->validate([
            'nilai_lama' => 'required|numeric|min:1'
        ]);

        Pengaturan::where('nama_pengaturan','lama_pinjam')->update(['nilai'=>$request->nilai_lama]);

        return redirect()->route('peminjaman.index')->with('success','Lama pinjam berhasil diperbarui');
    }

    // ================== KEMBALIKAN BUKU ==================
    public function kembalikan($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        if(!$pinjam->pengembalian){
            $tgl_kembali = Carbon::now()->toDateString();
            $tenggat     = $pinjam->tenggat_waktu;

            $terlambat = 0;
            $denda     = 0;
            $denda_per_hari = Pengaturan::where('nama_pengaturan', 'denda_per_hari')->value('nilai');

            if($tgl_kembali > $tenggat){
                $selisih = Carbon::parse($tgl_kembali)->diffInDays(Carbon::parse($tenggat));
                $terlambat = $selisih;
                $denda     = $selisih * $denda_per_hari;
            }

            Pengembalian::create([
                'id_peminjaman'     => $id,
                'tgl_pengembalian'  => $tgl_kembali,
                'terlambat'         => $terlambat,
                'denda'             => $denda,
                'status_verifikasi' => 1
            ]);

            $pinjam->update(['status'=>'dikembalikan']);

            $pinjam->buku->increment('stok', $pinjam->jumlah);
        }

        return redirect()->route('peminjaman.index')->with('success','Buku berhasil dikembalikan');
    }
}
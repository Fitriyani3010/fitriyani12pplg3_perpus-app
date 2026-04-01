<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        // Ambil username dari session
        $username = $request->session()->get('username');

        // PARAMETER FILTER & SEARCH
        $search = $request->search;
        $filter = $request->filter;
        $status_filter = $request->status;

        // DEFAULT ORDER
        $orderBy = "u.username";
        $sort = "ASC";

        if ($filter == "pinjam") {
            $orderBy = "total_pinjam";
            $sort = "DESC";
        } elseif ($filter == "belum") {
            $orderBy = "belum_kembali";
            $sort = "DESC";
        } elseif ($filter == "nunggak") {
            $orderBy = "nunggak";
            $sort = "DESC";
        } elseif ($filter == "denda") {
            $orderBy = "total_denda";
            $sort = "DESC";
        }

        // QUERY DATA ANGGOTA
        $data_siswa = DB::table('user as u')
            ->leftJoin('peminjaman as p', 'u.id_user', '=', 'p.id_user')
            ->leftJoin('pengembalian as peng', 'p.id_peminjaman', '=', 'peng.id_peminjaman')
            ->select(
                'u.id_user',
                'u.username',
                'u.status',

                // TOTAL PINJAM
                DB::raw('COUNT(p.id_peminjaman) as total_pinjam'),

                // BELUM KEMBALI
                DB::raw('SUM(
                    CASE 
                        WHEN p.id_peminjaman IS NOT NULL 
                        AND peng.id_pengembalian IS NULL 
                        THEN 1 ELSE 0 
                    END
                ) as belum_kembali'),

                // NUNGGAK
                DB::raw('SUM(
                    CASE 
                        WHEN p.id_peminjaman IS NOT NULL 
                        AND peng.id_pengembalian IS NULL
                        AND DATE_ADD(
                            p.tgl_peminjaman, 
                            INTERVAL (
                                SELECT nilai 
                                FROM pengaturan 
                                WHERE nama_pengaturan = "max_hari_pinjam" 
                                LIMIT 1
                            ) DAY
                        ) < CURDATE()
                        THEN 1 ELSE 0 
                    END
                ) as nunggak'),

                // TOTAL DENDA
                DB::raw('SUM(
                    CASE 
                        WHEN peng.id_pengembalian IS NOT NULL 
                        AND DATEDIFF(peng.tgl_pengembalian, p.tgl_peminjaman) >
                            (SELECT nilai FROM pengaturan WHERE nama_pengaturan = "max_hari_pinjam" LIMIT 1)
                        THEN 
                            (DATEDIFF(peng.tgl_pengembalian, p.tgl_peminjaman) - 
                             (SELECT nilai FROM pengaturan WHERE nama_pengaturan = "max_hari_pinjam" LIMIT 1))
                            * (SELECT nilai FROM pengaturan WHERE nama_pengaturan = "denda per hari" LIMIT 1)
                        ELSE 0
                    END
                ) as total_denda')
            )
            ->where('u.role', 'anggota')
            ->when($search, function ($q) use ($search) {
                $q->where('u.username', 'like', "%$search%");
            })
            ->when($status_filter, function ($q) use ($status_filter) {
                $q->where('u.status', $status_filter);
            })
            ->groupBy('u.id_user', 'u.username', 'u.status')
            ->orderBy($orderBy, $sort)
            ->get();

        // Kirim ke view
        return view('admin.anggota', compact('data_siswa', 'search', 'filter', 'status_filter', 'username'));
    }

    // ================= SUSPEND =================
    public function suspend($id)
    {
        DB::table('user')->where('id_user', $id)->update([
            'status' => 'nonaktif'
        ]);

        return redirect()->route('admin.anggota');
    }

    // ================= AKTIFKAN =================
    public function aktifkan($id)
    {
        DB::table('user')->where('id_user', $id)->update([
            'status' => 'aktif'
        ]);

        return redirect()->route('admin.anggota');
    }
}
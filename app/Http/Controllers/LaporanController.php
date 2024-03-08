<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Traits\ApiResponder;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data pengembalian
    public function index(Request $request)
    {
        $bulan = $request->input("bulan");
        $tahun = $request->input("tahun");
        if ($request->ajax()) {
            $peminjamans = Peminjaman::with(['mobil', 'peminjam'])
                ->whereHas('mobil', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->latest()
                ->get();

            // Jika ada input mode dengan value datatable menampilkan data pengembalian dari user login
            if ($request->input("mode") == "datatable") {
                return DataTables::of($peminjamans)
                    ->addColumn('img', function ($peminjaman) {
                        return '<img src="/storage/image/mobil/' . $peminjaman->mobil->image . '" width="150px" alt="">';
                    })
                    ->addColumn('mobil', function ($peminjaman) {
                        return $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . ' (' . $peminjaman->mobil->nomor_plat . ')';
                    })
                    ->addColumn('tanggal', function ($peminjaman) {
                        return formatTanggal($peminjaman->created_at);
                    })
                    ->addColumn('peminjam', function ($peminjaman) {
                        return $peminjaman->peminjam->nama;
                    })
                    ->addColumn('biaya', function ($peminjaman) {
                        return formatRupiah($peminjaman->pengembalian->biaya_sewa + $peminjaman->pengembalian->denda_sewa);
                    })
                    ->addColumn('detail', function ($peminjaman) {
                        return '<button class="btn btn-info mr-1" onclick="getModalDetail(\'showModalSewa\', \'/laporan/' . $peminjaman->id . '\')"><i class="fas fa-info-circle"></i></button>';
                    })

                    ->addIndexColumn()
                    ->rawColumns(['img', 'mobil', 'tanggal', 'detail'])
                    ->make(true);
            }
        }
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['mobil', 'peminjam'])
            ->where("id", $id)
            ->first();

        if (!$peminjaman) {
            return $this->errorResponse(null, 'Data Peminjaman tidak ditemukan.', 404);
        }

        $mode = null;

        return view('pages.laporan.detail', compact('peminjaman'));
    }
}
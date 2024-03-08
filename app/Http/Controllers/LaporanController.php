<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Traits\ApiResponder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data laporan
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

            // Jika ada input mode dengan value datatable menampilkan data laporan dari user login
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

        // jika ada input mode pdf makan akan menampilkan lapora reka sewa
        if ($request->input("mode") == "pdf") {
            $peminjamans = Peminjaman::with(['mobil', 'peminjam'])
                ->whereHas('mobil', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->latest()
                ->get();

            $bulanTahun = Carbon::create($tahun, $bulan, 1)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('F Y');

            $pdf = PDF::loadView('pages.laporan.pdf', compact('peminjamans', 'bulanTahun'));

            $options = [
                'margin_top' => 20,
                'margin_right' => 20,
                'margin_bottom' => 20,
                'margin_left' => 20,
            ];

            $pdf->setOptions($options);
            $pdf->setPaper('legal', 'landscape');

            $namaFile = 'laporan_penyewaan_' . $bulan . '_' . $tahun . '.pdf';

            ob_end_clean();
            ob_start();
            return $pdf->stream($namaFile);
        }
    }

    // function untuk melihhat detail penyewa yang menggunakan mobil rental
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

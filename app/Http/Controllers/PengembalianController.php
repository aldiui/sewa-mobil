<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Traits\ApiResponder;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data pengembalian
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pengembalians = Pengembalian::with("peminjaman")->where("peminjam_id", Auth::user()->id)->latest()->get();

            // Jika ada input mode dengan value datatable menampilkan data pengembalian dari user login
            if ($request->input("mode") == "datatable") {
                return DataTables::of($pengembalians)
                    ->addColumn('img', function ($pengembalian) {
                        return '<img src="/storage/image/mobil/' . $pengembalian->peminjaman->mobil->image . '" width="150px" alt="">';
                    })
                    ->addColumn('mobil', function ($pengembalian) {
                        return $pengembalian->peminjaman->mobil->merek . ' - ' . $pengembalian->peminjaman->mobil->model . ' (' . $pengembalian->peminjaman->mobil->nomor_plat . ')';
                    })
                    ->addColumn('tanggal', function ($pengembalian) {
                        return formatTanggal($pengembalian->created_at);
                    })
                    ->addColumn('biaya', function ($pengembalian) {
                        return formatRupiah($pengembalian->biaya_sewa + $pengembalian->denda_sewa);
                    })
                    ->addColumn('detail', function ($pengembalian) {
                        return '<button class="btn btn-info mr-1" onclick="getModalDetail(\'showModal\', \'/pengembalian/' . $pengembalian->id . '\')"><i class="fas fa-info-circle"></i></button>';
                    })

                    ->addIndexColumn()
                    ->rawColumns(['img', 'mobil', 'tanggal', 'detail'])
                    ->make(true);
            }
        }

        return view('pages.pengembalian.index');
    }

    // Function untuk menambahkan data pengembalian
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'jumlah_hari' => 'required|numeric',
            'jumlah_denda_hari' => 'required|numeric',
            'biaya_sewa' => 'required|numeric',
            'denda_sewa' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $peminjaman = Peminjaman::find($request->input('peminjaman_id'));

        $pengembalian = Pengembalian::create([
            'kode_pengembalian' => 'KBL_' . strtoupper(uniqid()),
            'peminjaman_id' => $peminjaman->id,
            'jumlah_hari' => $request->input('jumlah_hari'),
            'jumlah_denda_hari' => $request->input('jumlah_denda_hari'),
            'biaya_sewa' => $request->input('biaya_sewa'),
            'denda_sewa' => $request->input('denda_sewa'),
            'peminjam_id' => Auth::user()->id,
        ]);

        $peminjaman->update([
            'status' => '1',
            'tanggal_pengembalian' => $pengembalian->created_at,
        ]);

        return $this->successResponse($pengembalian, 'Pengembalian Mobil berhasil.', 201);
    }

    // function untuk melihat detail peminjaman
    public function show($id)
    {
        $pengembalian = Pengembalian::with("peminjaman")
            ->where("id", $id)
            ->where("peminjam_id", Auth::user()->id)
            ->first();

        if (!$pengembalian) {
            return $this->errorResponse(null, 'Data Pengembalian tidak ditemukan.', 404);
        }

        return view('pages.pengembalian.detail', compact('pengembalian'));
    }
}

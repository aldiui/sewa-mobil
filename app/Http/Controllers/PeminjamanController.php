<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Traits\ApiResponder;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data peminjaman
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $peminjamans = Peminjaman::with("mobil")->where("peminjam_id", Auth::user()->id)->latest()->get();

            // Jika ada input mode dengan value datatable menampilkan data peminjaman dari user login
            if ($request->input("mode") == "datatable") {
                return DataTables::of($peminjamans)
                    ->addColumn('img', function ($peminjaman) {
                        return '<img src="/storage/image/mobil/' . $peminjaman->mobil->image . '" width="150px" alt="">';
                    })
                    ->addColumn('mobil', function ($peminjaman) {
                        return $peminjaman->mobil->merek . ' - ' . $peminjaman->mobil->model . ' (' . $peminjaman->mobil->nomor_plat . ')';
                    })
                    ->addColumn('tanggal', function ($peminjaman) {
                        return formatTanggal($peminjaman->tanggal_mulai) . ' - ' . formatTanggal($peminjaman->tanggal_selesai);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['img', 'mobil', 'tanggal'])
                    ->make(true);
            } elseif ($request->input("nomor_plat")) {
                // untuk mengecek data peminjaman berdasarkan nomor plat
                $cekMobil = Mobil::where('nomor_plat', $request->input("nomor_plat"))->first();
                if ($cekMobil) {
                    $peminjaman = Peminjaman::with("mobil")
                        ->where("mobil_id", $cekMobil->id)
                        ->where("peminjam_id", Auth::user()->id)
                        ->where("status", "0")
                        ->latest()
                        ->first();
                    $cekPengembalian = Pengembalian::where("peminjaman_id", $peminjaman->id)->first();

                    if ($peminjaman && !$cekPengembalian) {
                        return view('pages.peminjaman.show', compact('peminjaman'))->render();
                    }
                }

                return view('pages.peminjaman.show', ['peminjaman' => null])->render();
            }

        }

        return view('pages.peminjaman.index');
    }

    // Function untuk melakukan peminjaman
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'mobil_id' => 'required||exists:mobils,id',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $mobilId = $request->input('mobil_id');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        $cekMobilSendiri = Mobil::where('id', $mobilId)->where('user_id', Auth::user()->id)->first();
        if ($cekMobilSendiri) {
            return $this->errorResponse(null, 'Anda tidak dapat menyewa mobil sendiri.', 422);
        }

        $cekMobilPinjaman = Peminjaman::where('mobil_id', $mobilId)
            ->where(function ($query) use ($tanggalMulai, $tanggalSelesai) {
                $query->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalSelesai])
                    ->orWhereBetween('tanggal_selesai', [$tanggalMulai, $tanggalSelesai]);
            })
            ->where('status', '0')
            ->latest()
            ->first();

        if ($cekMobilPinjaman) {
            return $this->errorResponse(null, 'Mobil sedang dipinjam.', 422);
        }

        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'PJM_' . strtoupper(uniqid()),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'mobil_id' => $mobilId,
            'peminjam_id' => Auth::user()->id,
        ]);

        return $this->successResponse($peminjaman, 'Peminjaman Mobil di Proses.', 201);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\User;
use App\Traits\ApiResponder;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    use ApiResponder;

    // Function untuk mendapatkan tampilan data mobil
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $mobils = Mobil::where("user_id", Auth::user()->id)->get();

            // Jika ada input mode dengan value datatable menampilkan data mobil dari user login
            if ($request->input("mode") == "datatable") {
                return DataTables::of($mobils)
                    ->addColumn('aksi', function ($mobil) {
                        $detailButton = '<button class="btn btn-info mr-1" onclick="getModalDetail(\'showModal\',\'/sewa-mobil/' . $mobil->id . '\')"><i class="fas fa-info-circle"></i></button>';
                        $editButton = '<button class="btn btn-warning mr-1" onclick="getModal(\'createModal\', \'/mobil/' . $mobil->id . '\', [\'id\', \'merek\', \'model\', \'tipe\', \'warna\', \'bahan_bakar\', \'tahun_keluar\', \'kapasitas_penumpang\', \'nomor_plat\', \'tarif_sewa_perhari\', \'tarif_denda_perhari\', \'status\'])"><i class="fas fa-edit"></i></button>';
                        $deleteButton = '<button class="btn btn-danger" onclick="confirmDelete(\'/mobil/' . $mobil->id . '\', \'mobil-table\')"><i class="fas fa-trash"></i></button>';
                        return $detailButton . $editButton . $deleteButton;
                    })

                    ->addColumn('img', function ($mobil) {
                        return '<img src="/storage/image/mobil/' . $mobil->image . '" width="150px" alt="">';
                    })
                    ->addColumn('tarif_sewa', function ($mobil) {
                        return formatRupiah($mobil->tarif_sewa_perhari);
                    })
                    ->addIndexColumn()
                    ->rawColumns(['aksi', 'img', 'tarif_sewa'])
                    ->make(true);
            }
        }

        return view('pages.mobil.index');
    }

    // Function untuk menyimpan data mobil
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:png,jpg,jpeg|required',
            'merek' => 'required',
            'model' => 'required',
            'tipe' => 'required',
            'warna' => 'required',
            'bahan_bakar' => 'required',
            'tahun_keluar' => 'required',
            'kapasitas_penumpang' => 'required',
            'nomor_plat' => 'required',
            'tarif_sewa_perhari' => 'required',
            'tarif_denda_perhari' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/image/mobil', $image);
        }

        $mobil = Mobil::create([
            'merek' => $request->input('merek'),
            'model' => $request->input('model'),
            'tipe' => $request->input('tipe'),
            'warna' => $request->input('warna'),
            'bahan_bakar' => $request->input('bahan_bakar'),
            'tahun_keluar' => $request->input('tahun_keluar'),
            'kapasitas_penumpang' => $request->input('kapasitas_penumpang'),
            'nomor_plat' => $request->input('nomor_plat'),
            'tarif_sewa_perhari' => $request->input('tarif_sewa_perhari'),
            'tarif_denda_perhari' => $request->input('tarif_denda_perhari'),
            'image' => $image,
            'user_id' => Auth::user()->id,
            'status' => $request->input('status'),
        ]);

        return $this->successResponse($mobil, 'Data Mobil ditambahkan.', 201);
    }

    // Function untuk menampilkan data mobil
    public function show($id)
    {

        $mobil = Mobil::find($id);

        if (!$mobil) {
            return $this->errorResponse(null, 'Data Mobil tidak ditemukan.', 404);
        }

        return $this->successResponse($mobil, 'Data Mobil ditemukan.');
    }

    // Function untuk mengupdate data mobil
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:png,jpg,jpeg',
            'merek' => 'required',
            'model' => 'required',
            'tipe' => 'required',
            'warna' => 'required',
            'bahan_bakar' => 'required',
            'tahun_keluar' => 'required',
            'kapasitas_penumpang' => 'required',
            'nomor_plat' => 'required',
            'tarif_sewa_perhari' => 'required',
            'tarif_denda_perhari' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $mobil = Mobil::find($id);

        if (!$mobil) {
            return $this->errorResponse(null, 'Data Mobil tidak ditemukan.', 404);
        }

        $updateMobil = [
            'merek' => $request->input('merek'),
            'model' => $request->input('model'),
            'tipe' => $request->input('tipe'),
            'warna' => $request->input('warna'),
            'bahan_bakar' => $request->input('bahan_bakar'),
            'tahun_keluar' => $request->input('tahun_keluar'),
            'kapasitas_penumpang' => $request->input('kapasitas_penumpang'),
            'nomor_plat' => $request->input('nomor_plat'),
            'tarif_sewa_perhari' => $request->input('tarif_sewa_perhari'),
            'status' => $request->input('status'),
        ];

        if ($request->hasFile('image')) {
            if (Storage::exists('public/image/mobil/' . $mobil->image)) {
                Storage::delete('public/image/mobil/' . $mobil->image);
            }
            $image = $request->file('image')->hashName();
            $request->file('image')->storeAs('public/image/mobil', $image);
            $updateMobil['image'] = $image;
        }

        $mobil->update($updateMobil);

        return $this->successResponse($mobil, 'Data Mobil diubah.');
    }

    // Function untuk menghapus data mobil
    public function destroy($id)
    {
        $mobil = Mobil::find($id);

        if (!$mobil) {
            return $this->errorResponse(null, 'Data Mobil tidak ditemukan.', 404);
        }

        if (Storage::exists('public/image/mobil/' . $mobil->image)) {
            Storage::delete('public/image/mobil/' . $mobil->image);
        }

        $mobil->delete();

        return $this->successResponse(null, 'Data Mobil dihapus.');
    }
}

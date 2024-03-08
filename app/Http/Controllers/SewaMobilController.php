<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SewaMobilController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data sewa mobil
    public function index(Request $request)
    {
        $mobils = Mobil::query();

        $search = $request->input('search');
        $status = $request->input('status');

        if ($request->filled('search')) {
            $mobils->where(function ($query) use ($search) {
                $query->where('merek', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status') && $status != 'semua') {
            $mobils->where('status', 'like', '%' . $status . '%');
        }

        $mobils = $mobils->paginate(12);

        if ($request->ajax()) {
            return view('pages.sewa_mobil.data', compact('mobils'))->render();
        }

        return view('pages.sewa_mobil.index', compact('mobils'));
    }

    // Function untuk menampilkan data sewa mobil
    public function show($id)
    {
        $mobil = Mobil::with('user')->find($id);

        if (!$mobil) {
            return $this->errorResponse(null, 'Data Mobil tidak ditemukan.', 404);
        }

        return view('pages.sewa_mobil.detail', compact('mobil'))->render();
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    use ApiResponder;

    // Function untuk menampilkan data profil
    public function index(Request $request)
    {
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat' => 'required',
                'nomor_telepon' => 'required|unique:users,nomor_telepon,' . Auth::user()->id,
                'nomor_sim' => 'required|unique:users,nomor_sim,' . Auth::user()->id,
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'image' => 'image|mimes:png,jpg,jpeg',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
            }

            $updateUser = [
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'nomor_sim' => $request->input('nomor_sim'),
                'email' => $request->input('email'),
            ];

            if ($request->hasFile('image')) {
                if (torage::exists('public/image/user/' . $user->image)) {
                    Storage::delete('public/image/user/' . $user->image);
                }
                $image = $request->file('image')->hashName();
                $request->file('image')->storeAs('public/image/user', $image);
                $updateUser['image'] = $image;
            }

            $user->update($updateUser);

            return $this->successResponse($user, 'Data Profil diubah.');
        }

        return view('pages.profil.index');
    }

    // Function untuk mengubah password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = Auth::user();

        if (!$user) {
            return $this->errorResponse(null, 'Data Profil tidak ditemukan.', 404);
        }

        if (!Hash::check($request->input('password_lama'), $user->password)) {
            return $this->errorResponse(null, 'Password lama tidak sesuai.', 422);
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);

        return $this->successResponse($user, 'Data password diubah.');
    }
}

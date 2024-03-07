<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponder;

    // Function untuk melakukan registrasi
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'alamat' => 'required',
                'nomor_telepon' => 'required|unique:users,nomor_telepon',
                'nomor_sim' => 'required|unique:users,nomor_sim',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            $user = User::create([
                'nama' => $request->input('nama'),
                'alamat' => $request->input('alamat'),
                'nomor_telepon' => $request->input('nomor_telepon'),
                'nomor_sim' => $request->input('nomor_sim'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            return $this->successResponse($user, 'Registrasi berhasil.');
        }

        return view('pages.auth.register');
    }

    // Function untuk melakukan login
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
            }

            if (!Auth::attempt($request->only('email', 'password'))) {
                return $this->errorResponse(null, 'Email atau password tidak valid.', 401);
            }

            $user = Auth::user();
            return $this->successResponse($user, 'Login berhasil.');
        }

        return view('pages.auth.login');
    }

    // Function untuk melakukan logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

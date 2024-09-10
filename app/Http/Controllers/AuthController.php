<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Sesuaikan dengan path view login Anda
    }

    public function handleForm(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'login') {
            return $this->login($request);
        } elseif ($action === 'register') {
            return $this->register($request);
        }

        return redirect()->back()->withErrors(['Invalid action']);
    }

    private function login(Request $request)
{
    // Ambil kredensial dari request
    $credentials = $request->only('username', 'password');

    // Cari user berdasarkan username menggunakan model User
    $user = User::where('username', $credentials['username'])->first();

    // Cek apakah user ditemukan dan password cocok
    if ($user && Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        // Login user berdasarkan id_user
        Auth::loginUsingId($user->id_user);

        // Redirect ke halaman yang diinginkan setelah login berhasil
        return redirect()->intended('/');
    }

    // Jika login gagal, kembalikan ke halaman sebelumnya dengan error
    return redirect()->back()->withErrors(['Invalid username or password']);
}

private function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Membuat user baru menggunakan model User
    $user = User::create([
        'username' => $request->input('username'),
        'password' => $request->input('password'), // Password akan otomatis di-hash berdasarkan konfigurasi di model
    ]);

    // Redirect setelah registrasi berhasil
    return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
}

    private function hashPassword($password)
    {
        // Kombinasi md5 dan sha256
        return hash('sha256', md5($password));
    }

    private function checkPassword($inputPassword, $storedPasswordHash)
    {
        // Periksa password yang dimasukkan dengan hash yang disimpan
        return hash('sha256', md5($inputPassword)) === $storedPasswordHash;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $credentials = $request->only('username', 'password');
        $user = DB::table('users')->where('username', $credentials['username'])->first();

        if ($user && $this->checkPassword($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id_user); // Atau rute lainnya
            return redirect()->intended('/');
        }

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

        // Insert pengguna ke database dengan hashing password
        DB::table('users')->insert([
            'username' => $request->input('username'),
            'password' => $this->hashPassword($request->input('password')),
        ]);

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

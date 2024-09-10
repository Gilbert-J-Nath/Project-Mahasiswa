<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $data['title'] = 'Data Mahasiswa';

    // Mengambil semua data mahasiswa menggunakan metode all()
    $data['mahasiswa'] = Mahasiswa::all();

    return view('header') .
           view('dashboard', $data);
}

    public function tambah()
    {
        return
        view('tambah');
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nrp' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
        ]);
    
        // Cek apakah NRP sudah ada di database
        $exists = Mahasiswa::where('nrp', $request->nrp)->exists();
    
        if ($exists) {
            // Jika NRP sudah ada, redirect kembali ke halaman tambah dengan pesan error
            return redirect()->back()->with('error', 'NRP sudah digunakan');
        }
    
        // Insert data menggunakan model Mahasiswa
        Mahasiswa::create([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email' => $request->email,
            'photo' => $request->input('photo', null), // Photo bisa null
        ]);
    
        // Redirect kembali ke halaman utama setelah penyimpanan
        return redirect('/')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function edit($nrp)
    {
        // Ambil data mahasiswa berdasarkan NRP menggunakan model Mahasiswa
        $mahasiswa = Mahasiswa::where('nrp', $nrp)->first();
    
        if (!$mahasiswa) {
            return redirect('/')->with('error', 'Data tidak ditemukan');
        }
    
        // Tampilkan form edit dengan data mahasiswa
        return view('edit', ['mahasiswa' => $mahasiswa]);
    }

    public function update(Request $request, $nrp)
{
    // Validasi data
    $request->validate([
        'nrp' => 'required',
        'nama' => 'required',
        'email' => 'required|email'
    ]);

    // Periksa apakah NRP yang baru sudah ada (kecuali yang sedang diedit)
    $exists = Mahasiswa::where('nrp', $request->nrp)
        ->where('nrp', '<>', $nrp)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'NRP sudah digunakan');
    }

    // Ambil data mahasiswa yang ingin diupdate
    $mahasiswa = Mahasiswa::where('nrp', $nrp)->first();

    if (!$mahasiswa) {
        return redirect('/')->with('error', 'Data mahasiswa tidak ditemukan');
    }

    // Update data mahasiswa
    $mahasiswa->update([
        'nrp' => $request->nrp,
        'nama' => $request->nama,
        'email' => $request->email,
        'photo' => $request->input('photo', $mahasiswa->photo), // photo tetap sama jika tidak diubah
    ]);

    // Redirect setelah update
    return redirect('/')->with('success', 'Data Mahasiswa Berhasil Diperbarui');
}

public function destroy($nrp)
{
    // Temukan data mahasiswa berdasarkan NRP
    $mahasiswa = Mahasiswa::find($nrp);

    if (!$mahasiswa) {
        // Jika data mahasiswa tidak ditemukan, redirect dengan pesan error
        return redirect('/')->with('error', 'Data mahasiswa tidak ditemukan');
    }

    // Hapus data mahasiswa
    $mahasiswa->delete();

    // Redirect kembali ke halaman utama setelah penghapusan
    return redirect('/')->with('success', 'Data Mahasiswa Berhasil Dihapus');
}

}
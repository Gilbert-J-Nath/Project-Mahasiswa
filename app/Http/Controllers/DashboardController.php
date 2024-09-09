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

        $mahasiswa = new Mahasiswa();
        $data['mahasiswa'] = $mahasiswa->get_all_mahasiswa();

        return
        view('header') .
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
        'email' => 'required|email'
    ]);

    $exists = DB::table('mahasiswa')->where('nrp', $request->nrp)->exists();

    if ($exists) {
        // Jika NRP sudah ada, redirect kembali ke halaman tambah dengan pesan error
        return redirect()->back()->with('error', 'NRP sudah digunakan');
    }

    // Insert data ke tabel mahasiswa
    DB::table('mahasiswa')->insert([
        'nrp' => $request->nrp,
        'nama' => $request->nama,
        'email' => $request->email
    ]);

    // Redirect kembali ke halaman utama setelah penyimpanan
    return redirect('/')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
}

public function edit($nrp)
{
    // Ambil data mahasiswa berdasarkan ID
    $mahasiswa = DB::table('mahasiswa')->where('nrp', $nrp)->first();

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

    // Periksa apakah NRP yang baru sudah ada (kecuali untuk NRP yang sama dengan data lama)
    $exists = DB::table('mahasiswa')->where('nrp', $request->nrp)
        ->where('nrp', '<>', $nrp) // Pastikan ID tidak sama
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'NRP sudah digunakan');
    }

    // Update data mahasiswa
    DB::table('mahasiswa')
        ->where('nrp', $nrp)
        ->update([
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email' => $request->email
        ]);

    // Redirect setelah update
    return redirect('/')->with('success', 'Data Mahasiswa Berhasil Diperbarui');
}

public function destroy($nrp)
{
    // Hapus data mahasiswa berdasarkan NRP
    DB::table('mahasiswa')->where('nrp', $nrp)->delete();

    // Redirect kembali ke halaman utama setelah penghapusan
    return redirect('/')->with('success', 'Data Mahasiswa Berhasil Dihapus');
}

}
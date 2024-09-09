@extends('template.header')

@section('title', 'Edit Data')

@section('content')
    <form action="{{ url('update/' . $mahasiswa->nrp) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menandakan bahwa ini adalah update request -->
        <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="text" class="form-control" id="nrp" name="nrp" value="{{ old('nrp', $mahasiswa->nrp) }}" placeholder="Masukkan NRP" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}" placeholder="Masukkan Email" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

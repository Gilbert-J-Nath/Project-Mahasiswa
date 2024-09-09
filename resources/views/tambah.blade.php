@extends('template.header')

@section('title', 'Tambah Data')

@section('content')
    <form action="{{ url('tambah') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="text" class="form-control" id="nrp" name="nrp" placeholder="Masukkan NRP" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
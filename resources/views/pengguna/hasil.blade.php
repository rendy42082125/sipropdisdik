@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Data Pengguna</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="telepon">No Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ Auth::user()->telepon }}" readonly>
            </div>

            <div class="form-group">
                <label for="kantor">Kantor</label>
                <input type="text" class="form-control" id="kantor" name="kantor" value="{{ $kantor ? $kantor->nama_kantor : 'Belum diatur' }}" readonly>
            </div>

            <div class="form-group">
                <label for="sekolah">Sekolah</label>
                <input type="text" class="form-control" id="sekolah" name="sekolah" value="{{ $sekolah ? $sekolah->nama_sekolah : 'Belum diatur' }}" readonly>
            </div>

            <div class="form-group">
                <label for="foto_profile">Foto Profil</label>
                <img id="preview-foto" src="{{ asset('storage/images/profile/' . Auth::user()->foto_profile) }}" alt="Foto Profil" class="img-thumbnail mt-2 preview-foto">
            </div>           

            <div class="form-group">
                <a href="/pengguna_awal" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>

<style>
    .preview-foto {
        width: 150px;  /* 4cm */
        height: 225px; /* 6cm */
        object-fit: cover;
    }
</style>
@endsection




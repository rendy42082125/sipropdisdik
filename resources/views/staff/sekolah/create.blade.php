@extends('layout')

@section('title', 'Tambah Sekolah')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Tambah Sekolah</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Sekolah</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('staff.sekolah.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="form-group">
                <label for="jenis_id">Jenis Sekolah</label>
                <select class="form-control" id="jenis_id" name="jenis_id" required>
                    <option value="">Pilih Jenis Sekolah</option>
                    @foreach($jenis as $j)
                        <option value="{{ $j->id }}">{{ $j->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ssimpan</button>
            <a href="{{ route('staff.sekolah.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

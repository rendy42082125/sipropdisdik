@extends('layout')

@section('title', 'Tambah Kantor')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Tambah Kantor</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Kantor</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kantor.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kantor">Nama Kantor</label>
                <input type="text" class="form-control" id="nama_kantor" name="nama_kantor">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota">
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

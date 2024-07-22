@extends('layout')

@section('title', 'Edit Kantor')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Kantor</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Kantor</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kantor.update', $kantor->id_kantor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_kantor">Nama Kantor</label>
                <input type="text" class="form-control" id="nama_kantor" name="nama_kantor" value="{{ $kantor->nama_kantor }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $kantor->alamat }}">
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{ $kantor->kota }}">
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $kantor->telepon }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

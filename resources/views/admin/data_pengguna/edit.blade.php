@extends('layout')

@section('title', 'Ubah Role Pengguna')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Data Pengguna</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.data_pengguna.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                </div>


                <div class="form-group">
                    <label for="telepon">No Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $user->telepon }}" readonly>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="pengguna_awal" {{ $user->role == 'pengguna_awal' ? 'selected' : '' }}>Pengguna</option>
                        <option value="operator_sekolah" {{ $user->role == 'operator_sekolah' ? 'selected' : '' }}>Operator Sekolah</option>
                        <option value="staff_kantor" {{ $user->role == 'staff_kantor' ? 'selected' : '' }}>Staff Kantor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto_profile">Foto Profile :</label>
                    <img id="preview-foto" src="{{ asset('storage/images/profile/' . $user->foto_profile) }}" alt="Foto Profile" class="img-thumbnail mt-2 preview-foto">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/admin/data_pengguna" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
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


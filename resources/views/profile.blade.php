@extends('layout')

@section('title', 'Profile Pengguna')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Data Pengguna</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form>
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
                    @php
                        $roleWithSpaces = str_replace('_', ' ', $user->role);
                    @endphp
                    <input type="text" class="form-control" id="role" name="role" value="{{ $roleWithSpaces }}" readonly>
                </div>
                

                <div class="form-group">
                    <label for="foto_profile">Foto Profile :</label>
                    <img id="preview-foto" src="{{ asset('storage/images/profile/' . $user->foto_profile) }}" alt="Foto Profile" class="img-thumbnail mt-2 preview-foto">
                </div>

                <div class="form-group">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="/admin/dashboard" class="btn btn-secondary">Kembali</a>
                        @elseif(auth()->user()->role === 'pengguna_awal')
                            <a href="/pengguna_awal" class="btn btn-secondary">Kembali</a>
                        @elseif(auth()->user()->role === 'staff_kantor')
                            <a href="/staff_kantor" class="btn btn-secondary">Kembali</a>
                        @elseif(auth()->user()->role === 'operator_sekolah')
                            <a href="/staff_kantor" class="btn btn-secondary">Kembali</a>
                        @else
                            <!-- Tautan kembali untuk peran selain admin dan pengguna_awal -->
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        @endif
                    @endauth
                
                    @guest
                        <!-- Tautan kembali untuk pengguna yang tidak login -->
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                    @endguest
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

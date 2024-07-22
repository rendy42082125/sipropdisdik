@extends('layout')

@section('title', 'Menu Kantor')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Kantor</h1>
<p class="mb-4">Ini adalah Menu untuk Menampilkan Kantor untuk Sistem</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kantor</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Kantor</th>
                        <th>Nama Kantor</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kantor as $k)
                    <tr>
                        <td>{{ $k->id_kantor }}</td>
                        <td>{{ $k->nama_kantor }}</td>
                        <td>{{ $k->alamat }}</td>
                        <td>{{ $k->kota }}</td>
                        <td class="text-nowrap">{{ $k->telepon }}</td>
                        <td>
                            <form action="{{ route('kantor.destroy',$k->id_kantor) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('kantor.show',$k->id_kantor) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('kantor.edit',$k->id_kantor) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

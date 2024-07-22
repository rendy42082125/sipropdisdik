@extends('layout')

@section('title', 'Daftar Sekolah')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Sekolah</h1>
<p class="mb-4">Ini adalah menu yang akan menampilkan data dari seluruh sekolah yang ada di Kota Banjarmasin dari PAUD, SD, dan Juga SMP</a>.</p>

<!-- Button to add new school -->
<a class="btn btn-success mb-3" href="{{ route('staff.sekolah.create') }}">Tambah Sekolah</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Sekolah</h6>
    </div>
    <div class="card-body">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Sekolah</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th>Jenis Sekolah</th>
                        <th width="140px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sekolah as $s)
                    <tr>
                        <td>{{ $s->nama_sekolah }}</td>
                        <td>{{ $s->alamat }}</td>
                        <td>{{ $s->kota }}</td>
                        <td>{{ $s->telepon }}</td>
                        <td>{{ $s->jenis->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('staff.sekolah.edit', $s->id_sekolah) }}">Edit</a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $s->id_sekolah }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
@foreach ($sekolah as $s)
<div class="modal fade" id="deleteModal{{ $s->id_sekolah }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $s->id_sekolah }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $s->id_sekolah }}">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus sekolah ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="delete-form-{{ $s->id_sekolah }}" action="{{ route('staff.sekolah.destroy', $s->id_sekolah) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush

@push('styles')
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@extends('layout')

@section('title', 'Daftar Proposal Kecamatan Banjarmasin Tengah')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Daftar Proposal Kecamatan Banjarmasin Tengah</h1>
<p class="mb-4">Berikut adalah daftar proposal yang berada di Kecamatan Banjarmasin Tengah.</p>

<!-- Button to add new proposal -->
<a class="btn btn-success mb-3" href="{{ route('admin.proposal.create') }}">Create Proposal</a>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Proposal Kecamatan Banjarmasin Tengah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Nama Sekolah</th>
                        <th>Panjang Lokasi</th>
                        <th>Lebar Lokasi</th>
                        <th>Kecamatan</th>
                        <th>Telepon</th>
                        <th>Nama User</th>
                        <th width="280px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $proposal)
                        <tr>
                            <td>{{ $proposal->title }}</td>
                            <td>{{ $proposal->tanggal }}</td>
                            <td>{{ $proposal->status->name }}</td>
                            <td>{{ $proposal->sekolah->nama_sekolah }}</td>
                            <td>{{ $proposal->panjanglokasi }}</td>
                            <td>{{ $proposal->lebarlokasi }}</td>
                            <td>{{ $proposal->kecamatan->nama }}</td>
                            <td>{{ $proposal->telepon }}</td>
                            <td>{{ $proposal->user->name }}</td>
                            <td>
                                <a href="{{ route('admin.proposal.show', $proposal->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('admin.proposal.edit', $proposal->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.proposal.destroy', $proposal->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this proposal?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
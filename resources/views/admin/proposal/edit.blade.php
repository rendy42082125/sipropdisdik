@extends('layout')

@section('title', 'Edit Proposal')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit Proposal</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Proposal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.proposal.update', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Jenis Proposal</label>
                    <select name="title" class="form-control" id="title" required>
                        <option value="" disabled>Pilih Jenis Proposal</option>
                        <option value="Rehabilitasi Ruang Kelas" @if($proposal->title == 'Rehabilitasi Ruang Kelas') selected @endif>Rehabilitasi Ruang Kelas</option>
                        <option value="Rehabilitasi Ruang Guru" @if($proposal->title == 'Rehabilitasi Ruang Guru') selected @endif>Rehabilitasi Ruang Guru</option>
                        <option value="Rehabilitasi Toilet/WC" @if($proposal->title == 'Rehabilitasi Toilet/WC') selected @endif>Rehabilitasi Toilet/WC</option>
                        <option value="Pembangunan Ruang Kelas" @if($proposal->title == 'Pembangunan Ruang Kelas') selected @endif>Pembangunan Ruang Kelas</option>
                        <option value="Pembangunan Ruang Unit Kesehatan Sekolah (UKS)" @if($proposal->title == 'Pembangunan Ruang Unit Kesehatan Sekolah (UKS)') selected @endif>Pembangunan Ruang Unit Kesehatan Sekolah (UKS)</option>
                        <option value="Pembangunan Perpustakaan" @if($proposal->title == 'Pembangunan Perpustakaan') selected @endif>Pembangunan Perpustakaan</option>
                        <option value="Pembangunan Pagar" @if($proposal->title == 'Pembangunan Pagar') selected @endif>Pembangunan Pagar</option>
                        <option value="Perkerasan Halaman" @if($proposal->title == 'Perkerasan Halaman') selected @endif>Perkerasan Halaman</option>
                        <option value="Pembangunan Toilet/WC" @if($proposal->title == 'Pembangunan Toilet/WC') selected @endif>Pembangunan Toilet/WC</option>
                        <option value="Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus" @if($proposal->title == 'Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus') selected @endif>Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus</option>
                        <option value="Pembangunan Ruang Laboratorium" @if($proposal->title == 'Pembangunan Ruang Laboratorium') selected @endif>Pembangunan Ruang Laboratorium</option>
                        <option value="Pengadaan Notebook/Laptop" @if($proposal->title == 'Pengadaan Notebook/Laptop') selected @endif>Pengadaan Notebook/Laptop</option>
                        <option value="Pengadaan Chromebook" @if($proposal->title == 'Pengadaan Chromebook') selected @endif>Pengadaan Chromebook</option>
                        <option value="Pengadaan PC/Komputer" @if($proposal->title == 'Pengadaan PC/Komputer') selected @endif>Pengadaan PC/Komputer</option>
                        <option value="Pengadaan Meja dan Kursi Siswa" @if($proposal->title == 'Pengadaan Meja dan Kursi Siswa') selected @endif>Pengadaan Meja dan Kursi Siswa</option>
                        <option value="Pengadaan Meja dan Kursi Guru" @if($proposal->title == 'Pengadaan Meja dan Kursi Guru') selected @endif>Pengadaan Meja dan Kursi Guru</option>
                        <option value="Pengadaan Lemari Penyimpanan" @if($proposal->title == 'Pengadaan Lemari Penyimpanan') selected @endif>Pengadaan Lemari Penyimpanan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description">{{ $proposal->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ old('tanggal', $proposal->tanggal) }}" required>
                </div>            

                <div class="form-group">
                    <label for="id_sekolah">Sekolah</label>
                    <select name="id_sekolah" class="form-control" id="id_sekolah" required>
                        <option value="" disabled>Pilih Sekolah</option>
                        @foreach($sekolahList as $sekolah)
                            <option value="{{ $sekolah->id_sekolah }}" @if($proposal->id_sekolah == $sekolah->id_sekolah) selected @endif>{{ $sekolah->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kecamatan_id">Kecamatan</label>
                    <select name="kecamatan_id" class="form-control" id="kecamatan_id" required>
                        <option value="" disabled>Pilih Kecamatan</option>
                        @foreach($kecamatanList as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ $proposal->kecamatan_id == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select name="status_id" class="form-control" id="status_id" required>
                        @foreach($statusList as $status)
                            <option value="{{ $status->id }}" @if($proposal->status_id == $status->id) selected @endif>{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="panjanglokasi">Panjang Lokasi</label>
                    <input type="text" name="panjanglokasi" class="form-control" id="panjanglokasi" value="{{ $proposal->panjanglokasi }}" required>
                </div>

                <div class="form-group">
                    <label for="lebarlokasi">Lebar Lokasi</label>
                    <input type="text" name="lebarlokasi" class="form-control" id="lebarlokasi" value="{{ $proposal->lebarlokasi }}" required>
                </div> 

                <div class="form-group">
                    <label for="comment">Tambahkan Komentar:</label>
                    <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="photos">Photos</label>
                    <input type="file" name="photos[]" class="form-control" id="photos" multiple>
                    <div class="mt-3">
                        <h5>Uploaded Photos</h5>
                        <div class="photos">
                            @foreach($proposal->photos as $photo)
                                <div class="photo-item">
                                    <img src="{{ Storage::url($photo->filename) }}" class="img-thumbnail mt-2 preview-foto" alt="Photo">
                                    <a href="{{ route('admin.proposal.downloadPhoto', $photo->id) }}" class="btn btn-primary mt-2">Download</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="files">Files</label>
                    <input type="file" name="files[]" class="form-control" id="files" multiple>
                    <div class="mt-3">
                        <h5>Uploaded Files</h5>
                        <ul>
                            @foreach($proposal->files as $file)
                                <li>
                                    <a href="{{ route('admin.proposal.downloadFile', $file->id) }}" class="btn btn-primary">{{ $file->filename }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.proposal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <style>
        .preview-foto {
            width: 150px;  /* 4cm */
            height: 225px; /* 6cm */
            object-fit: cover;
        }
        .photos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .photo-item {
            text-align: center;
        }
    </style>
@endsection

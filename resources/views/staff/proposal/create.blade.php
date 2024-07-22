@extends('layout')

@section('title', 'Tambah Proposal')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Tambah Proposal</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Proposal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.proposal.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="title">Jenis Proposal</label>
                    <select name="title" class="form-control" id="title" required>
                        <option value="" disabled selected>Pilih Jenis Proposal</option>
                        <option value="Rehabilitasi Ruang Kelas">Rehabilitasi Ruang Kelas</option>
                        <option value="Rehabilitasi Ruang Guru">Rehabilitasi Ruang Guru</option>
                        <option value="Rehabilitasi Toilet/WC">Rehabilitasi Toilet/WC</option>
                        <option value="Pembangunan Ruang Kelas">Pembangunan Ruang Kelas</option>
                        <option value="Pembangunan Ruang Unit Kesehatan Sekolah (UKS)">Pembangunan Ruang Unit Kesehatan Sekolah (UKS)</option>
                        <option value="Pembangunan Perpustakaan">Pembangunan Perpustakaan</option>
                        <option value="Pembangunan Pagar">Pembangunan Pagar</option>
                        <option value="Perkerasan Halaman">Perkerasan Halaman</option>
                        <option value="Pembangunan Toilet/WC">Pembangunan Toilet/WC</option>
                        <option value="Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus">Pembangunan Ruang Pusat Sumber Anak Berkebutuhan Khusus</option>
                        <option value="Pembangunan Ruang Laboratorium">Pembangunan Ruang Laboratorium</option>
                        <option value="Pengadaan Notebook/Laptop">Pengadaan Notebook/Laptop</option>
                        <option value="Pengadaan Chromebook">Pengadaan Chromebook</option>
                        <option value="Pengadaan PC/Komputer">Pengadaan PC/Komputer</option>
                        <option value="Pengadaan Meja dan Kursi Siswa">Pengadaan Meja dan Kursi Siswa</option>
                        <option value="Pengadaan Meja dan Kursi Guru">Pengadaan Meja dan Kursi Guru</option>
                        <option value="Pengadaan Lemari Penyimpanan">Pengadaan Lemari Penyimpanan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                </div>            

                <div class="form-group">
                    <label for="panjanglokasi">Panjang Lokasi</label>
                    <input type="text" name="panjanglokasi" class="form-control" id="panjanglokasi">
                </div>

                <div class="form-group">
                    <label for="lebarlokasi">Lebar Lokasi</label>
                    <input type="text" name="lebarlokasi" class="form-control" id="lebarlokasi">
                </div>

                <div class="form-group">
                    <label for="id_user">User</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', Auth::user()->telepon) }}" pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>                

                <div class="form-group">
                    <label for="id_sekolah">Sekolah</label>
                    <select name="id_sekolah" class="form-control" id="id_sekolah" required>
                        <option value="" disabled selected>Pilih Sekolah</option>
                        @foreach($sekolahList as $sekolah)
                            <option value="{{ $sekolah->id_sekolah }}">{{ $sekolah->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kecamatan_id">Kecamatan</label>
                    <select name="kecamatan_id" class="form-control" id="kecamatan_id" required>
                        <option value="" disabled selected>Pilih Kecamatan</option>
                        @foreach($kecamatanList as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                        @endforeach
                    </select>
                </div>                            

                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select name="status_id" class="form-control" id="status_id" required>
                        <option value="" disabled selected>Pilih Status</option>
                        @foreach($statusList as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="photos">Photos</label>
                    <input type="file" name="photos[]" class="form-control" id="photos" multiple onchange="previewPhotos(event)">
                    <div id="photo-preview" class="mt-3"></div>
                </div>

                <div class="form-group">
                    <label for="files">Files</label>
                    <input type="file" name="files[]" class="form-control" id="files" multiple>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('staff.proposal.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script>
        function previewPhotos(event) {
            const previewContainer = document.getElementById('photo-preview');
            previewContainer.innerHTML = '';
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function () {
                    const img = document.createElement('img');
                    img.src = reader.result;
                    img.style.width = '150px';
                    img.style.height = 'auto';
                    img.style.marginRight = '10px';
                    img.style.marginBottom = '10px';
                    previewContainer.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

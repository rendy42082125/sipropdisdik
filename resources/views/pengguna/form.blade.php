@extends('layout')

@section('content')
<div class="container">
    <form id="form-pengguna" action="{{ route('pengguna.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
        </div>

        <div class="form-group">
            <label for="telepon">No Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', Auth::user()->telepon) }}" pattern="[0-9]*" inputmode="numeric" {{ Auth::user()->telepon ? 'readonly' : '' }} oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>        

        <!-- Dropdown untuk id_sekolah -->
        <div class="form-group">
            <label for="id_sekolah">Sekolah/Kantor</label>
            <select class="form-control" id="id_sekolah" name="id_sekolah">
                <option value="">Pilih Sekolah</option>
                @foreach($sekolahs as $sekolah)
                    <option value="{{ $sekolah->id_sekolah }}" {{ old('id_sekolah', Auth::user()->id_sekolah) == $sekolah->id_sekolah ? 'selected' : '' }}>
                        {{ $sekolah->nama_sekolah }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk id_kantor (read-only) -->
        <div class="form-group" style="display: none;">
            <label for="id_kantor">Kantor</label>
            <input type="text" class="form-control" id="id_kantor" name="id_kantor" value="{{ Auth::user()->id_kantor }}" style="display: none;">
        </div>        


        <div class="form-group">
            <label for="foto_profile">Foto Profile</label>
            <div id="fotoWrapper">
                <input type="file" class="form-control-file" id="foto_profile" name="foto_profile" onchange="previewFoto(this)">
                <img id="preview-foto" src="{{ asset('storage/images/profile/' . Auth::user()->foto_profile) }}" alt="Foto Profile" class="img-thumbnail mt-2 preview-foto">
            </div>
        </div>

        @if(!Auth::user()->telepon || !Auth::user()->foto_profile)
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/pengguna_awal" class="btn btn-secondary">kembali</a>
        </div>
        @else
            <script>
                window.location.href = "{{ route('pengguna.hasil') }}";
            </script>
        @endif
        
    </form>
</div>

<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const idSekolahSelect = document.getElementById('id_sekolah');
        const idKantorSelect = document.getElementById('id_kantor');

        function updateKantor() {
            const selectedSekolah = idSekolahSelect.value;
            if (selectedSekolah === '1') {
                idKantorSelect.value = '1'; // Kantor 1
            } else {
                idKantorSelect.value = '2'; // Kantor 2
            }
        }

        // Set nilai awal berdasarkan nilai yang ada saat ini
        updateKantor();

        // Perbarui nilai saat dropdown sekolah berubah
        idSekolahSelect.addEventListener('change', updateKantor);
    });
</script>

<style>
    .preview-foto {
        width: 150px;  /* 4cm */
        height: 225px; /* 6cm */
        object-fit: cover;
    }
</style>
@endsection

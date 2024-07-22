@extends('layout')

@section('title', 'Detail Proposal')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detail Proposal</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $proposal->title }}" readonly>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" readonly>{{ $proposal->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" value="{{ $proposal->tanggal }}" readonly>
            </div>

            <div class="form-group">
                <label for="id_sekolah">Sekolah</label>
                <input type="text" class="form-control" id="id_sekolah" name="id_sekolah" value="{{ $proposal->sekolah->nama_sekolah }}" readonly>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $proposal->status->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="panjanglokasi">Panjang Lokasi</label>
                <input type="text" class="form-control" id="panjanglokasi" name="panjanglokasi" value="{{ $proposal->panjanglokasi }}" readonly>
            </div>

            <div class="form-group">
                <label for="lebarlokasi">Lebar Lokasi</label>
                <input type="text" class="form-control" id="lebarlokasi" name="lebarlokasi" value="{{ $proposal->lebarlokasi }}" readonly>
            </div>

            <div class="form-group">
                <label for="photos">Photos</label>
                <div class="photos">
                    @foreach($proposal->photos as $photo)
                        <div class="photo-item">
                            <img src="{{ Storage::url($photo->filename) }}" class="img-thumbnail mt-2 preview-foto" alt="Photo">
                            <a href="{{ route('operator.proposal.downloadPhoto', $photo->id) }}" class="btn btn-primary mt-2">Download</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label for="files">Files</label>
                <div class="files">
                    @foreach($proposal->files as $file)
                        <a href="{{ route('operator.proposal.downloadFile', $file->id) }}" class="btn btn-primary">Download File</a>
                    @endforeach
                </div>
            </div>

            <!-- Komentar -->
            <div class="form-group">
                <label for="comments">Komentar</label>
                <div class="comments">
                    @if($proposal->comments->isEmpty())
                        <p>Belum ada komentar.</p>
                    @else
                        <ul class="list-group">
                            @foreach($proposal->comments as $comment)
                                <li class="list-group-item">
                                    <strong>{{ $comment->user->role }}:</strong>
                                    {{ $comment->content }}
                                    <small class="text-muted">({{ $comment->created_at->format('d M Y') }})</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <a href="{{ route('operator.proposal.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
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

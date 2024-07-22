@extends('layout')

@section('title', 'Halaman Beranda')

@section('content')

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-8 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success text-uppercase mb-2">
                                Daftarkan data anda disini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <h4><a href="/pengguna_awal/form" class="btn btn-primary">Klik Disini</a></h4>
                            @if(Auth::user()->alamat && Auth::user()->telepon && Auth::user()->foto_profile)
                            <p>Terima kasih sudah mendaftarkan diri anda. Admin akan memberitahu jika data anda sudah selesai diperiksa.</p>
                            @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

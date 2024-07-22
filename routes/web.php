<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KantorController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\ProposalKecamatanController;
use App\Http\Controllers\Staff\SekolahController as StaffSekolahController;
use App\Http\Controllers\Staff\PenggunaController as StaffUserController;
use App\Http\Controllers\Staff\ProposalController as StaffProposalController;
use App\Http\Controllers\staff\ProposalKecamatanController as StaffProposalKecamatanController;
use App\Http\Controllers\operator\ProposalController as OperatorProposalController;
use App\Http\Controllers\operator\KecamatanController as OperatorKecamatanController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Untuk menampilkan halaman
Route::get('/home', function(){
    if (Auth::check()) {
        // Jika pengguna sudah login
        if (Auth::user()->role == 'admin') {
            return redirect('/admin');
        } elseif (Auth::user()->role == 'pengguna_awal') {
            return redirect('/pengguna_awal');
        } elseif (Auth::user()->role == 'operator_sekolah') {
            return redirect('/operator_sekolah');
        } elseif (Auth::user()->role == 'staff_kantor') {
            return redirect('/staff_kantor');
        } elseif (Auth::user()->role == 'kadis') {
            return redirect('/kadis');
        }
    }
    // Default redirect jika pengguna belum login atau tidak memiliki peran yang sesuai
    return redirect('/');
});



// Untuk redirect ke Google
Route::middleware(['guest'])->group(function(){
    Route::get('/',[SocialiteController::class, 'index'])->name('login');
    Route::get('login/google/redirect', [SocialiteController::class, 'redirect'])->name('redirect');
    Route::get('login/google/callback', [SocialiteController::class, 'callback'])->name('callback');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin',[SesiController::class, 'admin'])->middleware('userAkses:admin');
    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])->middleware('userAkses:admin');

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::resources([
            'admin/kantor' => KantorController::class,
        ]);
    });

    Route::middleware(['userAkses:admin'])->group(function () {
        // Routes yang hanya bisa diakses oleh admin
        Route::resource('admin/sekolah', SekolahController::class)->names([
            'index' => 'admin.sekolah.index',
            'create' => 'admin.sekolah.create',
            'store' => 'admin.sekolah.store',
            'show' => 'admin.sekolah.show',
            'edit' => 'admin.sekolah.edit',
            'update' => 'admin.sekolah.update',
            'destroy' => 'admin.sekolah.destroy',
        ]);
    });
    
    Route::middleware(['userAkses:staff_kantor'])->group(function () {
        // Routes yang hanya bisa diakses oleh staff kantor
        Route::resource('staff/sekolah', StaffSekolahController::class)->names([
            'index' => 'staff.sekolah.index',
            'create' => 'staff.sekolah.create',
            'store' => 'staff.sekolah.store',
            'show' => 'staff.sekolah.show',
            'edit' => 'staff.sekolah.edit',
            'update' => 'staff.sekolah.update',
            'destroy' => 'staff.sekolah.destroy',
        ]);
    });
    
    


    Route::get('/pengguna_awal',[SesiController::class, 'pengguna'])->middleware('userAkses:pengguna_awal');
    Route::get('/operator_sekolah',[SesiController::class, 'operator'])->middleware('userAkses:operator_sekolah');
    Route::get('/staff_kantor',[SesiController::class, 'staff'])->middleware('userAkses:staff_kantor');
    Route::get('/kadis',[SesiController::class, 'kadisdashboard'])->middleware('kadis');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('logout', [SocialiteController::class, 'logout'])->name('logout');

    Route::middleware(['userAkses:pengguna_awal'])->group(function () {
        Route::get('/pengguna_awal/form', [PenggunaController::class, 'edit'])->name('pengguna.form');
        Route::put('/pengguna_awal/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::get('/pengguna_awal/hasil', [PenggunaController::class, 'hasil'])->name('pengguna.hasil');
    });

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::get('/admin/data_pengguna', [UserController::class, 'index'])->name('admin.data_pengguna.index');
        Route::get('/admin/data_pengguna/{id}/edit', [UserController::class, 'edit'])->name('admin.data_pengguna.edit');
        Route::put('/admin/data_pengguna/{id}', [UserController::class, 'update'])->name('admin.data_pengguna.update');
        Route::delete('/admin/data_pengguna/{id}', [UserController::class, 'destroy'])->name('admin.data_pengguna.destroy');
    });   
    
    Route::middleware(['userAkses:staff_kantor'])->group(function () {
        Route::get('/staff/data_pengguna', [StaffUserController::class, 'index'])->name('staff.data_pengguna.index');
        Route::get('/staff/data_pengguna/{id}/edit', [StaffUserController::class, 'edit'])->name('staff.data_pengguna.edit');
        Route::put('/staff/data_pengguna/{id}', [StaffUserController::class, 'update'])->name('staff.data_pengguna.update');
        Route::delete('/staff/data_pengguna/{id}', [StaffUserController::class, 'destroy'])->name('staff.data_pengguna.destroy');
    }); 

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::post('/admin/proposal', [ProposalController::class, 'store'])->name('admin.proposal.store');
        Route::get('/admin/proposal', [ProposalController::class, 'index'])->name('admin.proposal.index');
        Route::get('/admin/proposal/create', [ProposalController::class, 'create'])->name('admin.proposal.create');
        Route::get('/admin/proposal/{proposal}', [ProposalController::class, 'show'])->name('admin.proposal.show');
        Route::get('/admin/proposal/{proposal}/edit', [ProposalController::class, 'edit'])->name('admin.proposal.edit');
        Route::put('/admin/proposal/{proposal}', [ProposalController::class, 'update'])->name('admin.proposal.update');
        Route::delete('/admin/proposal/{proposal}', [ProposalController::class, 'destroy'])->name('admin.proposal.destroy');
        Route::get('/admin/proposal/download-file/{fileId}', [ProposalController::class, 'downloadFile'])->name('admin.proposal.downloadFile');
        Route::get('/admin/proposal/download-photo/{photoId}', [ProposalController::class, 'downloadPhoto'])->name('admin.proposal.downloadPhoto');
        Route::get('/admin/proposal/{proposal}/send-message', [ProposalController::class, 'sendWhatsAppMessage'])->name('admin.proposal.sendMessage');

        // Rute untuk Proposal Kecamatan
    Route::get('/admin/proposal/kecamatan/1', [ProposalKecamatanController::class, 'kecamatan1'])->name('admin.proposal.kecamatan1');
    Route::get('/admin/proposal/kecamatan/2', [ProposalKecamatanController::class, 'kecamatan2'])->name('admin.proposal.kecamatan2');
    Route::get('/admin/proposal/kecamatan/3', [ProposalKecamatanController::class, 'kecamatan3'])->name('admin.proposal.kecamatan3');
    Route::get('/admin/proposal/kecamatan/4', [ProposalKecamatanController::class, 'kecamatan4'])->name('admin.proposal.kecamatan4');
    Route::get('/admin/proposal/kecamatan/5', [ProposalKecamatanController::class, 'kecamatan5'])->name('admin.proposal.kecamatan5');
    });

    Route::middleware(['userAkses:staff_kantor'])->group(function () {
        Route::post('/staff/proposal', [StaffProposalController::class, 'store'])->name('staff.proposal.store');
        Route::get('/staff/proposal', [StaffProposalController::class, 'index'])->name('staff.proposal.index');
        Route::get('/staff/proposal/create', [StaffProposalController::class, 'create'])->name('staff.proposal.create');
        Route::get('/staff/proposal/{proposal}', [StaffProposalController::class, 'show'])->name('staff.proposal.show');
        Route::get('/staff/proposal/{proposal}/edit', [StaffProposalController::class, 'edit'])->name('staff.proposal.edit');
        Route::put('/staff/proposal/{proposal}', [StaffProposalController::class, 'update'])->name('staff.proposal.update');
        Route::delete('/staff/proposal/{proposal}', [StaffProposalController::class, 'destroy'])->name('staff.proposal.destroy');
        Route::get('/staff/proposal/download-file/{fileId}', [StaffProposalController::class, 'downloadFile'])->name('staff.proposal.downloadFile');
        Route::get('/staff/proposal/download-photo/{photoId}', [StaffProposalController::class, 'downloadPhoto'])->name('staff.proposal.downloadPhoto');
        Route::get('/staff/proposal/{proposal}/send-message', [StaffProposalController::class, 'sendWhatsAppMessage'])->name('staff.proposal.sendMessage');

        // Rute untuk Proposal Kecamatan
    Route::get('/staff/proposal/kecamatan/1', [StaffProposalKecamatanController::class, 'kecamatan1'])->name('staff.proposal.kecamatan1');
    Route::get('/staff/proposal/kecamatan/2', [StaffProposalKecamatanController::class, 'kecamatan2'])->name('staff.proposal.kecamatan2');
    Route::get('/staff/proposal/kecamatan/3', [StaffProposalKecamatanController::class, 'kecamatan3'])->name('staff.proposal.kecamatan3');
    Route::get('/staff/proposal/kecamatan/4', [StaffProposalKecamatanController::class, 'kecamatan4'])->name('staff.proposal.kecamatan4');
    Route::get('/staff/proposal/kecamatan/5', [StaffProposalKecamatanController::class, 'kecamatan5'])->name('staff.proposal.kecamatan5');
    });
    
    
    Route::middleware(['userAkses:operator_sekolah'])->group(function () {
        Route::post('/operator/proposal', [OperatorProposalController::class, 'store'])->name('operator.proposal.store');
        Route::get('/operator/proposal', [OperatorProposalController::class, 'index'])->name('operator.proposal.index');
        Route::get('/operator/proposal/create', [OperatorProposalController::class, 'create'])->name('operator.proposal.create');
        Route::get('/operator/proposal/{proposal}', [OperatorProposalController::class, 'show'])->name('operator.proposal.show');
        Route::get('/operator/proposal/{proposal}/edit', [OperatorProposalController::class, 'edit'])->name('operator.proposal.edit');
        Route::put('/operator/proposal/{proposal}', [OperatorProposalController::class, 'update'])->name('operator.proposal.update');
        Route::delete('/operator/proposal/{proposal}', [OperatorProposalController::class, 'destroy'])->name('operator.proposal.destroy');
        Route::get('/operator/proposal/download-file/{fileId}', [OperatorProposalController::class, 'downloadFile'])->name('operator.proposal.downloadFile');
        Route::get('/operator/proposal/download-photo/{photoId}', [OperatorProposalController::class, 'downloadPhoto'])->name('operator.proposal.downloadPhoto');
        Route::get('/operator/proposal/{proposal}/send-message', [OperatorProposalController::class, 'sendWhatsAppMessage'])->name('operator.proposal.sendMessage');

        // Rute untuk Proposal Kecamatan
    Route::get('/operator/proposal/kecamatan/1', [OperatorKecamatanController::class, 'kecamatan1'])->name('operator.proposal.kecamatan1');
    Route::get('/operator/proposal/kecamatan/2', [OperatorKecamatanController::class, 'kecamatan2'])->name('operator.proposal.kecamatan2');
    Route::get('/operator/proposal/kecamatan/3', [OperatorKecamatanController::class, 'kecamatan3'])->name('operator.proposal.kecamatan3');
    Route::get('/operator/proposal/kecamatan/4', [OperatorKecamatanController::class, 'kecamatan4'])->name('operator.proposal.kecamatan4');
    Route::get('/operator/proposal/kecamatan/5', [OperatorKecamatanController::class, 'kecamatan5'])->name('operator.proposal.kecamatan5');
    });

    
    
});

<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class KecamatanController extends Controller
{
    public function kecamatan1()
    {
        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Filter proposal berdasarkan kecamatan_id dan id_user yang sesuai dengan pengguna yang sedang login
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 1)
                             ->where('id_user', $userId)
                             ->get();
        
        // Kirim data ke view
        return view('operator.proposal.kecamatan1', compact('proposals'));
    }

    public function kecamatan2()
    {
        $userId = Auth::id();
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 2)
                             ->where('id_user', $userId)
                             ->get();
        
        return view('operator.proposal.kecamatan2', compact('proposals'));
    }

    public function kecamatan3()
    {
        $userId = Auth::id();
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 3)
                             ->where('id_user', $userId)
                             ->get();
        
        return view('operator.proposal.kecamatan3', compact('proposals'));
    }

    public function kecamatan4()
    {
        $userId = Auth::id();
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 4)
                             ->where('id_user', $userId)
                             ->get();
        
        return view('operator.proposal.kecamatan4', compact('proposals'));
    }

    public function kecamatan5()
    {
        $userId = Auth::id();
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 5)
                             ->where('id_user', $userId)
                             ->get();
        
        return view('operator.proposal.kecamatan5', compact('proposals'));
    }
}


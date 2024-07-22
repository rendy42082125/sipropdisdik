<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;

class ProposalKecamatanController extends Controller
{
    public function kecamatan1()
    {
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 1)
                             ->get();
        
        return view('staff.proposal.kecamatan1', compact('proposals'));
    }

    public function kecamatan2()
    {
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 2)
                             ->get();
        
        return view('staff.proposal.kecamatan2', compact('proposals'));
    }

    public function kecamatan3()
    {
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 3)
                             ->get();
        
        return view('staff.proposal.kecamatan3', compact('proposals'));
    }

    public function kecamatan4()
    {
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 4)
                             ->get();
        
        return view('staff.proposal.kecamatan4', compact('proposals'));
    }

    public function kecamatan5()
    {
        $proposals = Proposal::with(['status', 'sekolah', 'kecamatan', 'user'])
                             ->where('kecamatan_id', 5)
                             ->get();
        
        return view('staff.proposal.kecamatan5', compact('proposals'));
    }
}

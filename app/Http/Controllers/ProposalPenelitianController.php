<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProposalPenelitian;
use App\Models\User;

class ProposalPenelitianController extends Controller
{
    public function index()
    {
        $proposal_penelitian = ProposalPenelitian::all();
        $table_headers = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Status','Aksi'];
    
        $data = [
            'proposal_penelitian' => $proposal_penelitian,
            'table_headers' => $table_headers
        ];
        return view('penelitian.proposal-penelitian.lihat-proposal-penelitian', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'ketua_peneliti' => 'required|string|max:255',
            'nidn' => 'required|string|max:20',
            'nrk' => 'required|string|max:20',
            'program_studi' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'nama_pendana' => 'nullable|string|max:255',
            'jumlah_dana' => 'required|integer',
            'file' => 'required|file|mimes:pdf|max:51200', 
            'status' => 'required|in:pending,checking,accept,reject',
            'user_id' => 'required|exists:users,id',
        ];

        $request->validate($rules);

        ProposalPenelitian::create($request->all());
    }

    public function showReviewerProposalPenelitian()
    {
        return view('reviewer.proposal-penelitian');
    }
    
    public function showReviewerView()
    {
        $user = auth()->user();

        if($user->role === 'reviewer') {
            $proposals = ProposalPenelitian::whereHas('user', function($query) {
                $query->where('role', 'dosen');
            })->get();
            $table_headers = ['Judul', 'Ketua Peneliti', 'Semester', 'Tahun Akademik','Status','Aksi'];

            $data = [
                'proposals' => $proposals,
                'table_headers' => $table_headers
            ];

            return view('reviewer.proposal-penelitian', $data);
        } else {
            abort(403, 'Unauthorized access');
        }
    }
}
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
        ProposalPenelitian::create($request->all());

        return redirect()->to('/upload-proposal-penelitian');
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
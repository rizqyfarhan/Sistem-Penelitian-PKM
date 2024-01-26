<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProposalPenelitian;
use App\Models\ProposalPKM;

class ReviewerController extends Controller
{
    public function showReviewerPenelitianIndex()
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

    public function showReviewerPKMIndex()
    {
        $user = auth()->user();

        if($user->role === 'reviewer') {
            $proposals = ProposalPKM::whereHas('user', function($query) {
                $query->where('role', 'dosen');
            })->get();
            $table_headers = ['Judul', 'Nama Pelaksana', 'Semester', 'Tahun Akademik','Status','Aksi'];

            $data = [
                'proposals' => $proposals,
                'table_headers' => $table_headers
            ];

            return view('reviewer.proposal-pkm', $data);
        } else {
            abort(403, 'Unauthorized access');
        }
    }

    public function showProposalPenelitian()
    {
        return view('reviewer.proposal-penelitian');
    }

    public function showProposalPKM()
    {
        return view('reviewer.proposal-pkm');
    }
}
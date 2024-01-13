<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'ketua_peneliti' => 'required',
            'nidn' => 'required',
            'nrk' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'sumber_dana' => 'required',
            'jumlah_dana' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $data = [
            'judul' => $request->judul,
            'ketua_peneliti' => $request->ketua_peneliti,
            'nidn' => $request->nidn,
            'nrk' => $request->nrk,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
            'sumber_dana' => $request->sumber_dana,
            'jumlah_dana' => $request->jumlah_dana,
            'file' => $filename,
            'user_id' => Auth::id(),
        ];
        
        ProposalPenelitian::create($data);

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

    public function updateStatus(Request $request, $id) 
    {
        $proposal = ProposalPenelitian::find($id);
        $proposal->status = $request->input('status');
        $proposal->save();

        return redirect()->back();
    }
}
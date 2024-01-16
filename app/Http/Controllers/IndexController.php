<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\ProposalPenelitian;
use App\Models\LaporanKemajuanPenelitian;

class IndexController extends Controller
{
    /******  PENELITIAN  **************/
    public function indexPenelitian() 
    {
        $proposal_penelitian = ProposalPenelitian::all();
        $laporan_kemajuan = LaporanKemajuanPenelitian::with('proposalPenelitian')->get();
        $headers_proposal_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Status','Aksi'];
        $headers_kemajuan_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Aksi'];

        $data_penelitian = [
            'proposal_penelitian' => $proposal_penelitian,
            'laporan_kemajuan' => $laporan_kemajuan,
            'headers_proposal_penelitian' => $headers_proposal_penelitian, 
            'headers_kemajuan_penelitian' => $headers_kemajuan_penelitian,
        ];
        
        return view('penelitian.lihat-penelitian', $data_penelitian);
    }    
    
    public function showPenelitian() 
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'id');
    
        return view('penelitian.penelitian', compact('judulPenelitians'));
    }


    public function proposalPenelitian()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'laporan_kemajuan_id', 'id');
    }

    public function storeProposalPenelitian(Request $request)
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

        $lokasi_upload = 'proposal_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

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

        return redirect()->to('/penelitian');
    }

    public function deleteProposalPenelitian($id)
    {
        $proposal = ProposalPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal not found');
        }

        Storage::delete('proposal_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->back();
    }

    public function downloadProposalPenelitian($filename)
    { 
        $path = 'proposal_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewProposalPenelitian($filename)
    {
        $path = 'proposal_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function editProposalPenelitian($id)
    {
        $proposal = ProposalPenelitian::findOrFail($id);

        return view('penelitian.edit-penelitian', compact('proposal'));
    }

    public function updateProposalPenelitian(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'ketua_peneliti' => 'required',
            'nidn' => 'required',
            'nrk' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'sumber_dana' => 'required',
            'jumlah_dana' => 'required',
        ]);

        $proposal = ProposalPenelitian::findOrFail($id);

        $proposal->update([
            'judul' => $request->input('judul'),
            'ketua_peneliti' => $request->input('ketua_peneliti'),
            'ketua_peneliti' => $request->input('ketua_peneliti'),
            'nidn' => $request->input('nidn'),
            'nrk' => $request->input('nrk'),
            'program_studi' => $request->input('program_studi'),
            'semester' => $request->input('semester'),
            'tahun_akademik' => $request->input('tahun_akademik'),
            'sumber_dana' => $request->input('sumber_dana'),
            'jumlah_dana' => $request->input('jumlah_dana'),
        ]);

        $file = $request->file('file');
        $lokasi_upload = 'proposal_penelitian/';
        
        if ($request->hasFile('file')) {
            $newFileName = $request->file('file')->storeAs($lokasi_upload, $file->hashName());

            $proposal->update([
                'file' => $newFileName,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'Proposal updated successfully');
    }

    public function updateStatus(Request $request, $id) 
    {
        $proposal = ProposalPenelitian::find($id);
        $proposal->status = $request->input('status');
        $proposal->save();

        return redirect()->back();
    }

    // KEMAJUAN PENELITIAN
    public function storeKemajuanPenelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'kemajuan_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'file' => $filename,
            'laporan_kemajuan_id' => Auth::user()->proposal->id,
        ];
        
        LaporanKemajuanPenelitian::create($data);

        return redirect()->to('/penelitian');
    }

    public function downloadKemajuanPenelitian($filename)
    {
        $path = 'kemajuan_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteKemajuanPenelitian($id)
    {
        $proposal = LaporanKemajuanPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Laporan kemajuan not found');
        }

        Storage::delete('kemajuan_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->back();
    }

    public function viewKemajuanPenelitian($filename)
    {
        $path = 'kemajuan_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }

    public function editKemajuanPenelitian($id)
    {
        $laporan_kemajuan = LaporanKemajuanPenelitian::findOrFail($id);

        return view('penelitian.edit-kemajuan', compact('laporan_kemajuan'));
    }

    public function updateKemajuanPenelitian(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        $proposal = LaporanKemajuanPenelitian::findOrFail($id);

        $proposal->update([
            'judul' => $request->input('judul'),
        ]);

        $file = $request->file('file');
        $lokasi_upload = 'proposal_penelitian/';
        
        if ($request->hasFile('file')) {
            $newFileName = $request->file('file')->storeAs($lokasi_upload, $file->hashName());

            $proposal->update([
                'file' => $newFileName,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'Proposal updated successfully');
    }
    /***********************************/

    // REVIEWER
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

    /******  PKM  **************/
    /******  PKM  **************/
}
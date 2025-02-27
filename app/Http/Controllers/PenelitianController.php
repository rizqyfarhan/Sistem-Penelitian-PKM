<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\ProposalPenelitian;
use App\Models\LaporanKemajuanPenelitian;
use App\Models\LaporanAkhirPenelitian;
use App\Models\ArtikelJurnal;
use App\Models\HKIPenelitian;

class PenelitianController extends Controller
{
    /******  PENELITIAN  **************/
    public function indexPenelitian() 
    {
        $user = Auth::user();
        $proposal_penelitian = ProposalPenelitian::all();
        $laporan_kemajuan = LaporanKemajuanPenelitian::with(['proposalPenelitian'])
        ->whereHas('proposalPenelitian', function($query) use ($user) {})->get();
        $laporan_akhir = LaporanAkhirPenelitian::with(['proposalPenelitian'])
        ->whereHas('proposalPenelitian', function ($query) use ($user) {})->get();
        $artikel_jurnal = ArtikelJurnal::with(['user'])
        ->whereHas('user', function ($query) use ($user) {})
        ->get();
        $hki_penelitian = HKIPenelitian::with(['user'])
        ->whereHas('user', function ($query) use ($user) {})
        ->get();
        $headers_proposal_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Status','Aksi'];
        $headers_kemajuan_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik', 'Tanggal Dikirim','Aksi'];
        $headers_akhir_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Aksi'];
        $headers_artikel = ['Judul', 'Tahun', 'Volume', 'Nomor', 'Aksi'];
        $headers_hki = ['Judul','Nama Pemegang', 'Nomor Sertifikat', 'Aksi'];

        $data_penelitian = [
            'proposal_penelitian' => $proposal_penelitian,
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_akhir'=> $laporan_akhir,
            'artikel_jurnal' => $artikel_jurnal,
            'hki_penelitian' => $hki_penelitian,
            'headers_proposal_penelitian' => $headers_proposal_penelitian, 
            'headers_kemajuan_penelitian' => $headers_kemajuan_penelitian,
            'headers_akhir_penelitian' => $headers_akhir_penelitian,
            'headers_artikel' => $headers_artikel,
            'headers_hki' => $headers_hki,
        ];
        
        return view('penelitian.index-penelitian', $data_penelitian);
    }    
    
    public function showPenelitian() 
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');
    
        return view('penelitian.penelitian', compact('judulPenelitians'));
    }

    public function showEditPenelitian()
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');
    
        return view('penelitian.edit-penelitian', compact('judulPenelitians'));
    }

    public function storeProposalPenelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'ketua_peneliti' => 'required',
            'nidn' => 'string|max:10',
            'nrk' => 'required|string|max:10',
            'program_studi' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'sumber_dana' => 'required',
            'nama_pendana' => 'nullable',
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
            'nama_pendana' => $request->nama_pendana ?? null,
            'jumlah_dana' => $request->jumlah_dana,
            'file' => $filename,
            'user_nrk' => Auth::user()->role === 'admin'
                ? $request->input('nrk')
                : Auth::user()->nrk,
        ];
        
        ProposalPenelitian::create($data);

        return redirect()->route('show.penelitian')->with('success', 'Proposal Penelitian berhasil disimpan');
    }

    public function deleteProposalPenelitian($id)
    {
        $proposal = ProposalPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan');
        }

        Storage::delete('proposal_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('show.penelitian')->with('success', 'Proposal Penelitian berhasil dihapus');
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
            'judul' => 'required|string|max:255',
            'ketua_peneliti' => 'required|string|max:255',
            'nidn' => 'required|string|max:10',
            'nrk' => 'required|string|max:10',
            'program_studi' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'tahun_akademik' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'nama_pendana' => 'nullable|string|max:255',
            'jumlah_dana' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:20480',
        ]);

        $proposal = ProposalPenelitian::findOrFail($id);

        $proposal->update([
            'judul' => $request->input('judul'),
            'ketua_peneliti' => $request->input('ketua_peneliti'),
            'nidn' => $request->input('nidn'),
            'nrk' => $request->input('nrk'),
            'program_studi' => $request->input('program_studi'),
            'semester' => $request->input('semester'),
            'tahun_akademik' => $request->input('tahun_akademik'),
            'sumber_dana' => $request->input('sumber_dana'),
            'nama_pendana' => $request->input('nama_pendana'),
            'jumlah_dana' => $request->input('jumlah_dana'),
            
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'proposal_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        }  
        
        return redirect()->route('show.penelitian')->with('success', 'Proposal Penelitian berhasil diubah');
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

        $proposalNrk = $request->input('judul');
        $proposal = ProposalPenelitian::where('nrk', $proposalNrk)->first();

        if ($proposal) { 

            $data = [ 
                'judul' => $proposal->judul, 
                'file' => $filename, 
                'laporan_kemajuan_nrk' => $proposal->nrk, 
            ]; 
            
            LaporanKemajuanPenelitian::create($data); 
            
            return redirect()->to('/penelitian')->with('success', 'Laporan Kemajuan Penelitian sukses disimpan.'); 
        } else { 
            return redirect()->back()->with('error', 'Proposal tidak ditemukan.');
        }
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
            return redirect()->back()->with('error', 'Laporan kemajuan Penelitian tidak ditemukan');
        }

        Storage::delete('kemajuan_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('show.penelitian')->with('success', 'Laporan Kemajuan Penelitian berhasil dihapus');
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

    public function editKemajuanPenelitian($nrk)
    {
        $laporan_kemajuan = LaporanKemajuanPenelitian::where('laporan_kemajuan_nrk', $nrk)->first();

        if (!$laporan_kemajuan) {
            return redirect()->back()->with('error', 'Laporan Kemajuan Penelitian tidak ditemukan.');
        }

        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');

        $data_penelitian = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'judulPenelitians' => $judulPenelitians,
        ];

        return view('penelitian.edit-kemajuan', $data_penelitian);
    }

    public function updateKemajuanPenelitian(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        $proposal = LaporanKemajuanPenelitian::find($id);

        $proposal->update([
            'judul' => $request->input('judul'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'proposal_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'Laporan Kemajuan Penelitian berhasil diubah');
    }

    // AKHIR PENELITIAN

    public function storeAkhirPenelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'akhir_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $proposalNrk = $request->input('judul');
        $proposal = ProposalPenelitian::find($proposalNrk);

        if ($proposal) {
            $data = [
                'judul' => $proposal->judul,
                'file' => $filename,
                'laporan_akhir_nrk' => $proposalNrk,
            ];
            
            LaporanAkhirPenelitian::create($data);
    
            return redirect()->route('show.penelitian')->with('success', 'Laporan Akhir sukses disimpan.');
        } else {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan.');
        }
    }

    public function downloadAkhirPenelitian($filename)
    {
        $path = 'akhir_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteAkhirPenelitian($id)
    {
        $proposal = LaporanAkhirPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Laporan kemajuan not found');
        }

        Storage::delete('akhir_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('show.penelitian')->with('success', 'Laporan Akhir Penelitian berhasil dihapus');
    }

    public function viewAkhirPenelitian($filename)
    {
        $path = 'akhir_penelitian/' . $filename;

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

    public function editAKhirPenelitian($id)
    {
        $akhir_kemajuan = LaporanAkhirPenelitian::find($id);
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'id');

        $data_penelitian = [
            'laporan_akhir' => $akhir_kemajuan,
            'judulPenelitians' => $judulPenelitians,
        ];

        return view('penelitian.edit-akhir', $data_penelitian);
    }

    public function updateAkhirPenelitian(Request $request, $id)
    {   
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        $proposal = LaporanAkhirPenelitian::find($id);

        $proposal->update([
            'judul' => $request->input('judul'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'akhir_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'Laporan Akhir Penelitian berhasil diubah');
    }

    // ARTIKEL JURNAL
    
    public function storeArtikelJurnal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penerbit' => 'required',
            'tahun' => 'required',
            'volume' => 'required',
            'nomor' => 'required',
            'halaman' => 'required',
            'url' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'artikel_jurnal/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'volume' => $request->volume,
            'nomor' => $request->nomor,
            'halaman' => $request->halaman,
            'url' => $request->url,
            'file' => $filename,
            'artikel_jurnal_nrk' => Auth::user()->nrk,
        ];
        
        ArtikelJurnal::create($data);

        return redirect()->route('show.penelitian')->with('success', 'Artikel Jurnal berhasil disimpan');
    }
    
    public function downloadArtikelJurnal($filename)
    {
        $path = 'artikel_jurnal/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewArtikelJurnal($filename)
    {
        $path = 'artikel_jurnal/' . $filename;

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

    public function editArtikelJurnal($id)
    {
        $artikel_jurnal = ArtikelJurnal::find($id);

        $data = [
            'artikel_jurnal' => $artikel_jurnal,
        ];

        return view('penelitian.edit-artikel', $data);
    }

    public function updateArtikelJurnal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'volume' => 'required|integer|max:11',
            'nomor' => 'required|integer|max:11',
            'halaman' => 'required|string|max:255',
            'url' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:20480',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $artikel_jurnal = ArtikelJurnal::find($id);
    
        if(!$artikel_jurnal) {
            return redirect()->back()->with('error', 'Artikel Jurnal Tidak Ditemukan');
        }

        $artikel_jurnal->update([
            'judul' => $request->input('judul'),
            'penerbit' => $request->input('penerbit'),
            'tahun' => $request->input('tahun'),
            'volume' => $request->input('volume'),
            'nomor' => $request->input('nomor'),
            'halaman' => $request->input('halaman'),
            'url' => $request->input('url'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'artikel_jurnal/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $artikel_jurnal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'Artikel Jurnal berhasil diubah');
    }

    public function deleteArtikelJurnal($id)
    {
        $artikel_jurnal = ArtikelJurnal::find($id);

        if (!$artikel_jurnal) {
            return redirect()->back()->with('error', 'Artikel jurnal not found');
        }

        Storage::delete('artikel_jurnal/' . $artikel_jurnal->file);

        $artikel_jurnal->delete();

        return redirect()->route('show.penelitian')->with('success', 'Artikel Jurnal berhasil dihapus');
    }

    // HKI PENELITIAN

    public function storeHKIPenelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'nama_pemegang' => 'required',
            'nomor_sertifikat' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'hki_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'nama_pemegang' => $request->nama_pemegang,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'file' => $filename,
            'hki_penelitian_nrk' => Auth::user()->nrk,
        ];
        
        HKIPenelitian::create($data);

        return redirect()->route('show.penelitian')->with('success', 'HKI Penelitian berhasil disimpan');
    }

    public function downloadHKIPenelitian($filename)
    {
        $path = 'hki_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteHKIPenelitian($id)
    {
        $hki = HKIPenelitian::find($id);

        if (!$hki) {
            return redirect()->back()->with('error', 'HKI penelitian not found');
        }

        Storage::delete('hki_penelitian/' . $hki->file);

        $hki->delete();

        return redirect()->route('show.penelitian')->with('success', 'HKI Penelitian berhasil dihapus');
    }

    public function viewHKIPenelitian($filename)
    {
        $path = 'hki_penelitian/' . $filename;

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

    public function editHKIPenelitian($id)
    {
        $hki = HKIPenelitian::find($id);

        $data_penelitian = [
            'hki_penelitian' => $hki,
        ];

        return view('penelitian.edit-hki', $data_penelitian);
    }

    public function updateHKIPenelitian(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'nama_pemegang' => 'required',
            'nomor_sertifikat' => 'required',
        ]);

        $proposal = HKIPenelitian::findOrFail($id);

        $proposal->update([
            'judul' => $request->input('judul'),
            'nama_pemegang' => $request->input('nama_pemegang'),
            'nomor_sertifikat' => $request->input('nomor_sertifikat'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'hki_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('show.penelitian')->with('success', 'HKI Penelitian berhasil diubah');
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
}
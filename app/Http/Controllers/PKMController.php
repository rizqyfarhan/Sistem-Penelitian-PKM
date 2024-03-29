<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\ProposalPKM;
use App\Models\JurnalPKM;
use App\Models\HKIPKM;
use App\Models\MediaPKM;
use App\Models\LaporanKemajuanPKM;
use App\Models\LaporanAkhirPKM;

class PKMController extends Controller
{
    public function showPKM() 
    {
        $judulPKMs = ProposalPKM::pluck('judul', 'id');
        
        return view('pkm.pkm', compact('judulPKMs'));
    }

    public function indexPKM() 
    {
        $user = Auth::user();

        $proposal_pkm = $user->proposalPKM;
        $laporan_kemajuan = LaporanKemajuanPKM::with('proposalPKM')->whereHas('proposalPKM', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get();
        $laporan_akhir = LaporanAkhirPKM::with('proposalPKM')->whereHas('proposalPKM', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get();
        $jurnal_pkm = $user->jurnalPKM;
        $hki_pkm = $user->hkiPKM;
        $media_massa = $user->media;
        $headers_proposal_pkm = ['Judul','Nama Pelaksana','Semester','Tahun Akademik','Status','Aksi'];
        $headers_kemajuan_pkm = ['Judul','Nama pelaksana','Semester','Tahun Akademik', 'Tanggal Dikirim','Aksi'];
        $headers_akhir_pkm = ['Judul', 'Nama Pelaksana', 'Semster', 'Tahun Akademik', 'Aksi'];
        $headers_jurnal_pkm = ['Judul', 'Penerbit', 'Tahun', 'Volume', 'Nomor', 'Aksi'];
        $headers_hki = ['Judul','Nama Pemegang', 'Nomor Sertifikat', 'Aksi'];
        $headers_media = ['Judul', 'Nama Media Massa', 'Bulan Terbit', 'Tahun Terbit', 'URL', 'Aksi'];

        $data_pkm = [
            'proposal_pkm' => $proposal_pkm,
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_akhir' => $laporan_akhir,
            'jurnal_pkm' => $jurnal_pkm,
            'media_massa' => $media_massa,
            'hki_pkm' => $hki_pkm,
            'headers_proposal_pkm' => $headers_proposal_pkm, 
            'headers_akhir_pkm' => $headers_akhir_pkm,
            'headers_kemajuan_pkm' => $headers_kemajuan_pkm,
            'headers_jurnal_pkm' => $headers_jurnal_pkm,
            'headers_media' => $headers_media,
            'headers_hki' => $headers_hki,
        ];
        
        return view('pkm.index-pkm', $data_pkm);
    }

    // PROPOSAL PKM
    
    public function storeProposalPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'nama_pelaksana' => 'required',
            'nidn' => 'required',
            'nrk' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'nama_mitra' => 'required',
            'alamat_mitra' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'proposal_pkm/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'nama_pelaksana' => $request->nama_pelaksana,
            'nidn' => $request->nidn,
            'nrk' => $request->nrk,
            'program_studi' => $request->program_studi,
            'semester' => $request->semester,
            'tahun_akademik' => $request->tahun_akademik,
            'nama_mitra' => $request->nama_mitra,
            'alamat_mitra' => $request->alamat_mitra,
            'file' => $filename,
            'user_id' => Auth::id(),
        ];
        
        ProposalPKM::create($data);

        return redirect()->to('/pkm');
    }
    
    public function deleteProposalPKM($id)
    {
        $proposal = ProposalPKM::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal not found');
        }

        Storage::delete('proposal_pkm/' . $proposal->file);

        $proposal->delete();

        return redirect()->back();
    }

    public function downloadProposalPKM($filename)
    { 
        $path = 'proposal_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewProposalPKM($filename)
    {
        $path = 'proposal_pkm/' . $filename;

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

    public function editProposalPKM($id)
    {
        $proposal = ProposalPKM::findOrFail($id);

        return view('pkm.edit-pkm', compact('proposal'));
    }

    public function updateProposalPKM(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'nama_pelaksana' => 'required',
            'nidn' => 'required',
            'nrk' => 'required',
            'program_studi' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'nama_mitra' => 'required',
            'alamat_mitra' => 'required',
        ]);

        $proposal = ProposalPKM::findOrFail($id);

        $proposal->update([
            'judul' => $request->input('judul'),
            'nama_pelaksana' => $request->input('nama_pelaksana'),
            'nidn' => $request->input('nidn'),
            'nrk' => $request->input('nrk'),
            'program_studi' => $request->input('program_studi'),
            'semester' => $request->input('semester'),
            'tahun_akademik' => $request->input('tahun_akademik'),
            'nama_mitra' => $request->input('nama_mitra'),
            'alamat_mitra' => $request->input('alamat_mitra'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'proposal_pkm/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        }  
        
        return redirect()->route('show.pkm')->with('success', 'Proposal updated successfully');
    }

    // LAPORAN AKHIR PKM

    public function storeAkhirPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'akhir_pkm/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'file' => $filename,
            'akhir_pkm_id' => Auth::user()->proposalPKM->id,
        ];
        
        LaporanAkhirPKM::create($data);

        return redirect()->to('/pkm');
    }

    public function editAkhirPKM($id)
    {
        $laporan = LaporanAkhirPKM::findOrFail($id);

        return view('pkm.edit-akhir', compact('laporan'));
    }

    public function viewAkhirPKM($filename)
    {
        $path = 'akhir_pkm/' . $filename;

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

    public function downloadAkhirPKM($filename)
    { 
        $path = 'akhir_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteAkhirPKM($id)
    {
        $laporan = LaporanAkhirPKM::find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Report not found');
        }

        Storage::delete('akhir_pkm/' . $laporan->file);

        $laporan->delete();

        return redirect()->back();
    }

    // LAPORAN KEMAJUAN PKM

    public function storeKemajuanPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'kemajuan_pkm/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'file' => $filename,
            'kemajuan_pkm_id' => Auth::user()->proposalPKM->id,
        ];
        
        LaporanKemajuanPKM::create($data);

        return redirect()->to('/pkm');
    }

    public function viewKemajuanPKM($filename)
    {
        $path = 'Kemajuan_pkm/' . $filename;

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

    public function editKemajuanPKM($id)
    {
        $proposal = LaporanKemajuanPKM::findOrFail($id);

        return view('pkm.edit-kemajuan', compact('proposal'));
    }

    public function downloadKemajuanPKM($filename)
    { 
        $path = 'kemajuan_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteKemajuanPKM($id)
    {
        $laporan = LaporanKemajuanPKM::find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Report not found');
        }

        Storage::delete('kemajuan_pkm/' . $laporan->file);

        $laporan->delete();

        return redirect()->back();
    }

    // HKI PKM

    public function storeHKIPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'nama_pemegang' => 'required',
            'nomor_sertifikat' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'hki_pkm/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'nama_pemegang' => $request->nama_pemegang,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'file' => $filename,
            'hki_id' => Auth::id(),
        ];
        
        HKIPKM::create($data);

        return redirect()->to('/pkm');
    }

    public function downloadHKIPKM($filename)
    { 
        $path = 'hki_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewHKIPKM($filename)
    {
        $path = 'hki_pkm/' . $filename;

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

    public function editHKIPKM($id)
    {
        $hki = HKIPKM::findOrFail($id);

        return view('pkm.edit-hki', compact('hki'));
    }

    public function updateHKIPKM(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'nama_pemegang' => 'required',
            'nomor_sertifikat' => 'required',
        ]);

        $hki = HKIPKM::findOrFail($id);

        $hki->update([
            'judul' => $request->input('judul'),
            'nama_pemegang' => $request->input('nama_pemegang'),
            'nomor_sertifikat' => $request->input('nomor_sertifikat'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'hki_pkm/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('index.proposalpkmadmin')->with('success', 'HKI updated successfully');
    }

    public function deleteHKIPKM($id)
    {
        $hki = HKIPKM::find($id);

        if (!$hki) {
            return redirect()->back()->with('error', 'HKI not found');
        }

        Storage::delete('hki_pkm/' . $hki->file);

        $hki->delete();

        return redirect()->back();
    }

    // JURNAL PKM
    
    public function storeJurnalPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
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

        $lokasi_upload = 'jurnal_pkm/';

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
            'jurnalpkm_id' => Auth::id(),
        ];
        
        JurnalPKM::create($data);

        return redirect()->to('/pkm');
    }

    public function deleteJurnalPKM($id)
    {
        $jurnal = JurnalPKM::find($id);

        if (!$jurnal) {
            return redirect()->back()->with('error', 'Jurnal not found');
        }

        Storage::delete('jurnal_pkm/' . $jurnal->file);

        $jurnal->delete();

        return redirect()->back();
    }
    
    // MEDIA MASSA

    public function storeMediaPKM(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'nama_media' => 'required',
            'bulan_terbit' => 'required',
            'tahun_terbit' => 'required',
            'url' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = [
            'judul' => $request->judul,
            'nama_media' => $request->nama_media,
            'bulan_terbit' => $request->bulan_terbit,
            'tahun_terbit' => $request->tahun_terbit,
            'url' => $request->url,
            'media_id' => Auth::id(),
        ];
        
        MediaPKM::create($data);

        return redirect()->to('/pkm');
    }

    public function downloadMediaPKM($filename)
    { 
        $path = 'media_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewMediaPKM($filename)
    {
        $path = 'media_pkm/' . $filename;

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

    public function deleteMediaPKM($id)
    {
        $media = MediaPKM::find($id);

        if (!$media) {
            return redirect()->back()->with('error', 'Media Massa not found');
        }

        Storage::delete('media_pkm/' . $media->file);

        $media->delete();

        return redirect()->back();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProposalPKM;
use App\Models\LaporanKemajuanPKM;
use App\Models\LaporanAkhirPKM;
use App\Models\JurnalPKM;
use App\Models\HKIPKM;
use App\Models\MediaPKM;

class AdminPKMController extends Controller
{
    public function indexProposalPKMAdmin()
    {
        $proposal_pkm = ProposalPKM::all();
        $laporan_kemajuan = LaporanKemajuanPKM::all();
        $laporan_akhir = LaporanAkhirPKM::all();
        $jurnal_pkm = JurnalPKM::all();
        $hki_pkm = HKIPKM::all();
        $media_massa = MediaPKM::all();

        $headers_proposal_pkm = ['Judul','Nama Pelaksana','Semester','Tahun Akademik','Status','Aksi'];
        $headers_kemajuan_pkm = ['Judul','Nama pelaksana','Semester','Tahun Akademik', 'Tanggal Dikirim','Aksi'];
        $headers_akhir_pkm = ['Judul', 'Nama Pelaksana', 'Semster', 'Tahun Akademik', 'Aksi'];
        $headers_jurnal_pkm = ['Judul', 'Penerbit', 'Tahun', 'Volume', 'Nomor', 'Aksi'];
        $headers_hki = ['Judul','Nama Pemegang', 'Nomor Sertifikat', 'Aksi'];
        $headers_media = ['Judul', 'Nama Media Massa', 'Bulan Terbit', 'Tahun Terbit', 'URL', 'Aksi'];

        $data = [
            'headers_proposal_pkm' => $headers_proposal_pkm,
            'headers_kemajuan_pkm' => $headers_kemajuan_pkm,
            'headers_akhir_pkm' => $headers_akhir_pkm,
            'headers_jurnal_pkm' => $headers_jurnal_pkm,
            'headers_hki' => $headers_hki,
            'headers_media' => $headers_media,
            'proposal_pkm' => $proposal_pkm,
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_akhir' => $laporan_akhir,
            'jurnal_pkm' => $jurnal_pkm,
            'hki_pkm' => $hki_pkm,
            'media_massa' => $media_massa,
        ];

        return view('admin.index-pkm', $data);
    }

    public function showProposalPKMAdmin()
    {
        $judulPKMs = ProposalPKM::pluck('judul', 'id');

        return view('admin.pkm-adm', compact('judulPKMs'));
    }

    // PROPOSAL PKM

    public function storeProposalPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }
    
    public function deleteProposalPKMAdmin($id)
    {
        $proposal = ProposalPKM::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal not found');
        }

        Storage::delete('proposal_pkm/' . $proposal->file);

        $proposal->delete();

        return redirect()->back();
    }

    public function downloadProposalPKMAdmin($filename)
    { 
        $path = 'proposal_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewProposalPKMAdmin($filename)
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

    public function editProposalPKMAdmin($id)
    {
        $proposal = ProposalPKM::findOrFail($id);

        return view('admin.edit.edit-pkm', compact('proposal'));
    }

    public function updateProposalPKMAdmin(Request $request, $id)
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
        
        return redirect()->route('index.proposalpkmadmin')->with('success', 'Proposal updated successfully');
    }

    // LAPORAN KEMAJUAN

    public function storeKemajuanPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }

    public function deleteKemajuanPKMAdmin($id)
    {
        $laporan = LaporanKemajuanPKM::find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Report not found');
        }

        Storage::delete('kemajuan_pkm/' . $laporan->file);

        $laporan->delete();

        return redirect()->back();
    }

    public function downloadKemajuanPKMAdmin($filename)
    { 
        $path = 'kemajuan_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewKemajuanPKMAdmin($filename)
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

    public function editKemajuanPKMAdmin($id)
    {
        $proposal = LaporanKemajuanPKM::findOrFail($id);

        return view('admin.edit.edit-kemajuanpkm', compact('proposal'));
    }

    public function updateKemajuanPKMAdmin(Request $request, $id)
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
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'kemajuan_pkm/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('index.proposalpkmadmin')->with('success', 'Proposal updated successfully');
    }

    // LAPORAN AKHIR

    public function storeAkhirPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }

    public function editAkhirPKMAdmin($id)
    {
        $laporan = LaporanAkhirPKM::findOrFail($id);

        return view('admin.edit.edit-akhirpkm', compact('laporan'));
    }

    public function viewAkhirPKMAdmin($filename)
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

    public function downloadAkhirPKMAdmin($filename)
    { 
        $path = 'akhir_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteAkhirPKMAdmin($id)
    {
        $laporan = LaporanAkhirPKM::find($id);

        if (!$laporan) {
            return redirect()->back()->with('error', 'Report not found');
        }

        Storage::delete('akhir_pkm/' . $laporan->file);

        $laporan->delete();

        return redirect()->back();
    }

    // HKI 

    public function storeHKIPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }

    public function downloadHKIPKMAdmin($filename)
    { 
        $path = 'hki_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewHKIPKMAdmin($filename)
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

    public function editHKIPKMAdmin($id)
    {
        $hki = HKIPKM::findOrFail($id);

        return view('admin.edit.edit-hkipkm', compact('hki'));
    }

    public function deleteHKIPKMAdmin($id)
    {
        $hki = HKIPKM::find($id);

        if (!$hki) {
            return redirect()->back()->with('error', 'HKI not found');
        }

        Storage::delete('hki_pkm/' . $hki->file);

        $hki->delete();

        return redirect()->back();
    }
    
    public function updateHKIPKMAdmin(Request $request, $id)
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
    
    // MEDIA MASSA

    public function storeMediaPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }

    public function downloadMediaPKMAdmin($filename)
    { 
        $path = 'media_pkm/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewMediaPKMAdmin($filename)
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

    public function editMediaPKMAdmin($id)
    {
        $hki = MediaPKM::findOrFail($id);

        return view('admin.edit.edit-hkipkm', compact('hki'));
    }

    public function deleteMediaPKMAdmin($id)
    {
        $media = MediaPKM::find($id);

        if (!$media) {
            return redirect()->back()->with('error', 'Media Massa not found');
        }

        Storage::delete('media_pkm/' . $media->file);

        $media->delete();

        return redirect()->back();
    }

    public function updateMediaPKMAdmin(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'nama_media' => 'required',
            'bulan_terbit' => 'required',
            'tahun_terbit' => 'required',
            'url' => 'required',
        ]);

        $hki = MediaPKM::findOrFail($id);

        $hki->update([
            'judul' => $request->input('judul'),
            'nama_media' => $request->input('nama_media'),
            'bulan_terbit' => $request->input('bulan_terbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'url' => $request->input('url'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'media_pkm/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('index.proposalpkmadmin')->with('success', 'HKI updated successfully');
    }

    // JURNAL PKM

    public function storeJurnalPKMAdmin(Request $request)
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

        return redirect()->to('/admin');
    }

    public function deleteJurnalPKMAdmin($id)
    {
        $jurnal = JurnalPKM::find($id);

        if (!$jurnal) {
            return redirect()->back()->with('error', 'Jurnal not found');
        }

        Storage::delete('jurnal_pkm/' . $jurnal->file);

        $jurnal->delete();

        return redirect()->back();
    }
}
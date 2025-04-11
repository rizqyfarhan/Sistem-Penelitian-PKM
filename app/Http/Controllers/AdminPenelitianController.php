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

class AdminPenelitianController extends Controller
{
    public function indexProposalAdmin()
    {
        $proposal_penelitian = ProposalPenelitian::all();
        $laporan_kemajuan = LaporanKemajuanPenelitian::with(['proposalPenelitian'])
        ->whereHas('proposalPenelitian', function($query) {})->get();
        $laporan_akhir = LaporanAkhirPenelitian::all();
        $artikel_jurnal = ArtikelJurnal::all();
        $hki_penelitian = HKIPenelitian::all();

        $headers_proposal = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Status','Aksi'];
        $headers_kemajuan_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik', 'Tanggal Dikirim','Aksi'];
        $headers_akhir_penelitian = ['Judul Penelitian','Ketua Peneliti','Semester','Tahun Akademik','Aksi'];
        $headers_artikel = ['Judul', 'Tahun', 'Volume', 'Nomor', 'Aksi'];
        $headers_hki = ['Judul','Nama Pemegang', 'Nomor Sertifikat', 'Aksi'];

        $data = [
            'headers_proposal' => $headers_proposal,
            'headers_kemajuan_penelitian' => $headers_kemajuan_penelitian,
            'headers_akhir_penelitian' => $headers_akhir_penelitian,
            'headers_artikel' => $headers_artikel,
            'headers_hki' => $headers_hki,
            'proposal_penelitian' => $proposal_penelitian,
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_akhir' => $laporan_akhir,
            'artikel_jurnal' => $artikel_jurnal,
            'hki_penelitian' => $hki_penelitian,
        ];

        return view('admin.index-penelitian', $data);
    }
    
    public function showProposalAdmin()
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');

        return view('admin.penelitian-adm', compact('judulPenelitians'));
    }

    public function showEditPenelitian()
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');
    
        return view('penelitian.edit-penelitian', compact('judulPenelitians'));
    }

    // PROPOSAL PENELITIAN

    public function storeProposalAdmin(Request $request)
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
            'user_nrk' => Auth::user()->nrk,
        ];
        
        ProposalPenelitian::create($data);

        return redirect()->route('index.proposaladmin')->with('success', 'Proposal Penelitian berhasil disimpan');
    }

    public function downloadProposalAdmin($filename)
    { 
        $path = 'proposal_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewProposalAdmin($filename)
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

    public function editProposalAdmin($id)
    {
        $proposal = ProposalPenelitian::findOrFail($id);

        return view('admin.edit-penelitian', compact('proposal'));
    }

    public function updateProposalAdmin(Request $request, $id)
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

        $data = [
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
        ];

        if ($request->input('sumber_dana') === 'pribadi') {
            $data['nama_pendana'] = '';
        } else {
            $data['nama_pendana'] = $request->input('nama_pendana');
        }

        $proposal->update($data);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'proposal_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        }  
        
        return redirect()->route('index.proposaladmin')->with('success', 'Proposal Penelitian berhasil diubah');
    }

    public function deleteProposalAdmin($id)
    {
        $proposal = ProposalPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal not found');
        }

        Storage::delete('proposal_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('index.proposaladmin')->with('success', 'Proposal Penelitian berhasil dihapus');
    }

    // KEMAJUAN PENELITIAN

    public function storeKemajuanAdmin(Request $request)
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

        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Kemajuan Penelitian berhasil disimpan');
    }

    public function downloadKemajuanAdmin($filename)
    {
        $path = 'kemajuan_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteKemajuanAdmin($id)
    {
        $proposal = LaporanKemajuanPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Laporan kemajuan not found');
        }

        Storage::delete('kemajuan_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Kemajuan Penelitian berhasil dihapus');
    }

    public function viewKemajuanAdmin($filename)
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

    public function editKemajuanAdmin($id)
    {
        $laporan_kemajuan = LaporanKemajuanPenelitian::where('laporan_kemajuan_nrk', $id)->first();
        
        if (!$laporan_kemajuan) {
            return redirect()->back()->with('error', 'Laporan Kemajuan Penelitian tidak ditemukan.');
        }
        
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');

        $data_penelitian = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'judulPenelitians' => $judulPenelitians,
        ];

        return view('admin.edit-kemajuan', $data_penelitian);
    }

    public function updateKemajuanAdmin(Request $request, $id)
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

            $lokasi_upload = 'proposal_penelitian/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Kemajuan Penelitian berhasil diubah');
    }

    // AKHIR PENELITIAN
    
    public function storeAkhirAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $lokasi_upload = 'akhir_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'file' => $filename,
            'laporan_akhir_id' => Auth::user()->proposal->id,
        ];
        
        LaporanAkhirPenelitian::create($data);

        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Akhir Penelitian berhasil disimpan');
    }

    public function downloadAkhirAdmin($filename)
    {
        $path = 'akhir_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteAkhirAdmin($id)
    {
        $proposal = LaporanAkhirPenelitian::find($id);

        if (!$proposal) {
            return redirect()->back()->with('error', 'Laporan kemajuan tidak ditemukan');
        }

        Storage::delete('akhir_penelitian/' . $proposal->file);

        $proposal->delete();

        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Akhir Penelitian berhasil dihapus');
    }

    public function viewAkhirAdmin($filename)
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

    public function editAkhirAdmin($id)
    {
        $akhir_kemajuan = LaporanAkhirPenelitian::findOrFail($id);
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'id');

        $data_penelitian = [
            'laporan_kemajuan' => $akhir_kemajuan,
            'judulPenelitians' => $judulPenelitians,
        ];

        return view('admin.edit.edit-kemajuan', $data_penelitian);
    }

    public function updateAkhirAdmin(Request $request, $id)
    {
        
        $request->validate([
            'judul' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        $proposal = LaporanAkhirPenelitian::findOrFail($id);

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
        
        return redirect()->route('index.proposaladmin')->with('success', 'Laporan Akhir Penelitian berhasil diubah');
    }
    
    // ARTIKEL JURNAL

    public function storeArtikelAdmin(Request $request)
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
            'jurnal_id' => Auth::id(),
        ];
        
        ArtikelJurnal::create($data);

        return redirect()->route('index.proposaladmin')->with('success', 'Artikel Jurnal berhasil disimpan');
    }
    
    public function downloadArtikelAdmin($filename)
    {
        $path = 'artikel_jurnal/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function viewArtikelAdmin($filename)
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

    public function editArtikelAdmin($id)
    {
        $artikel_jurnal = ArtikelJurnal::findOrFail($id);

        $data = [
            'artikel_jurnal' => $artikel_jurnal,
        ];

        return view('admin.edit-artikel', $data);
    }

    public function updateArtikelAdmin(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required',
            'volume' => 'required',
            'nomor' => 'required',
            'url' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:20480',
        ]);

        $artikel_jurnal = ArtikelJurnal::findOrFail($id);

        $artikel_jurnal->update([
            'judul' => $request->input('judul'),
            'penerbit' => $request->input('penerbit'),
            'tahun' => $request->input('tahun'),
            'volume' => $request->input('volume'),
            'nomor' => $request->input('nomor'),
            'url' => $request->input('url'),
        ]);

        $file = $request->file('file');
        
        if ($request->hasFile('file')) {
            $filename = $file->getClientOriginalName();

            $lokasi_upload = 'artikel_jurnal/';

            Storage::putFileAs($lokasi_upload, $file, $filename);

            $proposal->update([
                'file' => $filename,
            ]);
        } 
        
        return redirect()->route('index.proposaladmin')->with('success', 'Artikel Jurnal Berhasil diubah');
    }

    public function deleteArtikelAdmin($id)
    {
        $artikel_jurnal = ArtikelJurnal::find($id);

        if (!$artikel_jurnal) {
            return redirect()->back()->with('error', 'Artikel jurnal not found');
        }

        Storage::delete('artikel_jurnal/' . $artikel_jurnal->file);

        $artikel_jurnal->delete();

        return redirect()->route('index.proposaladmin')->with('success', 'Artikel Jurnal berhasil dihapus');
    }

    // HKI PENELITIAN

    public function storeHKIAdmin(Request $request)
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

        $lokasi_upload = 'hki_penelitian/';

        Storage::putFileAs($lokasi_upload, $file, $filename);

        $data = [
            'judul' => $request->judul,
            'nama_pemegang' => $request->nama_pemegang,
            'nomor_sertifikat' => $request->nomor_sertifikat,
            'file' => $filename,
            'hki_id' => Auth::id(),
        ];
        
        HKIPenelitian::create($data);

        return redirect()->route('index.proposaladmin')->with('success', 'HKI Penelitian berhasil disimpan');;
    }

    public function downloadHKIAdmin($filename)
    {
        $path = 'hki_penelitian/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteHKIAdmin($id)
    {
        $hki = HKIPenelitian::find($id);

        if (!$hki) {
            return redirect()->back()->with('error', 'Laporan kemajuan not found');
        }

        Storage::delete('hki_penelitian/' . $hki->file);

        $hki->delete();

        return redirect()->route('index.proposaladmin')->with('success', 'HKI Penelitian berhasil dihapus');
    }

    public function viewHKIAdmin($filename)
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

    public function editHKIAdmin($id)
    {
        $hki = HKIPenelitian::findOrFail($id);

        $data_penelitian = [
            'hki_penelitian' => $hki,
        ];

        return view('admin.edit-hki', $data_penelitian);
    }

    public function updateHKIAdmin(Request $request, $id)
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
        
        return redirect()->route('index.proposaladmin')->with('success', 'HKI Penelitian berhasil diubah');
    }
    /***********************************/
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProposalPenelitian;
use App\Models\ProposalPKM;
use App\Models\Pengumuman;
use App\Models\File;

class DashboardController extends Controller
{
    public function show() 
    {
        $count_penelitian = ProposalPenelitian::count(); 
        $count_pkm = ProposalPKM::count();
        $count_penelitian_accept = ProposalPenelitian::where('status', 'accept')->count();
        $count_pkm_accept = ProposalPKM::where('status', 'accept')->count();
        $total_records = $count_penelitian_accept + $count_pkm_accept;
        $pengumuman = Pengumuman::all();
        $files = File::all();

        $data = [
            'count_penelitian' => $count_penelitian,
            'count_pkm' => $count_pkm,
            'total_records' => $total_records,
            'pengumuman' => $pengumuman,
            'files' => $files,
        ];

        return view('dashboard', $data);
    }

    public function showAdmin()
    {
        return view('admin.upload');
    }

    // PENGUMUMAN

    public function uploadPengumuman(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
        ]);
    
        Pengumuman::create([
            'header' => $request->judul_pengumuman,
            'paragraph' => $request->isi_pengumuman,
        ]);

        return redirect()->route('admin.upload')->with('success', 'Announcement uploaded successfully');
    }

    public function deletePengumuman($id) 
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            return redirect()->back()->with('error', 'Pengumuman not found');
        }

        $pengumuman->delete();

        return redirect()->back();
    }

    // FILE

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:20480', 
        ]);
    
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
    
        $lokasi_upload = 'admin_file/';
    
        Storage::putFileAs($lokasi_upload, $file, $filename);
    
        File::create([
            'path' => $filename, 
        ]);
    
        return redirect()->route('admin.upload')->with('success', 'File uploaded successfully');
    }

    public function downloadFile($filename) 
    {
        $path = 'admin_file/' . $filename;

        if (!Storage::exists($path)) 
        {
            abort(404, 'File not found');
        }

        return Storage::download($path, $filename);
    }

    public function deleteFile($id) 
    {
        $file = File::find($id);

        if (!$file) {
            return redirect()->back()->with('error', 'File not found');
        }

        Storage::delete('admin_file/' . $file->path);

        $file->delete();

        return redirect()->back();
    }

}
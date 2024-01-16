<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProposalPenelitian;
use App\Models\Pengumuman;
use App\Models\File;

class DashboardController extends Controller
{
    public function show() 
    {
        $totalRecords = ProposalPenelitian::count();
        $pengumuman = Pengumuman::all();
        $files = File::all();

        return view('dashboard', compact('totalRecords', 'pengumuman', 'files'));
    }

    public function showAdmin()
    {
        return view('admin.upload');
    }

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
}
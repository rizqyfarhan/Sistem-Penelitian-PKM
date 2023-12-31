<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelJurnalPenelitian;
use Illuminate\Support\Facades\Storage;

class ArtikelJurnalPenelitianController extends Controller
{
    public function index() 
    {
        $artikel_jurnal = ArtikelJurnalPenelitian::all();  
        $table_headers = ['Judul', 'Penerbit', 'Tahun', 'Volume', 'Nomor', 'Jumlah Halaman', 'Aksi']; 

        $data = [
            'artikel_jurnal' => $artikel_jurnal,
            'table_headers' => $table_headers
        ];

        return view('penelitian.artikel-jurnal.lihat-jurnal-penelitian', $data);
    }

    public function store(Request $request)
    {    
        ArtikelJurnalPenelitian::create($request->all());

        return redirect()->to('/upload-jurnal-penelitian');
    }

    public function delete($id) 
    {
        ArtikelJurnalPenelitian::destroy($id);
        
        return redirect()->back();
    }

    public function download($filename)
    {
        return Storage::download("uploads/{$filename}");
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HKIPenelitian;

class HKIPenelitianController extends Controller
{
    public function index() 
    {
        $hki_penelitian = HKIPenelitian::all();  
        $table_headers = ['Judul', 'Nama Pemegang', 'Nomor Sertifikat', 'Aksi']; 

        $data = [
            'hki_penelitian' => $hki_penelitian,
            'table_headers' => $table_headers
        ];

        return view('penelitian.HKI.lihat-HKI-penelitian', $data);
    }

    public function store(Request $request)
    {
        HKIPenelitian::create($request->all());

        return redirect()->to('/upload-HKI-penelitian');
    }

    public function delete($id) 
    {
        HKIPenelitian::destroy($id);
        
        return redirect()->back();
    }
}
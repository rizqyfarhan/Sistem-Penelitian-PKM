<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKemajuanPenelitian;

class LaporanKemajuanPenelitianController extends Controller
{
    public function store(Request $request)
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
        ];

        LaporanKemajuanPenelitian::create($data);

        return redirect()->to('/penelitian');
    }
}
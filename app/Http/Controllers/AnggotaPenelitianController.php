<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaPenelitian;
use App\Models\ProposalPenelitian;

class AnggotaPenelitianController extends Controller
{
    public function showTambahAnggota()
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'id');

        return view('penelitian.tambah-anggota', compact('judulPenelitians'));
    }

    public function indexAnggota()
    {
        $anggota_penelitian = AnggotaPenelitian::all();
        $headers_anggota = ['Nama Anggota', 'NIDN', 'NRK', 'Judul Penelitian', 'Aksi'];
    
        $data = [
            'anggota_penelitian' => $anggota_penelitian,
            'headers_anggota' => $headers_anggota,
        ];

        return view('penelitian.index-anggota', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'nama' => 'required',
            'nidn' => 'required',
            'nrk' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data = [
            'judul' => $request->judul,
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'nrk' => $request->nrk,
            'proposal_id' => Auth::user()->proposal->id,
        ];
    
        AnggotaPenelitian::create($data);
    
        return redirect()->route('penelitian')->with('success', 'Anggota Penelitian created successfully');
    }

    public function deleteAnggota($id)
    {
        $anggota = AnggotaPenelitian::find($id);

        if ($anggota) {
            $anggota->delete();
            
            return redirect()->route('anggota.index')->with('success', 'Anggota deleted successfully');
        } else {
            return redirect()->route('anggota.index')->with('error', 'Anggota not found');
    }
    }
}
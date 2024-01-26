<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPenelitian;

class AnggotaPenelitianController extends Controller
{
    public function showTambahAnggota()
    {
        return view('penelitian.tambah-anggota');
    }
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20',
            'nrk' => 'required|string|max:20',
            'proposal_id' => 'required|exists:proposal_penelitian,id',
        ];
    
        $request->validate($rules);
    
        AnggotaPenelitian::create($request->all());
    
        return redirect()->route('proposal.index')->with('success', 'Anggota Penelitian created successfully');
    }
}
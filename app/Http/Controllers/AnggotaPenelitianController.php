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
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');

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
            'nidn' => 'required|max:10',
            'nrk' => 'required|max:10',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $proposalNrk = $request->input('judul');
        $proposal = ProposalPenelitian::where('nrk', $proposalNrk)->first();

        if ($proposal) {
            $data = [
                'judul' => $proposal->judul,
                'nama' => $request->nama,
                'nidn' => $request->nidn,
                'nrk' => $request->nrk,
                'proposal_nrk' => $proposal->nrk,
            ];

            try {
                AnggotaPenelitian::create($data);
            
                return redirect()->route('penelitian')->with('success', 'Anggota Penelitian berhasil disimpan');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal memasukkan anggota');
            }
        } else {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan');
        }
    }

    public function editAnggota($id) 
    {
        $anggota = AnggotaPenelitian::findOrFail($id);
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'nrk');
        return view('penelitian.edit-anggota', compact('anggota', 'judulPenelitians'));
    }

    public function updateAnggota(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required', 
            'nama' => 'required', 
            'nidn' => 'required|max:10', 
            'nrk' => 'required|max:10',
        ]);

        $anggota = AnggotaPenelitian::findOrFail($id);

        $proposalNrk = $request->input('judul');
        $proposal = ProposalPenelitian::where('nrk', $proposalNrk)->first();

        if ($proposal) {
            $anggota->update([
                'judul' => $proposal->judul,
                'nama' => $request->input('nama'),
                'nidn' => $request->input('nidn'),
                'nrk' => $request->input('nrk'),
                'proposal_id' => $proposal->id,
            ]);

            return redirect()->route('anggota.index')->with('success', 'Anggota Penelitian berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan.');
        }
    }

    public function deleteAnggota($id)
    {
        $anggota = AnggotaPenelitian::find($id);

        if ($anggota) {
            $anggota->delete();
            
            return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus');
        } else {
            return redirect()->route('anggota.index')->with('error', 'Anggota tidak ditemukan');
        }
    }
}
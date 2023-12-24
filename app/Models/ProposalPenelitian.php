<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalPenelitian extends Model
{
    protected $table = 'proposal_penelitian';

    protected $fillable = [
        'judul',
        'ketua_peneliti',
        'nidn',
        'nrk',
        'program_studi',
        'semester',
        'tahun_akademik',
        'sumber_dana',
        'nama_pendana',
        'jumlah_dana',
        'file',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
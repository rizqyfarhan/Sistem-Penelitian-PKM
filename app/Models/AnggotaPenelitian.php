<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPenelitian extends Model
{
    protected $table = 'anggota_penelitian';

    protected $fillable = [
        'judul',
        'nama',
        'nidn',
        'nrk',
        'proposal_id',
    ];

    public function proposal()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'proposal_id');
    }
}
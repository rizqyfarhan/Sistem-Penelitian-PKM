<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPenelitian extends Model
{
    protected $table = 'anggota_penelitian';
    protected $primaryKey = 'nrk';
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'judul',
        'nidn',
        'nrk',
        'proposal_nrk',
    ];

    public function proposal()
    {
        return $this->belongsTo(ProposalPenelitian::class, 'proposal_nrk', 'nrk');
    }
}
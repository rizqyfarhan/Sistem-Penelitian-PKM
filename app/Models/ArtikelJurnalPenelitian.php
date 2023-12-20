<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelJurnalPenelitian extends Model
{
    protected $table = 'artikel_jurnal_penelitian';

    protected $fillable = [
        'judul',
        'penerbit',
        'tahun',
        'volume',
        'nomor',
        'jumlah_halaman',
        'url',
        'file'
    ];
}
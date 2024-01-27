<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelJurnal extends Model
{
    protected $table = 'artikel_jurnal';

    protected $fillable = [
        'judul',
        'penerbit',
        'tahun',
        'volume',
        'nomor',
        'halaman',
        'url',
        'file'
    ];
}
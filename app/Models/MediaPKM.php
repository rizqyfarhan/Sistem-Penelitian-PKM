<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPKM extends Model
{
    protected $table = 'media_pkm';

    protected $fillable = [
        'judul',
        'nama_media',
        'bulan_terbit',
        'tahun_terbit',
        'url',
        'media_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'media_id');
    }
}
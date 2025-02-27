<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $primaryKey = 'nrk';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nrk',
        'nidn',
        'password',
        'role',
    ];

    /**
     * 
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function proposalPenelitian()
    {
        return $this->hasMany(ProposalPenelitian::class, 'user_nrk', 'nrk');
    }

    public function proposalPKM()
    {
        return $this->hasMany(ProposalPKM::class, 'nrk', 'nrk');
    }

    public function hkiPenelitian()
    {
        return $this->hasMany(HKIPenelitian::class, 'hki_penelitian_nrk');
    }

    public function artikelJurnal()
    {
        return $this->hasMany(ArtikelJurnal::class, 'artikel_jurnal_nrk');
    }

    public function jurnalPKM()
    {
        return $this->hasMany(jurnalPKM::class, 'jurnalpkm_id');
    }

    public function hkiPKM()
    {
        return $this->hasMany(HKIPKM::class, 'hkipkm_id');
    }
    public function media()
    {
        return $this->hasMany(MediaPKM::class, 'media_id');
    }
}
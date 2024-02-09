<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function proposal()
    {
        return $this->hasMany(ProposalPenelitian::class);
    }

    public function proposalPKM()
    {
        return $this->hasMany(ProposalPKM::class);
    }

    public function hkiPenelitian()
    {
        return $this->hasMany(HKIPenelitian::class, 'hki_id');
    }

    public function artikelJurnal()
    {
        return $this->hasMany(ArtikelJurnal::class, 'jurnal_id');
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
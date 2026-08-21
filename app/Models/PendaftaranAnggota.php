<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranAnggota extends Model
{
    protected $fillable = [
        'nama_lengkap', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'telepon', 'email', 'pendidikan_terakhir',
        'bidang_keahlian', 'foto', 'ktp', 'status_verifikasi', 'catatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}

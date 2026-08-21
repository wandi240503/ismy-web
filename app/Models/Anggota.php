<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Anggota extends Model
{
    use Searchable;

    protected $fillable = [
        'user_id', 'wilayah_id', 'nomor_anggota', 'nama_lengkap',
        'nik', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon',
        'pendidikan_terakhir', 'bidang_keahlian', 'foto', 'status_keanggotaan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function kegiatan(): BelongsToMany
    {
        return $this->belongsToMany(Kegiatan::class, 'pendaftar_kegiatan')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * Get the indexable data array for the model (Scout).
     * Only expose public-safe fields for search.
     */
    public function toSearchableArray(): array
    {
        return [
            'nama_lengkap' => $this->nama_lengkap,
            'bidang_keahlian' => $this->bidang_keahlian,
            'nomor_anggota' => $this->nomor_anggota,
        ];
    }
}

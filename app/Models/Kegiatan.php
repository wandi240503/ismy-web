<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Kegiatan extends Model
{
    use Searchable;

    protected $fillable = [
        'judul', 'slug', 'deskripsi', 'gambar',
        'tanggal', 'waktu', 'lokasi', 'kuota',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(Anggota::class, 'pendaftar_kegiatan')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function toSearchableArray(): array
    {
        return [
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'lokasi' => $this->lokasi,
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Berita extends Model
{
    use Searchable;

    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'tanggal_terbit',
        'kategori_berita_id', 'penulis', 'view_count',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'judul' => $this->judul,
            'konten' => $this->konten,
            'penulis' => $this->penulis,
        ];
    }
}

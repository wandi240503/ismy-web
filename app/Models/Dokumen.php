<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Dokumen extends Model
{
    use Searchable;

    protected $fillable = ['judul', 'deskripsi', 'file_path', 'kategori'];

    public function toSearchableArray(): array
    {
        return [
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'kategori' => $this->kategori,
        ];
    }
}

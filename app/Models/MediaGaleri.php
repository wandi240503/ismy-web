<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaGaleri extends Model
{
    protected $fillable = ['galeri_id', 'file_path', 'tipe', 'keterangan'];

    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class);
    }
}

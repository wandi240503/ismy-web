<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galeri extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(MediaGaleri::class);
    }
}

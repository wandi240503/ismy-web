<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBerita extends Model
{
    protected $fillable = ['nama', 'slug'];

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class);
    }
}

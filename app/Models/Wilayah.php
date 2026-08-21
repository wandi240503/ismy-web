<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $fillable = ['nama', 'kode', 'deskripsi'];

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mitra extends Model
{
    protected $fillable = ['nama', 'logo', 'deskripsi'];

    public function paketKerjasama(): HasMany
    {
        return $this->hasMany(PaketKerjasama::class);
    }
}

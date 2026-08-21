<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $fillable = ['nama', 'level'];

    public function pengurus(): HasMany
    {
        return $this->hasMany(Pengurus::class);
    }
}

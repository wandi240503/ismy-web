<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketKerjasama extends Model
{
    protected $fillable = ['mitra_id', 'nama', 'deskripsi', 'harga'];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }
}

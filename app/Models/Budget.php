<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'kategori_id',
        'limit_budget',
        'bulan',
        'tahun'
    ];

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
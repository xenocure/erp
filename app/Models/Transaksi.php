<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal',
        'kategori_id',
        'wallet_id',
        'deskripsi',
        'jumlah',
        'tipe'
    ];
}
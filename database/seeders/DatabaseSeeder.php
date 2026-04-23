<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);

        DB::table('wallet')->insert([
            'nama_wallet' => 'Wallet Utama',
            'saldo' => 100000000
        ]);

        DB::table('kategori')->insert([
            ['nama'=>'Gaji','tipe'=>'pemasukan'],
            ['nama'=>'Makan','tipe'=>'pengeluaran']
        ]);
    }
}

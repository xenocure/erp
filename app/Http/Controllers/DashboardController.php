<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // total saldo wallet
        $saldo = Wallet::sum('saldo') ?? 0;

        // pemasukan
        $pemasukan = Transaksi::where('tipe','pemasukan')
            ->sum('jumlah') ?? 0;

        // pengeluaran
        $pengeluaran = Transaksi::where('tipe','pengeluaran')
            ->sum('jumlah') ?? 0;

        // 🔥 TAMBAHAN: Financial Score
        $score = 100;

        if ($pengeluaran > $pemasukan) {
            $score -= 40;
        }

        if ($saldo < 500000) {
            $score -= 20;
        }

        if ($pemasukan > 0 && ($pengeluaran / $pemasukan) > 0.8) {
            $score -= 20;
        }

        if ($score < 0) {
            $score = 0;
        }

        // status
        $status = 'Sehat';
        if ($score < 50) {
            $status = 'Buruk';
        } elseif ($score < 75) {
            $status = 'Cukup';
        }

        return view('dashboard', [
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'score' => $score,       
            'status' => $status      
        ]);
    }
}
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
        $pemasukan = Transaksi::where('tipe', 'pemasukan')
            ->sum('jumlah') ?? 0;

        // pengeluaran
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
            ->sum('jumlah') ?? 0;

        // Financial Score
        $score = 100;
        $expenseRatio = 0;

        if ($pemasukan > 0) {
            $expenseRatio = $pengeluaran / $pemasukan;

            if ($expenseRatio > 1) {
                $score -= 40;
            } else {
                $score -= ($expenseRatio * 30);
            }
        }

        if ($saldo < 500000) {
            $score -= 20;
        } elseif ($saldo < 1000000) {
            $score -= 10;
        }

        $score = max(0, min(100, round($score)));

        // status
        if ($score >= 75) {
            $status = 'Sehat';
        } elseif ($score >= 50) {
            $status = 'Cukup';
        } else {
            $status = 'Buruk';
        }

        return view('dashboard', [
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'score' => $score,
            'status' => $status,
            'expenseRatio' => $expenseRatio
        ]);
    }
}
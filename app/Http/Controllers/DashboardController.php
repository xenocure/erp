<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Wallet;
use App\Models\Transaksi;
use App\Models\Budget;
use App\Models\Kategori;

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

        // cek saldo
        if ($saldo < 500000) {

            $score -= 20;

        } elseif ($saldo < 1000000) {

            $score -= 10;
        }

        // batasi score
        $score = max(0, min(100, round($score)));

        // status financial
        if ($score >= 75) {

            $status = 'Sehat';

        } elseif ($score >= 50) {

            $status = 'Cukup';

        } else {

            $status = 'Buruk';
        }

        // tambahan dashboard
        $totalBudget = Budget::sum('limit_budget');

        $totalTransaksi = Transaksi::count();

        $totalWallet = Wallet::count();

        $totalKategori = Kategori::count();

        return view('dashboard', [

            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,

            'score' => $score,
            'status' => $status,
            'expenseRatio' => $expenseRatio,

            'totalBudget' => $totalBudget,
            'totalTransaksi' => $totalTransaksi,
            'totalWallet' => $totalWallet,
            'totalKategori' => $totalKategori
        ]);
    }

    // Download laporan PDF
    public function downloadPdf()
    {
        $transaksi = Transaksi::all();

        $saldo = Wallet::sum('saldo') ?? 0;

        $pemasukan = Transaksi::where('tipe', 'pemasukan')
            ->sum('jumlah') ?? 0;

        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
            ->sum('jumlah') ?? 0;

        $pdf = Pdf::loadView('laporan.pdf', [
                'transaksi' => $transaksi,
                'saldo' => $saldo,
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran
        ]);

    return $pdf->download('laporan-keuangan.pdf');
    }
}
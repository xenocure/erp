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
        // Total saldo wallet
        $saldo = Wallet::sum('saldo') ?? 0;

        // Total pemasukan
        $pemasukan = Transaksi::where('tipe', 'pemasukan')
            ->sum('jumlah') ?? 0;

        // Total pengeluaran
        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
            ->sum('jumlah') ?? 0;

        // Financial Score
        $score = 100;
        $expenseRatio = 0;

        // 1. Penalti dari Rasio Pengeluaran
        if ($pemasukan > 0) {
            $expenseRatio = $pengeluaran / $pemasukan;

            if ($expenseRatio > 1) {
                $score -= 40;
            } else {
                $score -= ($expenseRatio * 30);
            }
        }

        // 2. Penalti Saldo 
        if ($pemasukan > 0) {
            $saldoRatio = $saldo / $pemasukan;   // Saldo dibanding pemasukan

            if ($saldoRatio < 0.3) {        // Saldo < 30% dari pemasukan
                $score -= 20;
            } elseif ($saldoRatio < 0.6) {  // Saldo < 60% dari pemasukan
                $score -= 10;
            }
        }

        // Batasi skor 0–100
        $score = max(0, min(100, round($score)));

        // Status financial
        if ($score >= 75) {
            $status = 'Sehat';
        } elseif ($score >= 50) {
            $status = 'Cukup';
        } else {
            $status = 'Buruk';
        }

        // Data dashboard lainnya
        $totalBudget = Budget::sum('limit_budget');

        $totalTransaksi = Transaksi::count();

        $totalWallet = Wallet::count();

        $totalKategori = Kategori::count();

        return view('dashboard', [
            'saldo'            => $saldo,
            'pemasukan'        => $pemasukan,
            'pengeluaran'      => $pengeluaran,

            'score'            => $score,
            'status'           => $status,
            'expenseRatio'     => $expenseRatio,

            'totalBudget'      => $totalBudget,
            'totalTransaksi'   => $totalTransaksi,
            'totalWallet'      => $totalWallet,
            'totalKategori'    => $totalKategori
        ]);
    }

    // Download laporan PDF (tidak diubah)
    public function downloadPdf()
    {
        $transaksi = Transaksi::all();

        $saldo = Wallet::sum('saldo') ?? 0;

        $pemasukan = Transaksi::where('tipe', 'pemasukan')
            ->sum('jumlah') ?? 0;

        $pengeluaran = Transaksi::where('tipe', 'pengeluaran')
            ->sum('jumlah') ?? 0;

        $totalBudget = Budget::sum('limit_budget');

        $totalTransaksi = Transaksi::count();

        $totalWallet = Wallet::count();

        $totalKategori = Kategori::count();

        $pdf = Pdf::loadView('laporan.pdf', [
            'transaksi'       => $transaksi,
            'saldo'           => $saldo,
            'pemasukan'       => $pemasukan,
            'pengeluaran'     => $pengeluaran,
            'totalBudget'     => $totalBudget,
            'totalTransaksi'  => $totalTransaksi,
            'totalWallet'     => $totalWallet,
            'totalKategori'   => $totalKategori,
        ]);

        return $pdf->download('laporan-keuangan.pdf');
    }
}
Berikut versi dashboard-mu yang sudah langsung aku ubah pada bagian **Penggunaan Budget** dan **Alert + Tombol**:

```blade
@extends('layouts.app')

@section('content')

<h3>Dashboard</h3>

<div class="row">

    <!-- Total Saldo -->
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Total Saldo</h5>

            <h3>
                Rp {{ number_format($saldo) }}
            </h3>
        </div>
    </div>

    <!-- Pemasukan -->
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Pemasukan Bulan Ini</h5>

            <h3 class="text-success">
                Rp {{ number_format($pemasukan) }}
            </h3>
        </div>
    </div>

    <!-- Pengeluaran -->
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Pengeluaran Bulan Ini</h5>

            <h3 class="text-danger">
                Rp {{ number_format($pengeluaran) }}
            </h3>
        </div>
    </div>

    <!-- Rasio -->
    <div class="col-md-3">
        <div class="card p-3">
            <h5>Rasio Pengeluaran</h5>

            <h3 class="{{ $expenseRatio > 0.8 ? 'text-danger' : 'text-success' }}">
                {{ round($expenseRatio * 100) }}%
            </h3>
        </div>
    </div>

    <!-- Financial Health -->
    <div class="col-md-3 mt-3">
        <div class="card p-3">

            <h5>Financial Health</h5>

            <h3 class="
                @if($score >= 75) text-success
                @elseif($score >= 50) text-warning
                @else text-danger
                @endif
            ">
                {{ $score }} / 100
            </h3>

            <small>
                Status: {{ $status }}
            </small>

            <br>

            <small>
                Skor berdasarkan saldo & rasio pengeluaran
            </small>

            <div class="progress mt-2">
                
                <div class="progress-bar"
                     style="width: {{ $score }}%">
                </div>

            </div>

        </div>
    </div>

    <!-- Total Budget -->
    <div class="col-md-3 mt-3">
        <div class="card p-3">

            <h5>Total Budget</h5>

            <h3 class="text-primary">
                Rp {{ number_format($totalBudget) }}
            </h3>

            <small>
                Total limit budget
            </small>

        </div>
    </div>

    <!-- Penggunaan Budget -->
    <div class="col-md-4 mt-3">
        <div class="card p-3">

            <h5>Penggunaan Budget</h5>

            <small>
                Rp {{ number_format($pengeluaran) }}
                /
                Rp {{ number_format($totalBudget) }}
            </small>

            @php

                $budgetPercent = 0;

                if($totalBudget > 0){
                    $budgetPercent = ($pengeluaran / $totalBudget) * 100;
                }

                $progressWidth = min($budgetPercent, 100);

            @endphp

            <div class="progress mt-2">

                <div class="progress-bar

                    @if($budgetPercent >= 100)
                        bg-danger

                    @elseif($budgetPercent >= 80)
                        bg-warning

                    @else
                        bg-success
                    @endif

                "

                style="width: {{ $progressWidth }}%">
                </div>

            </div>

            <small>
                {{ round($budgetPercent) }}% digunakan
            </small>

        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="col-md-3 mt-3">
        <div class="card p-3">

            <h5>Total Transaksi</h5>

            <h3>
                {{ $totalTransaksi }}
            </h3>

        </div>
    </div>

    <!-- Total Wallet -->
    <div class="col-md-3 mt-3">
        <div class="card p-3">

            <h5>Total Wallet</h5>

            <h3>
                {{ $totalWallet }}
            </h3>

        </div>
    </div>

    <!-- Total Kategori -->
    <div class="col-md-3 mt-3">
        <div class="card p-3">

            <h5>Total Kategori</h5>

            <h3>
                {{ $totalKategori }}
            </h3>

        </div>
    </div>

</div>

<!-- Alert -->
@if($expenseRatio > 1)

<div class="alert alert-danger mt-3">
    <strong>Peringatan!</strong>
    Pengeluaran melebihi pemasukan.
</div>

@endif

@if($saldo < 5000000)

<div class="alert alert-warning mt-3">
    <strong>Peringatan!</strong>
    Saldo berada di bawah batas minimum Rp 5.000.000.
    Sisa saldo: Rp {{ number_format($saldo) }}
</div>

@endif

<!-- Tombol -->
<div class="mt-3">

    <a href="/transaksi/create"
       class="btn btn-success">

        + Tambah Transaksi

    </a>

    <a href="/laporan/pdf"
       class="btn btn-danger ms-2">

        Download Laporan PDF

    </a>

</div>

@endsection




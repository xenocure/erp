@extends('layouts.app')

@section('content')
<h3>Dashboard</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Total Saldo</h5>
            <h3>Rp {{ number_format($saldo) }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Pemasukan Bulan Ini</h5>
            <h3 class="text-success">
                Rp {{ number_format($pemasukan) }}
            </h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Pengeluaran Bulan Ini</h5>
            <h3 class="text-danger">
                Rp {{ number_format($pengeluaran) }}
            </h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3">
            <h5>Rasio Pengeluaran</h5>
            <h3 class="{{ $expenseRatio > 0.8 ? 'text-danger' : 'text-success' }}">
                {{ round($expenseRatio * 100) }}%
            </h3>
        </div>
    </div>

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

            <small>Status: {{ $status }}</small><br>
            <small>Skor berdasarkan saldo & rasio pengeluaran</small>

            <div class="progress mt-2">
                <div class="progress-bar" style="width: {{ $score }}%"></div>
            </div>
        </div>
    </div>

</div>

<a href="/transaksi/create" class="btn btn-success mt-3">
    + Tambah Transaksi
</a>
@endsection
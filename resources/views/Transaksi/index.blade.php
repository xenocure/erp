@extends('layouts.app')

@section('content')

<h3>Data Transaksi</h3>

<a href="/transaksi/create" class="btn btn-primary mb-3">
    + Tambah Transaksi
</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kategori</th>
        <th>Wallet</th>
        <th>Deskripsi</th>
        <th>Tipe</th>
        <th>Jumlah</th>
    </tr>

    @foreach($data as $i => $t)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $t->tanggal }}</td>

        <td>{{ $t->kategori_id }}</td>
        <td>{{ $t->wallet_id }}</td>

        <td>{{ $t->deskripsi }}</td>

        <td>
            @if($t->tipe == 'pemasukan')
                <span class="badge bg-success">Pemasukan</span>
            @else
                <span class="badge bg-danger">Pengeluaran</span>
            @endif
        </td>

        <td>Rp {{ number_format($t->jumlah) }}</td>
    </tr>
    @endforeach

</table>

@endsection
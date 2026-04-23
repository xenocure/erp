@extends('layouts.app')

@section('content')
<h3>Tambah Transaksi</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/transaksi">
@csrf

<div class="mb-2">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
</div>

<div class="mb-2">
    <label>Kategori</label>
    <select name="kategori_id" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
        <option value="{{ $k->id }}" {{ old('kategori_id')==$k->id?'selected':'' }}>
            {{ $k->nama }} ({{ $k->tipe }})
        </option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>Wallet</label>
    <select name="wallet_id" class="form-control">
        <option value="">-- Pilih Wallet --</option>
        @foreach($wallet as $w)
        <option value="{{ $w->id }}" {{ old('wallet_id')==$w->id?'selected':'' }}>
            {{ $w->nama_wallet }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}">
</div>

<div class="mb-2">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}">
</div>

<div class="mb-3">
    <label>Tipe</label>
    <select name="tipe" class="form-control">
        <option value="">-- Pilih Tipe --</option>
        <option value="pemasukan" {{ old('tipe')=='pemasukan'?'selected':'' }}>Pemasukan</option>
        <option value="pengeluaran" {{ old('tipe')=='pengeluaran'?'selected':'' }}>Pengeluaran</option>
    </select>
</div>

<button class="btn btn-success">Simpan</button>
<a href="/transaksi" class="btn btn-secondary">Kembali</a>

</form>
@endsection
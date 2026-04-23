@extends('layouts.app')

@section('content')

<h3>Tambah Wallet</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/wallet">
    @csrf

    <div class="mb-3">
        <label>Nama Wallet</label>
        <input type="text" name="nama_wallet" class="form-control" value="{{ old('nama_wallet') }}">
    </div>

    <div class="mb-3">
        <label>Saldo Awal</label>
        <input type="number" name="saldo" class="form-control" value="{{ old('saldo') }}">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/wallet" class="btn btn-secondary">Kembali</a>
</form>

@endsection
@extends('layouts.app')

@section('content')
<h3>Tambah Kategori</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/kategori">
@csrf

<div class="mb-2">
    <label>Nama Kategori</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
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
<a href="/kategori" class="btn btn-secondary">Kembali</a>

</form>
@endsection
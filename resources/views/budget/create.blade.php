@extends('layouts.app')

@section('content')

<h3>Tambah Budget</h3>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">

        @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach

    </ul>
</div>
@endif

<form method="POST" action="/budget">
@csrf

<div class="mb-3">
    <label>Kategori</label>

    <select name="kategori_id" class="form-control">

        <option value="">
            -- Pilih Kategori --
        </option>

        @foreach ($kategori as $k)

        <option value="{{ $k->id }}">
            {{ $k->nama }}
        </option>

        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>Limit Budget</label>

    <input type="number"
           name="limit_budget"
           class="form-control">
</div>

<div class="mb-3">
    <label>Bulan</label>

    <input type="text"
           name="bulan"
           class="form-control"
           placeholder="Contoh: Mei">
</div>

<div class="mb-3">
    <label>Tahun</label>

    <input type="number"
           name="tahun"
           class="form-control"
           value="{{ date('Y') }}">
</div>

<button class="btn btn-success">
    Simpan
</button>

<a href="/budget" class="btn btn-secondary">
    Kembali
</a>

</form>

@endsection
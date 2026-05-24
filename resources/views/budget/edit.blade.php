@extends('layouts.app')

@section('content')

<h3>Edit Budget</h3>

<form method="POST" action="/budget/{{ $data->id }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Kategori</label>

    <select name="kategori_id" class="form-control">

        @foreach ($kategori as $k)

        <option value="{{ $k->id }}"
            {{ $data->kategori_id == $k->id ? 'selected' : '' }}>

            {{ $k->nama }}

        </option>

        @endforeach

    </select>
</div>

<div class="mb-3">
    <label>Limit Budget</label>

    <input type="number"
           name="limit_budget"
           class="form-control"
           value="{{ $data->limit_budget }}">
</div>

<div class="mb-3">
    <label>Bulan</label>

    <input type="text"
           name="bulan"
           class="form-control"
           value="{{ $data->bulan }}">
</div>

<div class="mb-3">
    <label>Tahun</label>

    <input type="number"
           name="tahun"
           class="form-control"
           value="{{ $data->tahun }}">
</div>

<button class="btn btn-success">
    Update
</button>

<a href="/budget" class="btn btn-secondary">
    Kembali
</a>

</form>

@endsection
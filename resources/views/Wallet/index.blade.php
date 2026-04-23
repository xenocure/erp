@extends('layouts.app')

@section('content')

<h3>Data Wallet</h3>

<a href="/wallet/create" class="btn btn-primary mb-3">
    + Tambah Wallet
</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Wallet</th>
        <th>Saldo</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $i => $w)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $w->nama_wallet }}</td>
        <td>Rp {{ number_format($w->saldo) }}</td>
        <td>
            <form action="/wallet/{{ $w->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection
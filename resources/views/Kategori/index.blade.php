@extends('layouts.app')

@section('content')

<h3>Data Kategori</h3>

<a href="/kategori/create" class="btn btn-primary mb-3">
    + Tambah Kategori
</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tipe</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $i => $k)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $k->nama }}</td>
        <td>
            <span class="badge bg-{{ $k->tipe == 'pemasukan' ? 'success' : 'danger' }}">
                {{ $k->tipe }}
            </span>
        </td>
        <td>
            <form action="/kategori/{{ $k->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection
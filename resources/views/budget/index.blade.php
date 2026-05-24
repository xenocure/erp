@extends('layouts.app')

@section('content')

<h3>Data Budget</h3>

<a href="/budget/create" class="btn btn-primary mb-3">
    + Tambah Budget
</a>

<table class="table table-bordered">

    <tr>
        <th>Kategori</th>
        <th>Limit Budget</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Aksi</th>
    </tr>

    @foreach ($data as $d)

    <tr>

        <td>
            {{ $d->kategori->nama }}
        </td>

        <td>
            Rp {{ number_format($d->limit_budget) }}
        </td>

        <td>
            {{ $d->bulan }}
        </td>

        <td>
            {{ $d->tahun }}
        </td>

        <td>

            <a href="/budget/{{ $d->id }}/edit"
               class="btn btn-warning btn-sm">
               Edit
            </a>

            <form action="/budget/{{ $d->id }}"
                  method="POST"
                  style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">
                    Hapus
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@endsection
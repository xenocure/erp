@extends('layouts.laporan')

@section('content')

<h3>Ringkasan Keuangan</h3>

<table>


<tr>
    <td><b>Total Saldo</b></td>
    <td>Rp {{ number_format($saldo) }}</td>
</tr>

<tr>
    <td><b>Total Pemasukan</b></td>
    <td>Rp {{ number_format($pemasukan) }}</td>
</tr>

<tr>
    <td><b>Total Pengeluaran</b></td>
    <td>Rp {{ number_format($pengeluaran) }}</td>
</tr>

<tr>
    <td><b>Total Budget</b></td>
    <td>Rp {{ number_format($totalBudget) }}</td>
</tr>
```

</table>

<br>

<h3>Statistik Sistem</h3>

<table>

```
<tr>
    <td><b>Total Transaksi</b></td>
    <td>{{ $totalTransaksi }}</td>
</tr>

<tr>
    <td><b>Total Wallet</b></td>
    <td>{{ $totalWallet }}</td>
</tr>

<tr>
    <td><b>Total Kategori</b></td>
    <td>{{ $totalKategori }}</td>
</tr>
```

</table>

<br>

<h3>Detail Transaksi</h3>

<table>

```
<thead>

    <tr>
        <th>No</th>
        <th>Tipe</th>
        <th>Jumlah</th>
    </tr>

</thead>

<tbody>

    @forelse($transaksi as $item)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ ucfirst($item->tipe) }}</td>

        <td>
            Rp {{ number_format($item->jumlah) }}
        </td>

    </tr>

    @empty

    <tr>
        <td colspan="3">
            Tidak ada data transaksi
        </td>
    </tr>

    @endforelse

</tbody>


</table>

@endsection

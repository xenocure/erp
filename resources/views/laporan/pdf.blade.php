<!DOCTYPE html>
<html>
<head>
    <title>Laporan ERP</title>
</head>
<body>

    <h2>Laporan Keuangan ERP</h2>

    <hr>

    <p>Total Saldo : Rp {{ number_format($saldo) }}</p>

    <p>Total Pemasukan : Rp {{ number_format($pemasukan) }}</p>

    <p>Total Pengeluaran : Rp {{ number_format($pengeluaran) }}</p>

    <p>Total Budget : Rp {{ number_format($totalBudget) }}</p>

    <hr>

    <p>Total Transaksi : {{ $totalTransaksi }}</p>

    <p>Total Wallet : {{ $totalWallet }}</p>

    <p>Total Kategori : {{ $totalKategori }}</p>

</body>
</html>
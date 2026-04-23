<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Wallet;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::latest()->get();
        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        return view('transaksi.create', [
            'kategori' => Kategori::all(),
            'wallet' => Wallet::all()
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required',
            'wallet_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tipe' => 'required'
        ]);

        // ambil wallet dulu
        $wallet = Wallet::find($r->wallet_id);

        // 🔥 CEK SALDO (biar gak minus brutal)
        if ($r->tipe == 'pengeluaran' && $wallet->saldo < $r->jumlah) {
            return back()->with('error', 'Saldo tidak cukup');
        }

        // simpan transaksi
        Transaksi::create($r->all());

        // 🔥 update saldo
        if ($r->tipe == 'pemasukan') {
            $wallet->saldo += $r->jumlah;
        } else {
            $wallet->saldo -= $r->jumlah;
        }

        $wallet->save();

        return redirect('/transaksi')->with('success','Transaksi berhasil');
    }
}
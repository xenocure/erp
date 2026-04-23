<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index()
    {
        return view('wallet.index', [
            'data' => Wallet::all()
        ]);
    }

    public function create()
    {
        return view('wallet.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_wallet' => 'required',
            'saldo' => 'required|numeric'
        ]);

        Wallet::create([
            'nama_wallet' => $r->nama_wallet,
            'saldo' => $r->saldo
        ]);

        return redirect('/wallet');
    }

    public function update(Request $r, $id)
    {
        $w = Wallet::find($id);

        $w->update($r->all());

        return back()->with('success','Wallet diupdate');
    }
}
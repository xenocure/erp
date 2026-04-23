<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori.index', [
            'data' => Kategori::all()
        ]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'tipe' => 'required'
        ]);

        Kategori::create([
            'nama' => $r->nama,
            'tipe' => $r->tipe
        ]);

        return redirect('/kategori');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return back()->with('success','Kategori dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Kategori;

class BudgetController extends Controller
{
    public function index()
    {
        $data = Budget::all();

        return view('budget.index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('budget.create', [
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'kategori_id' => 'required',
            'limit_budget' => 'required|numeric',
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        Budget::create([
            'kategori_id' => $r->kategori_id,
            'limit_budget' => $r->limit_budget,
            'bulan' => $r->bulan,
            'tahun' => $r->tahun
        ]);

        return redirect('/budget');
    }

    public function edit($id)
    {
        return view('budget.edit', [
            'data' => Budget::find($id),
            'kategori' => Kategori::all()
        ]);
    }

    public function update(Request $r, $id)
    {
        $budget = Budget::find($id);

        $budget->update([
            'kategori_id' => $r->kategori_id,
            'limit_budget' => $r->limit_budget,
            'bulan' => $r->bulan,
            'tahun' => $r->tahun
        ]);

        return redirect('/budget');
    }

    public function destroy($id)
    {
        Budget::destroy($id);

        return back();
    }
}
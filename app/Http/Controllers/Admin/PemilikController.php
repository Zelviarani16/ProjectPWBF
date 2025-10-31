<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user', 'pets')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        Pemilik::create($request->all());
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update($request->all());
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemilik::destroy($id);
        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus.');
    }
}

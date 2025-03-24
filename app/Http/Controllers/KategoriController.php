<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

class KategoriController extends Controller
{
        public function index(KategoriDataTable $dataTable)
        {
            return $dataTable->render('kategori.index');
        }

        public function create()
        {
            return view('kategori.create');
        }

        public function store(Request $request)
        {
            KategoriModel::create([
                'kategori_kode' => $request->kodeKategori,
                'kategori_nama' => $request->namaKategori,
            ]);
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
        }

        public function edit($id){
            $kategori = KategoriModel::findOrFail($id);
            return view('kategori.edit', compact('kategori'));
        }
    
        public function update(Request $request, $id)
        {
            $kategori = KategoriModel::findOrFail($id);
            $kategori->update([
                'kategori_kode' => $request->kodeKategori,
                'kategori_nama' => $request->namaKategori,
            ]);
    
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diedit');
        }

        public function destroy($id)
        {
            $kategori = KategoriModel::findOrFail($id);
            $kategori->delete();

            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
        }

    
}
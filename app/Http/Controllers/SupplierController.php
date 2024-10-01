<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\View\View;

class SupplierController extends Controller
{
    // Menampilkan semua supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    // Form untuk menambah supplier baru
    public function create()
    {
        return view('supplier.create');
    }

    // Menyimpan supplier baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'pic_supplier' => 'required',
            'no_hp_pic_supplier' => 'required'
        ]);

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil ditambahkan.');
    }

    // Menampilkan form edit supplier
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }

    // Mengupdate data supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'pic_supplier' => 'required',
            'no_hp_pic_supplier' => 'required'
        ]);

        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil diupdate.');
    }

    // Menghapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier berhasil dihapus.');
    }
}

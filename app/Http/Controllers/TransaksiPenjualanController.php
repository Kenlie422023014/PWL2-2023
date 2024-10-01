<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\Product;

class TransaksiPenjualanController extends Controller
{
    // Menampilkan semua transaksi penjualan
    public function index()
    {
        $transaksi = TransaksiPenjualan::with('product')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form untuk menambah transaksi
    public function create()
    {
        $products = Product::all();
        return view('transaksi.create', compact('products'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_products' => 'required',
            'jumlah_pembelian' => 'required|integer',
            'nama_kasir' => 'required',
            'tanggal_transaksi' => 'required'
        ]);

        TransaksiPenjualan::create($request->all());

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = TransaksiPenjualan::find($id);
        $products = Product::all();
        return view('transaksi.edit', compact('transaksi', 'products'));
    }

    // Mengupdate transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_products' => 'required',
            'jumlah_pembelian' => 'required|integer',
            'nama_kasir' => 'required',
            'tanggal_transaksi' => 'required'
        ]);

        $transaksi = TransaksiPenjualan::find($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil diupdate.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaksi = TransaksiPenjualan::find($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')
                         ->with('success', 'Transaksi berhasil dihapus.');
    }
}

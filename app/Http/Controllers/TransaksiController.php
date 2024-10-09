<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index() : View
    {
      
        $transaksi = new Transaksi;
        $transaksis = $transaksi->get_transaksi()
                                ->latest()
                                ->paginate(10);

       
        return view('transaksi.index', compact('transaksis'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapelanggan;

class FrontendPelanggan extends Controller
{
    public function home ()
    {
        $datapelanggans = Datapelanggan::get();
        return view('pelanggan.index', compact('datapelanggans'));
    }
}

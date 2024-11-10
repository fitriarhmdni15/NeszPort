<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $barang = Barang::all();
        return view('templates.index', compact('barang'));
    }
}

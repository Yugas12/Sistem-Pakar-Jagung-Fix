<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::all();
        return view('admin.penyakit', compact('penyakit'));
    }
}

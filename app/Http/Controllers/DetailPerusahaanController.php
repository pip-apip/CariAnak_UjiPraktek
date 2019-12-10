<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;
use Auth;

class DetailPerusahaanController extends Controller
{
    public function index($id)
    {
        $perusahaan = Perusahaan::where('name', $id)->firstOrFail();
        $allperusahaan = Perusahaan::orderBy('id', 'DESC')->paginate(3);
        $side = Perusahaan::orderBy('id', 'ASC')->paginate(3);
        // dd($perusahaan);
        return view('layouts/detailPerusahaan', compact('perusahaan'))->withSide($allperusahaan)->withSidee($side);
    }
}

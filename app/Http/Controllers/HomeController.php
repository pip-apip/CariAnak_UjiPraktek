<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Kandidat;
use App\Artikel;
use App\Category;
use App\Perusahaan;
use App\Lowongan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $l = Lowongan::orderBy('id', 'DESC')->paginate(5);
        return view('home',compact('user',$user), ['home' => 'home'])->withLowongan($l);
    }

    public function dashboard()
    {
        $k = Kandidat::all();
        $p = Perusahaan::all();
        return view('dash/dashboard')->withKandidat($k)->withPerusahaan($p);
    }

    public function dataartikelperusahaan()
    {
        $dashboard = Artikel::where('id_perusahaan', Auth::guard('perusahaan')->user()->id)->orderBy('id', 'DESC')->get();
        return view('dash/dashboardartikel')->withData($dashboard);
    }

    public function dataartikelkandidat()
    {
        $dashboard = Artikel::where('id_kandidat', Auth::guard('kandidat')->user()->id)->orderBy('id', 'DESC')->get();
        return view('dash/dashboardartikel')->withData($dashboard);
    }

    public function datakategori()
    {
        $dashboard = Category::all();
        return view('dash/dashboardkategori')->withData($dashboard);
    }

    public function datalowongan()
    {
        $dashboard = Lowongan::where('perusahaan_id', Auth::guard('perusahaan')->user()->id)->orderBy('id', 'DESC')->get();
        return view('dash/dashboardlowongan')->withData($dashboard);
    }

    // Multiple Data
    public function homeCandidate()
    {
        return view('home', ['url' => 'kandidat'], ['home' => 'home']);
    }

    public function homeCompany()
    {
        return view('home', ['url' => 'perusahaan'], ['home' => 'home']);
    }



}

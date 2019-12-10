<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Sekolah;
use Auth;

use App\Exports\KandidatExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class KandidatController extends Controller
{
    public function all() {
        $data = "Kumpulan Data Kandidat";
        return response()->json($data, 200);
    }

    public function kandidatAuth() {
        $data = "Selamat Datang " . Auth::guard('kandidat')->user()->name;
        return response()->json($data, 200);
    }

    // public function index()
    // {
    //     $sch = App\Sekolah::all();
    //     $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(5);
    //     $sidebar = Kandidat::orderBy('id', 'ASC')->get();
    //     return view('layouts/blog')->withAll($allartikel)->withSide($sidebar)->withSch($sch);
    // }

    public function show(Request $req, $sekolah_id)
    {
        $url = $req->fullURL();
        $skills = $req->input('skills');
        $kota = $req->input('kota');
        $pendidikan = $req->input('pendidikan');
        $perusahaan = Auth::guard('perusahaan')->user();

        $kandidat = Kandidat::orderBy('id')->where('sekolah_id', $sekolah_id)->where('skills', 'LIKE', '%' .$skills.'%', 'AND', 'skills', 'LIKE', '%' .$kota.'%', 'AND', 'skills', 'LIKE', '%' .$pendidikan.'%')->paginate(5);
        // $kandidat = Kandidat::where('sekolah_id', $sekolah_id)->where('skills', 'LIKE', '%' .$req->skills.'%' )->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(5);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(5);
        $if = $kandidat->where('pendidikan', 'Umum');

        return view('layouts/kandidatFilter', compact('search'))->withKandidat($kandidat)->withSide($allkandidat)->withSidee($side)->withSkills($skills)->withKota($kota)->withPendidikan($pendidikan)->withIf($if);
    }

    public function skills($skills)
    {
        // $url = $req->fullURL();
        $kandidat = Kandidat::orderBy('id')->where('skills', 'LIKE', '%' .$skills.'%')->paginate(5);
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(5);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(5);
        $if = $kandidat->where('pendidikan', 'Umum');
        return view('layouts/kandidatFilter', compact('kandidat'))->withKandidat($kandidat)->withIf($if);
        // dd($skills);
    }

    public function kota($kota)
    {
        // $url = $req->fullURL();
        $kandidat = Kandidat::orderBy('id')->where('kota', 'LIKE', '%' .$kota.'%')->paginate(5);
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(5);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(5);
        $if = $kandidat->where('pendidikan', 'Umum');
        return view('layouts/kandidatFilter', compact('kandidat'))->withKandidat($kandidat)->withIf($if);
        // dd($kota);
    }

    public function pendidikan($pendidikan)
    {
        // $url = $req->fullURL();
        $kandidat = Kandidat::orderBy('id')->where('pendidikan', 'LIKE', '%' .$pendidikan.'%')->paginate(5);
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(5);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(5);
        $if = $kandidat->where('pendidikan', 'Umum');
        return view('layouts/kandidatFilter', compact('kandidat'))->withKandidat($kandidat)->withIf($if);
        // dd($pendidikan);
    }

    public function detail($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('layouts/detailKandidat', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function export_excel()
    {
        return Excel::download(new KandidatExport, 'kandidat.xlsx');
    }
}

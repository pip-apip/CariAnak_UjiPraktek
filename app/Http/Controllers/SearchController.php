<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Artikel;
use App\Kandidat;
use App\Perusahaan;

class SearchController extends Controller
{
    public function search(Request $req)
	{
        $src = Artikel::orderBy('id', 'DESC')->where('judul', 'LIKE', '%' .$req->search.'%')->paginate(5);
        $perusahaan = Auth::guard('perusahaan')->user();
        
        $kt = Category::all();
        $all = Artikel::orderBy('id', 'ASC')->paginate(3);
        return view ('search/artikel')->withSrc($src)->withKt($kt)->withAll($all);

    }
    
    public function searchKandidat(Request $req)
	{
        $skills = $req->input('skills');
        $kota = $req->input('kota');
        $pendidikan = $req->input('pendidikan');
        
        $kandidats = DB::table('kandidats')->get();
        $src = Kandidat::groupBy('sekolah_id')->orderBy('sekolah_id')->where('skills', 'LIKE', '%' .$req->skills.'%')->where('kota', 'LIKE', '%' .$req->kota.'%')->where('pendidikan', 'LIKE', '%' .$req->pendidikan.'%' )->paginate(5);
        $count = Kandidat::where('sekolah_id')->where('skills', 'LIKE', '%' .$skills.'%')->count();
        $all = Kandidat::orderBy('sekolah_id', 'ASC')->paginate(5);
        return view ('search/sekolahan')->withSrc($src)->withAll($all)->withReq($req)->withSkills($skills)->withKota($kota)->withPendidikan($pendidikan)->withCount($count)->withKandidats($kandidats);
    }

    public function searchPerusahaan(Request $req)
    {
        $name = $req->perusahaans;
        $perusahaan = Perusahaan::orderBy('id', 'DESC')->where('name', 'LIKE', '%' .$req->perusahaans.'%')->firstOrFail();
        
        return view('layouts/detailPerusahaan', compact('name'))->withPerusahaan($perusahaan);
    }
    
    
}

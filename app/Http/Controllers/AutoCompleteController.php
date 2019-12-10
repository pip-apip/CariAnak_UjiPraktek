<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Perusahaan;

class AutoCompleteController extends Controller
{
    public function skills(Request $request)
    {
        $search = $request->get('get');
        $result = Kandidat::where('skills', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }

    public function kota(Request $request)
    {
        $search = $request->get('get');
        $result = Kandidat::where('kota', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }

    public function pendidikan(Request $request)
    {
        $search = $request->get('get');
        $result = Kandidat::where('pendidikan', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }

    public function perusahaan(Request $request)
    {
        $search = $request->get('get');
        $result = Perusahaan::where('name', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kandidat;
use App\Sekolah;
use Auth;

class DetailController extends Controller
{
    public function dataPribadi($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/dataPribadi', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function kontak($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/kontak', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function pengalamanKerja($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/pengalamanKerja', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function pelatihan($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/pelatihan', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function portofolio($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/portofolio', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function mediaSosial($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/mediaSosial', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function minatKeahlian($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/minatKeahlian', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }

    public function lampiran($id)
    {
        $kandidat = Kandidat::where('name', $id)->firstOrFail();
        $allkandidat = Kandidat::orderBy('id', 'DESC')->paginate(3);
        $side = Kandidat::orderBy('id', 'ASC')->paginate(3);

        return view('detail/lampiran', compact('kandidat'))->withSide($allkandidat)->withSidee($side);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kandidat;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Kandidat $kandidat)
    { 
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $kandidat->name = request('name');
        $kandidat->email = request('email');
        $kandidat->password = bcrypt(request('password'));
        $kandidat->alamat = request('alamat');
        $kandidat->kota = request('kota');
        $kandidat->provinsi = request('provinsi');
        $kandidat->negara = request('negara');
        $kandidat->tgl_lahir = request('tgl_lahir');
        $kandidat->tmp_lahir = request('tmp_lahir');
        $kandidat->avatar = request('avatar');
        $kandidat->sekolah_id = request('sekolah_id');
        $kandidat->skills = request('skills');
        $kandidat->pendidikan = request('pendidikan');

        $kandidat->save();

        return back();
    }
}

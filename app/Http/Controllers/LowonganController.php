<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Perusahaan;
use App\Lowongan;

class LowonganController extends Controller
{
    public function create()
    {
        return view('form/addlowongan');
    }

    public function store(Request $request)
    {
        $lowongan = new \App\Lowongan;
        $lowongan->posisi = $request->posisi;
        
            $this->validate($request, [
                'posisi'  => 'required|max:10000',
                'deskripsi' => 'required',
                'alamat' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:10000'
                ]);

        $file = $request->file('foto');
        $fileName = $file->getClientOriginalName();
        $request->file('foto')->move('imagelowongan/', $fileName);
        $lowongan->foto = $fileName;

        $lowongan->deskripsi = $request->get('deskripsi');
        $lowongan->start = $request->get('start');
        $lowongan->end = $request->get('end');
        $lowongan->kota = $request->get('kota');
        $lowongan->provinsi = $request->get('provinsi');
        $lowongan->perusahaan_id = Auth::guard('perusahaan')->user()->id;
        $lowongan->author = $request->get('author');
        $lowongan->alamat = $request->get('alamat');
        $lowongan->save();
        return redirect('home');
    }

    public function update(Request $request, $id)
    {
         //
         $lowongan= \App\Lowongan::find($id);
         if ($file= $request->file('foto')) {
             $fileName   = $file->getClientOriginalName();
             $request->file('foto')->move("imagelowongan/", $fileName);
             $lowongan->foto = $fileName;
         }
     
         
            $lowongan->deskripsi = $request->get('deskripsi');
            $lowongan->start = $request->get('start');
            $lowongan->end = $request->get('end');
            $lowongan->kota = $request->get('kota');
            $lowongan->provinsi = $request->get('provinsi');
            $lowongan->perusahaan_id = Auth::guard('perusahaan')->user()->id;
            $lowongan->author = $request->get('author');
            $lowongan->alamat = $request->get('alamat');
        
         $lowongan->save();
            return redirect('home')->with('lowongan',$lowongan);
    }

    public function edit($id)
    {
        $lowongan = Lowongan::find($id);
        return view('form/editlowongan',compact('lowongan','id'))->withLowongan($lowongan);
    }

    public function destroy($id)
    {
        $lowongan = \App\Lowongan::find($id);
        $lowongan->delete();
        return back();
    }

}

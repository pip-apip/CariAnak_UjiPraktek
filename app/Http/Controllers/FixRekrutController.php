<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixRekrut;
use Auth;

class FixRekrutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Auth::guard('perusahaan')->user();
        $fix = FixRekrut::where("perusahaan_id", "=", $perusahaan->id)->orderby('id', 'desc')->paginate(10);
        return view('dash/dashboardwishlist', compact('perusahaan', 'fix'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'perusahaan_id'=>'required',
            'kandidat_id' =>'required',
        ));

        $find = FixRekrut::where("kandidat_id", "=", $request->kandidat_id)->count();

        if($find > 0){
            return redirect(route('wishlist.delete', $request->id));
        }else{
            $rekrut = new FixRekrut;
            $rekrut->perusahaan_id = $request->perusahaan_id;
            $rekrut->kandidat_id = $request->kandidat_id;
            $rekrut->status = '1';
            $rekrut->save();

            return redirect(route('wishlist.delete', $request->id));
        }
    }

    public function storeWithTrigger($id)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kandidat = FixRekrut::find($id);
        $kandidat->kandidat_id = $request->get('kandidat_id');
        $kandidat->perusahaan_id = $request->get('perusahaan_id');
        $kandidat->status = $request->get('status');
        $kandidat->save();

        return redirect(route('wishlist.index1'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fix = FixRekrut::findOrFail($id);
        $fix->delete();

        return back();
    }
}

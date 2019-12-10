<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FixRekrut;
use App\Wishlist;
use App\Kandidat;
use Auth;

class WishlistController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Auth::guard('perusahaan')->user();
        $wishlists = Wishlist::where("perusahaan_id",  $perusahaan->id)->orderby('id', 'desc')->paginate(10);
        $fix = FixRekrut::where("perusahaan_id",  $perusahaan->id)->orderby('id', 'desc')->paginate(10);
        return view('dash/dashboardwishlist', compact('perusahaan', 'wishlists', 'fix'));
    }

    public function index1()
    {
        $kandidat = Auth::guard('kandidat')->user();
        $wishlists = Wishlist::where("kandidat_id", "=", $kandidat->id)->orderby('id', 'desc')->paginate(10);
        $fix = FixRekrut::where("kandidat_id", "=", $kandidat->id)->orderby('id', 'desc')->paginate(10);
        $status1 = $fix->where('status', 1);
        $status2 = $fix->where('status', 2);
        return view('dash/dashboardwishlistKandidat', compact('kandidat', 'wishlists', 'fix', 'status1', 'status2'));
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
        //Validating title and body field
        $this->validate($request, array(
            'perusahaan_id'=>'required',
            'kandidat_id' =>'required',
        ));

        $find = Wishlist::where("kandidat_id", "=", $request->kandidat_id)->count();
        
        if ($find > 0) {
            return back();
        }else{
            $wishlist = new Wishlist;
            // $wishlist->find();
            $wishlist->perusahaan_id = $request->perusahaan_id;
            $wishlist->kandidat_id = $request->kandidat_id;

            $wishlist->save();

            return back();
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return back();
        // return redirect()->route('wishlist.index')
        //     ->with('flash_message',
        //     'Item successfully deleted');
    }
}

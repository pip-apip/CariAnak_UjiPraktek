<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Artikel;
use DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cate = Category::where('name', $id)->first();
		$judul = $cate->judul;
		$id  = $cate->id;
        
        $artikel = Artikel::where('kategori', $id)->firstOrFail();
		$blogFilter = Artikel::where('kategori', $id)->paginate(5);
        $sidebar = Artikel::orderBy('id', 'DESC')->paginate(3);
        $cat = Category::all();
        return view('layouts/blogFilter', compact('artikel'))->withFilter($blogFilter)->withSide($sidebar)->withTitle($judul)->withKate($cat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $createcate  = \App\Category::all();
        return view('form/addkategori')->withCate($createcate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new \App\Category;
        $category->name = $request->get('name');

        $this->validate($request, [
            'name'  => 'required|max:10000',
            ]);

        $category->save();
        return redirect('datakategori');
    }

    public function storeWithSP(Request $request){
        $input = $request->input('name');
        DB::select(
            "call insert_category( '$input' )"
        );
        array ( 'input' => $input);
        // dd($request->input('name'));
        return redirect('datakategori');
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
        $category = \App\Category::find($id);
        return view('form/editkategori',compact('category','id')); 
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
        $category= \App\Category::find($id);
        $category->name = $request->get('name');
        $category->save();
        return redirect('datakategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function result(){
        $artikel = \App\Artikel::all();
        $category = \App\Kategori::all();
        return view('form/addblog')->withArtikel($artikel)
                                    ->withCategory($category);
    }
}

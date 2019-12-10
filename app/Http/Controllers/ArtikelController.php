<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Artikel;
use App\Category;
use App\Tag;
use App\Comment;
use App\Perusahaan;
use Auth;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = \App\Category::all();
        $allartikel = Artikel::orderBy('id', 'DESC')->paginate(3);
        $sidebar = Artikel::orderBy('id', 'ASC')->paginate(3);
        return view('layouts/blog')->withAll($allartikel)->withSide($sidebar)->withKate($cat);
    }

    public function show($id)
    {
        $artikel = Artikel::where('judul', $id)->firstOrFail();
        $allartikel = Artikel::orderBy('id', 'DESC')->paginate(3);
        $side = Artikel::orderBy('id', 'ASC')->paginate(3);
        $cat = \App\Category::all();

        $get_id_artikel = $artikel->id;

        $comment  = \App\Comment::where('post_id', $get_id_artikel)->get();
        return view('layouts/blogpost', compact('artikel'))->withCate($cat)->withSide($allartikel)->withSidee($side)->withComen($comment);
    }

    public function create()
    {   
        $tag  = Tag::orderBy('name', 'ASC')->get();
        $cat = Category::all();
        return view('form/addblog')->withKate($cat)->withTag($tag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeperusahaan(Request $request)
    {
        $artikel = new \App\Artikel;
        $artikel->judul = $request->judul;
        
            $this->validate($request, [
                'judul'  => 'required|max:10000',
                'description' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:10000'
                ]);
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $request->file('foto')->move('uploads/', $fileName);
            $artikel->foto = $fileName;

        $artikel->description = $request->get('description');
        $artikel->kategori = $request->get('kategori');
        $artikel->author = $request->get('author');
        $artikel->id_perusahaan = Auth::guard('perusahaan')->user()->id;
        $artikel->save();
        return redirect('blog');
    }

    public function storekandidat(Request $request)
    {
        $artikel = new \App\Artikel;
        $artikel->judul = $request->judul;
        
            $this->validate($request, [
                'judul'  => 'required|max:10000',
                'description' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:10000'
                ]);
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $request->file('foto')->move('uploads/', $fileName);
            $artikel->foto = $fileName;

        $artikel->description = $request->get('description');
        $artikel->kategori = $request->get('kategori');
        $artikel->author = $request->get('author');
        $artikel->id_kandidat = Auth::guard('kandidat')->user()->id;
        $artikel->save();
        return redirect('blog');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateperusahaan(Request $request, $id)
    {
         //
        $artikel= \App\Artikel::find($id);
        if ($file= $request->file('foto')){
            $fileName   = $file->getClientOriginalName();
            $request->file('foto')->move("uploads/", $fileName);
            $artikel->foto = $fileName;
        }
    
        
        $artikel->judul = $request->get('judul');
        $artikel->description = $request->get('description');
        $artikel->kategori = $request->get('kategori');
        $artikel->author = $request->get('author');
        $artikel->id_perusahaan = Auth::guard('perusahaan')->user()->id;
        
        $artikel->save();
        return redirect('blog')->with('artikel',$artikel);
    }

    public function updatekandidat(Request $request, $id)
    {
         //
        $artikel= \App\Artikel::find($id);
        if ($file= $request->file('foto')){
        $fileName   = $file->getClientOriginalName();
        $request->file('foto')->move("uploads/", $fileName);
        $artikel->foto = $fileName;
        }

        $artikel->judul = $request->get('judul');
        $artikel->description = $request->get('description');
        $artikel->kategori = $request->get('kategori');
        $artikel->author = $request->get('author');
        $artikel->id_perusahaan = Auth::guard('kandidat')->user()->id;
        
        $artikel->save();
            return redirect('blog')->with('artikel',$artikel);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::find($id);
        $category = Category::all();
        $tag = Tag::all();
        return view('form/editblog',compact('artikel','id'))->withArtikel($artikel)->withCategory($category)->withTag($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = DB::table('comment')->where('post_id', $id);
        $comment->delete();

        $artikel = \App\Artikel::find($id);
        $artikel->delete();
        return back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get() //ambil data post yang user id nya sama dengan yang sedang log in 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //untuk menampilkan view create
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //untuk proses create
    {
        $validatedData = $request->validate([ //utk menangkap data yang dikirimkan
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]) ; 

        //jika request imgae ada isinya (true), maka akan menambah 1 buah validatedData
        //jika kosong, tidak dijalankan
        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');  //yang diisi dengan upload gambarnya sekaligus nama gambarnya, kemudian di store dan disimpan di post-images
        }
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        
        Post::create($validatedData); // lalu dimasukkan ke dalam database

        return redirect('/dashboard/posts')->with('success', 'Resep baru sudah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) //untuk menampillkan view delete
    {
        return view('dashboard.posts.edit', [
            'post' => $post, 
            'categories' => Category::all() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) //untuk proses ubahnya
    {
        $rules = [ //utk menangkap data yang dikirimkan
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        if($request->slug != $post->slug) {
            $rules['slug'] ='required|unique:posts';
        }

        $validatedData = $request->validate($rules);
        
        //jika request imgae ada isinya (true) dan diganti, maka akan menambah 1 buah validatedData
        //jika kosong, tidak dijalankan, tetap kosong
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage); //jika gambar lama ada, akan menghapus gambar lama nya
            }
            $validatedData['image'] = $request->file('image')->store('post-images');  //jika gambar lamanya ga ada, akan mengupload gambar baru yg diisi dgn upload gambarnya sekaligus nama gambarnya, kemudian di store dan disimpan di post-images
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)
            ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Resep berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)//post dengan method delete 
    {
        if($post->image) {
            Storage::delete($post->image); //jika gambar lama ada, akan menghapus gambar lama nya
        }

        Post::destroy($post->id); // hapus dari tabel post dimana berdasarkan id
        return redirect('/dashboard/posts')->with('success', 'Resep berhasil dihapus!');
    }

    public function checkSlug(Request $request) //utk menangani ketika ada permintaan slug
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title); //create slug, ambil dari class post, ngambil field slug, judulnya ambil dari request  yg key nnya judul
        return response()->json(['slug' => $slug]); //retuen sebagai respon 
    }
}

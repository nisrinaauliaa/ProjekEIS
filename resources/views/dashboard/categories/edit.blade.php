@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Mengubah Kategori</h1>
</div>

<form method="post" action="/dashboard/categories/{{ $category->slug }}" class="mb-5" enctype="multipart/form-data">
    @method('put')
    @csrf 
    {{-- untuk menangani Cross-site request forgery utk kemananan website --}}
    <div class="mb-3">
        <label for="title" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">
        @error('title')
         <div class="invalid-feedback">
            {{ $message }}
         </div>   
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}">
        @error('slug')
        <div class="invalid-feedback">
           {{ $message }}
        </div>   
       @enderror
    <button type="submit" class="btn btn-dark">Update Resep</button>
</form>

{{-- apa yg kita isikan ke dalam judul akan diolah ke method fetch dan dikembalikan datanya sebagai slug
    input: title
    output: slug --}}
<script>
     const title = document.querySelector('#title');
     const slug = document.querySelector('#slug');

     title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value) //jika ada request ke dashboard/posts/checkSlug 
            .then(response => response.json()) //akan mengambil isinya dan responnya akan jalankan ke dalma method json
            .then(data => slug.value = data.slug) //dalam bentuk data dan mengganti slug dari value yang dimasukkan (title )
     });

     document.addEventListener('trix-file-accept', function(e) {
         e.preventDefault();
     })
</script>
@endsection
@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="color: #B42B51"><b> Buat Baru</b></h1>
</div>

<form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data"> 
    {{-- encrype: atribut yang menangani file --}}
    @csrf 
    {{-- untuk menangani Cross-site request forgery utk kemananan website --}}
    <div class="mb-3">
        <label for="title" class="form-label" style="color: #B42B51">Judul</label>
        <input type="text" class="form-control @error ('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
        @error('title')
         <div class="invalid-feedback">
            {{ $message }}
         </div>   
        @enderror
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label" style="color: #B42B51">Slug</label>
        <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
        @error('slug')
        <div class="invalid-feedback">
           {{ $message }}
        </div>   
       @enderror
    <div class="mb-3">
        <label for="category" class="form-label" style="color: #B42B51">Kategori</label>
        <select class="form-select" name="category_id">
            @foreach ($categories as $category)
                @if (old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option> 
                @else 
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label" style="color: #B42B51">Masukkan gambar</label>
        <input class="form-control @error ('image') is-invalid @enderror" type="file" id="image" name="image">
        @error('image')
        <div class="invalid-feedback">
           {{ $message }}
        </div>   
       @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label" style="color: #B42B51">Isi</label>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
        <trix-editor input="body"></trix-editor>
    </div> 
    <button type="submit" class="btn" style="background-color: #EF9F9F; color:#B42B51"><b> Buat Post</b></button>
</form>

{{-- apa yg kita isikan ke dalam judul akan diolah ke method fetch dan dikembalikan datanya sebagai slug
    input: title
    output: slug --}}
<script>
     const title = document.querySelector('#title');
     const slug = document.querySelector('#slug');

     title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value) //jika ada request ke dashboard/posts/checkSlug 
            .then(response => response.json()) //akan mengambil isinya dan responnya akan jalankan ke dalam method json
            .then(data => slug.value = data.slug) //dalam bentuk data dan mengganti slug dari value yang dimasukkan (title)
     });

     document.addEventListener('trix-file-accept', function(e) {
         e.preventDefault();
     })   
</script>
@endsection
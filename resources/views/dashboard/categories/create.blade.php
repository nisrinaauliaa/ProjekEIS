@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Kategori Baru</h1>
</div>

<form method="post" action="/dashboard/categories" class="mb-5" enctype="multipart/form-data"> 
    {{-- encrype: atribut yang menangani file --}}
    @csrf 
    {{-- untuk menangani Cross-site request forgery utk kemananan website --}}
    <div class="mb-3">
        <label for="name" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control @error ('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('title') }}">
        @error('name')
         <div class="invalid-feedback">
            {{ $message }}
         </div>   
        @enderror
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error ('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
        @error('slug')
        <div class="invalid-feedback">
           {{ $message }}
        </div>   
       @enderror
    <button type="submit" class="btn btn-dark">Buat Kategori</button>
</form>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
       fetch('/dashboard/categories/checkSlug?name=' + name.value) //jika ada request ke dashboard/posts/checkSlug 
           .then(response => response.json()) //akan mengambil isinya dan responnya akan jalankan ke dalam method json
           .then(data => slug.value = data.slug) //dalam bentuk data dan mengganti slug dari value yang dimasukkan (title)
    });

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })   
</script>
@endsection
@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center" style="color: #B42B51"><b> {{ $title }}</b></h1>

@if ($posts->count())
<div class="card mb-3">
    @if ($posts[0]->image)
        <div style="max-height: 350px; overflow:hidden"> 
            <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">
        </div>
    @else
        <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
    @endif
    <div class="card-body text-center">
      
      <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none" style="color: #B42B51">{{ $posts[0]->title }}</a></h3>
      
      <p>
        <small class="text-muted">
            Ditulis oleh: <a style="color: #B42B51" href="/authors/{{ $posts[0]->author->username }}"class="text-decoration-none">{{ $posts[0]->author->name }}</a>, kategori <a href="/categories/{{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
        </small>
      </p>
      
      <p class="card-text">{{ $posts[0]->excerpt  }}</p>
      <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn" style="background-color: #EF9F9F; color: #B42B51"><b> Read more</b></a>
    </div>
</div>


    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute p-2 rounded" style="background-color:rgba(0, 0, 0, 0.7)"><a href="/categories/{{ $post->category->slug ?? 'None' }}" class="text-white text-decoration-none">{{ $post->category->name ?? 'None'}}</a></div>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid rounded">
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $post->category->name ?? 'None' }}" class="card-img-top" alt="{{ $post->category->name ?? 'None' }}">
                    @endif
                    <div class="card-body">
                      <h5 class="card-title" style="color: #B42B51">{{ $post->title }}</h5>
                      <p>
                        <small class="text-muted">
                            Ditulis oleh: <a style="color: #B42B51" href="/authors/{{ $post->author->username }}"class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                        </small>
                      </p>
                      <p class="card-text">{{ $post->excerpt }}</p>
                      <a href="/posts/{{ $post->slug }}" class="btn" style="background-color: #EF9F9F; color: #B42B51"><b> Read more</b></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@else
    <p class="text-center fs-4">No Post Found!</p>
@endif

@endsection


    

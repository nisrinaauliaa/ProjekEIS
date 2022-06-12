@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2" style="color: #B42B51">All Posts</h1>
</div> 

@if (session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

<div class="table-responsive col-lg-8">
  <a href="/dashboard/posts/create" class="btn mb-3" style="background-color: #EF9F9F; color: #B42B51"><b> Buat Baru</b></a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col" style="color: #B42B51">#</th>
          <th scope="col" style="color: #B42B51">Judul</th>
          <th scope="col" style="color: #B42B51">Kategori</th>
          <th scope="col" style="color: #B42B51">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name ?? 'None' }}</td>
            <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span> </a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span> </a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf 
                  {{-- utk mengamankan form --}}
                  <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-header"><a href="{{ route('exportpost') }}" class="btn" style="background-color: #3bc082; color: #B42B51"><b> Reporting to Excel</b></a></div>
@endsection
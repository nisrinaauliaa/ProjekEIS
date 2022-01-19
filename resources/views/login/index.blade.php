@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
  <div class="col-md-5">
    
{{-- ketika berhasil log in --}}
    @if (session()->has('success')) 
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
     {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

{{-- ketika gagal log in --}}
    @if (session()->has('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
     {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <main class="form-signin">
      <h1 class="h3 mb-3 fw-normal text-center">Silahkan Masuk</h1>
      <form action="/login" method="post">
        @csrf
        <div class="form-floating">
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" autofocus required value="{{ old('username') }}">
            <label for="username">Username</label>
            @error('username')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
  
        <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk</button>
        <small class="d-block text-center mt-2">Belum punya akun? <a href="/register">Register</a></small>
        <p class="mt-5 mb-3 text-muted text-center">&copy; RUMAHAN 2022</p>
      </form>
      
    </main>
  </div>
</div>

@endsection
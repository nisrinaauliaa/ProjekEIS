@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
  <div class="col-lg-7">
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center">Silahkan Register</h1>
      <form action="/register" method="post">
        @csrf
        <div class="form-floating">
            <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
            <label for="name">Nama</label>
            @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
        </div>
        <div class="form-floating">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
            <label for="username">Username</label>
            @error('username')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
          <label for="email">Email</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
          <label for="password">Kata Sandi</label>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
        </div>
  
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Buat Akun</button>
        <small class="d-block text-center mt-2">Sudah punya akun? <a href="/login">Masuk</a></small>
        <p class="mt-5 mb-3 text-muted text-center">&copy; RUMAHAN 2022</p>
      </form>
      
    </main>
  </div>
</div>

@endsection
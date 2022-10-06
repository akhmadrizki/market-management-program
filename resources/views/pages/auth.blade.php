@extends('layouts.auth')

@section('content')

<div class="row h-100">
  <div class="col-lg-5 col-12 d-flex flex-column justify-content-center">
    <div id="auth-left">
      <h1 class="auth-title">Log in.</h1>
      <p class="auth-subtitle">Pasar Kelan Management System</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        @error('username')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group position-relative has-icon-left">
          <input type="text" class="form-control @error('username') is-invalid @enderror form-control-xl"
            name="username" placeholder="Username" required autofocus>
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
        </div>

        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
      </form>

      <div class="text-center mt-5 text-lg fs-6">
        <p class="text-gray-600">
          Copyright &copy; {{ date('Y') }} | ☎️ <a href="https://wa.me/6281999015508" target="_blank"><u>Contact
              Developer</u></a>
        </p>
      </div>
    </div>
  </div>

  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
  </div>
</div>

@endsection
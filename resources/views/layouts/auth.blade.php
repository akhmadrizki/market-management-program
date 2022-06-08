<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Pasar Kelan Management System</title>
  <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
  <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
  <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">

  <style>
    #auth #auth-left {
      padding: 5rem !important;
    }
  </style>
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-5 col-12 d-flex flex-column justify-content-center">
        <div id="auth-left">
          <h1 class="auth-title">Log in.</h1>

          <form action="index.html">
            <div class="form-group position-relative has-icon-left my-4">
              <input type="text" class="form-control form-control-xl" placeholder="Username">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" placeholder="Password">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
          </form>
          <div class="text-center mt-5 text-lg fs-6">
            <p class="text-gray-600">
              Copyright &copy; {{ date('Y') }} | ☎️ <a href="https://wa.me/6281999015508"><u>Contact
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

  </div>
</body>

</html>
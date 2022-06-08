<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Pasar Kelan Management System</title>
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

    @yield('content')

  </div>
</body>

</html>
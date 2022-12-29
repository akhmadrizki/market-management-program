<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | Pasar Kelan Management System</title>

  <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}">
  <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">

  <link rel="stylesheet" href="{{asset('assets/css/pages/simple-datatables.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/pages/form-element-select.css')}}">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

  <style>
    .logout {
      background-color: #f3616d;
      border-radius: 0.5rem;
      width: 100%;
    }

    .logout:hover {
      background-color: #df404d !important;
    }
  </style>

  @yield('additional-css')

</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
          <div class="align-items-center text-center">
            <div class="logo">
              <a href="index.html">
                <h5>Pasar Kelan Management System</h5>
              </a>
            </div>

            <div class="theme-toggle d-flex justify-content-center gap-2  align-items-center mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                role="img" class="iconify iconify--system-uicons" width="20" height="20"
                preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                    opacity=".3"></path>
                  <g transform="translate(-210 -1)">
                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                    <circle cx="220.5" cy="11.5" r="4"></circle>
                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                  </g>
                </g>
              </svg>
              <div class="form-check form-switch fs-6">
                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                <label class="form-check-label"></label>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                </path>
              </svg>
            </div>

            <div class="sidebar-toggler x">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          @php
          $route = Request::route()->getName();
          @endphp

          <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ $route == 'dashboard' ? 'active' : null }}">
              <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
              </a>
            </li>

            <li
              class="sidebar-item {{ $route == 'kontrak.index' || $route == 'pembayaran.index'  ? 'active' : null }} has-sub">
              <a href="#" class='sidebar-link'>
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>Data Kontrak Pasar</span>
              </a>
              <ul class="submenu active">
                <li class="submenu-item {{ $route == 'kontrak.index' ? 'active' : null }}">
                  <a href="{{ route('kontrak.index') }}">Daftar Kontrak</a>
                </li>
                <li class="submenu-item {{ $route == 'pembayaran.index' ? 'active' : null }}">
                  <a href="{{ route('pembayaran.index') }}">Pembayaran</a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item {{ $route == 'pemasukan.index' ? 'active' : null }}">
              <a href="{{ route('pemasukan.index') }}" class='sidebar-link'>
                <i class="bi bi-wallet2"></i>
                <span>Pemasukan</span>
              </a>
            </li>

            <li class="sidebar-item {{ $route == 'pengeluaran.index' ? 'active' : null }}">
              <a href="{{ route('pengeluaran.index') }}" class='sidebar-link'>
                <i class="bi bi-wallet"></i>
                <span>Pengeluaran</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="https://docs.google.com/document/d/1xWy74HVe3LFYMfcia2s1Z1Hc2HwTnWqY/edit?usp=share_link&ouid=113163458957544338651&rtpof=true&sd=true"
                target="_blank" class='sidebar-link'>
                <i class="bi bi-file-earmark-text"></i>
                <span>Unduh Template Invoice</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a href="https://docs.google.com/document/d/1rZAYC78_QkhnIF7SczA9qrpUJn_-ck5Y/edit?usp=share_link&ouid=113163458957544338651&rtpof=true&sd=true"
                target="_blank" class='sidebar-link'>
                <i class="bi bi-file-earmark-check"></i>
                <span>Unduh Template Bukti Pembayaran</span>
              </a>
            </li>

            <li class="sidebar-title">Pasar</li>

            <li class="sidebar-item {{ $route == 'jenis-pasar.index' ? 'active' : null }}">
              <a href="{{ route('jenis-pasar.index') }}" class='sidebar-link'>
                <i class="bi bi-shop-window"></i>
                <span>Jenis Ruko</span>
              </a>
            </li>

            <li class="sidebar-item {{ $route == 'pedagang.index' ? 'active' : null }}">
              <a href="{{ route('pedagang.index') }}" class='sidebar-link'>
                <i class="bi bi-person-lines-fill"></i>
                <span>Data Penyewa</span>
              </a>
            </li>

            <li class="sidebar-title">Admin</li>

            @if (auth()->user()->role_id != 2)
            <li class="sidebar-item {{ $route == 'admin-data.index' ? 'active' : null }}">
              <a href="{{ route('admin-data.index') }}" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Data Admin</span>
              </a>
            </li>
            @endif

            <li class="sidebar-item">
              <a href="{{ route('profile.password', Auth::user()->id) }}" class='sidebar-link text-warning'>
                <i class="bi bi-key-fill text-warning"></i>
                <span>Ubah Password</span>
              </a>
            </li>

            <li class="sidebar-item">
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn sidebar-link logout text-white">
                  <i class="bi bi-box-arrow-left text-white"></i>
                  <span>Keluar</span>
                </button>
              </form>
            </li>

          </ul>
        </div>
      </div>
    </div>

    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        @yield('content')
      </div>

      @yield('modal')

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>&copy; {{ date('Y') }} | v.1.0.0</p>
          </div>
          <div class="float-end">
            <p>Crafted with 🔥 by <a href="https://wa.me/6281999015508" target="_blank">himalaya digital team</a></p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{asset('assets/js/app.js')}}"></script>
  <script src="{{asset('assets/js/extensions/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/js/extensions/form-element-select.js')}}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  @yield('js')
</body>

</html>
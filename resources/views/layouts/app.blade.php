
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- Extra styles first --}}
    @yield('stylesfirst')

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


    {{-- Extra styles --}}
    @yield('styles')

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>


<div id="app">

    {{-- Sidebar --}}
    <div id="sidebar" class="active">
        @include('layouts.sidebar')
    </div>

    <div id="main">

        {{-- Header / Navbar --}}
        <nav class="navbar navbar-header navbar-expand navbar-light">

            <a class="sidebar-toggler" href="#">
                <span class="navbar-toggler-icon"></span>
            </a>

            <button class="btn navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

                <span class="navbar-toggler-icon"></span>

            </button>
            

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto">

                    {{-- Notifications --}}
                    <li class="dropdown nav-icon">

                        <a href="#" data-bs-toggle="dropdown"
                           class="nav-link dropdown-toggle">

                            <i data-feather="bell"></i>

                        </a>

                    </li>
                     {{-- Dark mode button --}}
    {{-- <li class="nav-item me-3">
        <button id="themeToggle" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-moon" id="themeIcon"></i>
        </button>
    </li> --}}

     {{-- User --}}
        <li class="nav-item dropdown">

            <a href="#"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user"
            data-bs-toggle="dropdown"
            aria-expanded="false">

                <div class="avatar me-1">
                    <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="">
                </div>

                <div class="d-none d-md-block d-lg-inline-block">
                    Hi, {{ auth()->user()->name }}
                </div>

            </a>

            {{-- Dropdown Menu --}}
            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item" href="#">
                        <i data-feather="user"></i> Account
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i data-feather="mail"></i> Messages
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i data-feather="settings"></i> Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item"
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i> Logout
                    </a>
                </li>

            </ul>

        </li>

                </ul>

            </div>

        </nav>

        {{-- Main Content --}}
        @yield('content')

        {{-- Footer --}}
        <footer>

            <div class="footer clearfix mb-0 text-muted">

                <div class="float-start">
                    <p>2026 &copy; Your App</p>
                </div>

                <div class="float-end">
                    <p>Laravel Admin Panel</p>
                </div>

            </div>

        </footer>

    </div>

</div>

{{-- JS --}}
<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>

<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- Export files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

{{-- Extra JS --}}
@yield('js')

{{-- <script>

document.addEventListener("DOMContentLoaded", function() {

    const toggleBtn = document.getElementById("themeToggle");
    const darkCss = document.getElementById("darkCss");
    const icon = document.getElementById("themeIcon");

    // Load saved theme
    let theme = localStorage.getItem("theme");

    if(theme === "dark"){
        document.body.classList.add("dark");
        icon.classList.remove("bi-moon");
        icon.classList.add("bi-sun");
    }

    toggleBtn.addEventListener("click", function(){

        document.body.classList.toggle("dark");

        if(document.body.classList.contains("dark")){
            localStorage.setItem("theme", "dark");
            icon.classList.remove("bi-moon");
            icon.classList.add("bi-sun");
        }else{
            localStorage.setItem("theme", "light");
            icon.classList.remove("bi-sun");
            icon.classList.add("bi-moon");
        }

    });

});

</script> --}}





</body>
</html>

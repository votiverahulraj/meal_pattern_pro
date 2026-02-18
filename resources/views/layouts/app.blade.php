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

    {{-- Extra styles --}}
    @yield('styles')

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

                    {{-- User --}}
                   <li class="dropdown">

                        <a href="#" data-bs-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                            <div class="avatar me-1">
                                <img src="{{ asset('assets/images/avatar/avatar-s-1.png') }}" alt="">
                            </div>

                            <div class="d-none d-md-block d-lg-inline-block">
                                Hi, {{ auth()->user()->name }}
                            </div>

                        </a>

                        {{-- Dropdown Menu --}}
                        <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="#">
                                <i data-feather="user"></i> Account
                            </a>

                            <a class="dropdown-item active" href="#">
                                <i data-feather="mail"></i> Messages
                            </a>

                            <a class="dropdown-item" href="#">
                                <i data-feather="settings"></i> Settings
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <i data-feather="log-out"></i> Logout
                                </a>

                                <!-- Hidden Logout Form -->
                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                        </div>

                    </li>


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


{{-- Extra JS --}}
@yield('js')

<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>

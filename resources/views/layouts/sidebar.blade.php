<div class="sidebar-wrapper active">

    {{-- Logo --}}
    <div class="sidebar-header">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="">
    </div>

    <div class="sidebar-menu">

        <ul class="menu">

            {{-- Title --}}
            <li class="sidebar-title">Main Menu</li>

            {{-- Dashboard --}}
            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">

                <a href="{{ url('/dashboard') }}" class="sidebar-link">

                    <i data-feather="home" width="20"></i>

                    <span>Dashboard</span>

                </a>

            </li>
            <li class="sidebar-item {{ request()->is('analytics*') ? 'active' : '' }}">
                <a href="{{ url('/analytics') }}" class="sidebar-link">
                    <i data-feather="bar-chart-2" width="20"></i>
                    <span>Analytics</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('district-usage*') ? 'active' : '' }}">
                <a href="{{ url('/district-usage') }}" class="sidebar-link">
                    <i data-feather="map" width="20"></i>
                    <span>District Usage</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('products*') ? 'active' : '' }}">
                <a href="{{ url('/products') }}" class="sidebar-link">
                    <i data-feather="package" width="20"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('manufacturers*') ? 'active' : '' }}">
                <a href="{{ url('/manufacturers') }}" class="sidebar-link">
                    <i data-feather="users" width="20"></i>
                    <span>Manufacturers</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('bulk-import*') ? 'active' : '' }}">
                <a href="{{ url('/bulk-import') }}" class="sidebar-link">
                    <i data-feather="upload-cloud" width="20"></i>
                    <span>Bulk Import</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('file-upload*') ? 'active' : '' }}">
                <a href="{{ url('/file-upload') }}" class="sidebar-link">
                    <i data-feather="file-plus" width="20"></i>
                    <span>File Upload</span>
                </a>
            </li>


            {{-- Forms --}}
            {{-- <li class="sidebar-item {{ request()->is('form') ? 'active' : '' }}">

                <a href="{{ url('/form') }}" class="sidebar-link">

                    <i data-feather="file-text" width="20"></i>

                    <span>Forms</span>

                </a>

            </li> --}}

            {{-- Table --}}
            {{-- <li class="sidebar-item {{ request()->is('table') ? 'active' : '' }}">

                <a href="{{ url('/table') }}" class="sidebar-link">

                    <i data-feather="grid" width="20"></i>

                    <span>Table</span>

                </a>

            </li> --}}

        </ul>

    </div>

    <button class="sidebar-toggler btn x">
        <i data-feather="x"></i>
    </button>

</div>

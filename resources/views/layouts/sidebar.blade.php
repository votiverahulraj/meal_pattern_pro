
<style>
    /* Default sidebar item */
.sidebar-item {
    border-radius: 8px;
    margin: 4px 10px;
    transition: all 0.25s ease;
}

/* Link styling */
.sidebar-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 8px;
    color: #8890d8;
    text-decoration: none;
    transition: all 0.25s ease;
}

/* Hover effect - LIGHT BLUE */
.sidebar-item:hover .sidebar-link {
    background: #e3f2fd;
    color: #1976d2;
}

/* Hover icon */
.sidebar-item:hover .sidebar-link i {
    color: #1976d2;
}

/* ACTIVE menu item - LIGHT BLUE */
.sidebar-item.active .sidebar-link {
    background: #d0e7ff;
    color: #1976d2;
    font-weight: 600;
}

/* Active icon */
.sidebar-item.active .sidebar-link i {
    color: #1976d2;
}

/* Left active border */
.sidebar-item.active {
    position: relative;
}

.sidebar-item.active::before {
    content: "";
    position: absolute;
    left: -10px;
    top: 5px;
    bottom: 5px;
    width: 4px;
    background: #42a5f5;
    border-radius: 4px;
}


</style>
<div class="sidebar-wrapper active">

    {{-- Logo --}}
    <div class="sidebar-header">
        {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt=""> --}}
        <img src="https://mealpatternpro.com/assets/mealpatternpro-high-resolution-logo-transparent_1765115751422-ClO1F6-M.png" alt="Meal Pattern Pro Logo">

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
            {{-- <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">

                <a href="{{ route('user.list') }}" class="sidebar-link">

                    <i data-feather="home" width="20"></i>

                    <span>User</span>

                </a>

            </li> --}}
            <li class="sidebar-item {{ request()->is('user.list*') ? 'active' : '' }}">
                <a href="{{  url('user/list') }}" class="sidebar-link">
                    <i data-feather="package" width="20"></i>
                    <span>User</span>
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

            <li class="sidebar-item {{ request()->is('myprodouct*') ? 'active' : '' }}">
                <a href="{{ url('/myprodouct') }}" class="sidebar-link">
                    <i data-feather="package" width="20"></i>
                    <span>Products</span>
                </a>
            </li>
             <li class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                <a href="{{ url('/admin/products') }}" class="sidebar-link">
                    <i data-feather="search" width="20"></i>
                    <span>Browse Product</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }}">
                <a href="{{ url('/admin/products') }}" class="sidebar-link">
                    <i data-feather="package" width="20"></i>
                    <span>Products</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ request()->is('prodouct_request') ? 'active' : '' }}">
                <a href="{{ url('/prodouct_request') }}" class="sidebar-link">
                    <i data-feather="clipboard"></i>
                    <span>Product Requests</span>
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

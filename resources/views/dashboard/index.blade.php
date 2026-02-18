

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="main-content container-fluid">

    {{-- Title --}}
    <div class="page-title mb-4">
        <h3>My Dashboard</h3>
        <p class="text-subtitle text-muted">
            Manage your school's nutrition program
        </p>
    </div>


    {{-- Cards Row --}}
    <div class="row mb-3">

        {{-- My Products --}}
        <div class="col-md-4">
            <div class="card card-statistic">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div class="text-muted">My Products</div>
                        <h3 class="mb-0">0</h3>
                    </div>

                    <div>
                        <i class="bi bi-box fs-2"></i>
                    </div>

                </div>

            </div>
        </div>


        {{-- Documents --}}
        <div class="col-md-4">
            <div class="card card-statistic">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div class="text-muted">Documents Available</div>
                        <h3 class="mb-0">0</h3>
                    </div>

                    <div>
                        <i class="bi bi-file-earmark fs-2"></i>
                    </div>

                </div>

            </div>
        </div>


        {{-- Subscription --}}
        <div class="col-md-4">
            <div class="card card-statistic">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>
                        <div class="text-muted">Subscription</div>
                        <h4 class="mb-0">Inactive</h4>
                    </div>

                    <div>
                        <i class="bi bi-calendar fs-2"></i>
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Subscription message --}}
    <div>

        <div class="card-body text-center">

            <h5>No Active Subscription</h5>

            <p class="text-muted">
                Subscribe to access CN Labels, compliance reports, and product reviews
            </p>

            <button class="btn btn-primary">
                View Plans - Starting at $99/month
            </button>

        </div>

    </div>


    {{-- My Products --}}
    <div>

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h5>My Products</h5>
                <div class="text-muted">0 Products in your profile</div>
            </div>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-primary">
                View Products
            </a>

        </div>

    </div>


</div>

@endsection

@extends('layouts.app')

@section('title', 'Product Requests')

@section('content')

<div class="main-content container-fluid">

    <!-- Page Title -->
    <div class="page-title mb-3">
        <h3 class="text-white">Product Requests</h3>
        <p class="text-muted">
            Request products and documents that aren't currently available
        </p>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs border-0 mb-3" id="requestTabs">

        <li class="nav-item">
            <button class="nav-link active bg-dark text-white border-0"
                    id="product-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#productTab">

                <i data-feather="package" width="16"></i>
                Product Requests

            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link bg-dark text-white border-0"
                    id="document-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#documentTab">

                <i data-feather="file-text" width="16"></i>
                Document Requests

            </button>
        </li>

    </ul>

    <!-- New Request Button -->
    <div class="mb-3">
        <a href="#" class="btn btn-success">
            <i data-feather="plus"></i>
            New Product Request
        </a>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Product Requests -->
        <div class="tab-pane fade show active" id="productTab">

            <div class="card">

                <div class="card-header">
                    <h4>Your Product Requests</h4>
                </div>

                <div class="card-body text-center py-5">

                    <i data-feather="package"
                       width="50"
                       height="50"
                       class="text-muted mb-3"></i>

                    <h5 class="text-muted">
                        No product requests yet
                    </h5>

                    <p class="text-muted">
                        Click "New Product Request" to submit your first request
                    </p>

                </div>

            </div>

        </div>

        <!-- Document Requests -->
        <div class="tab-pane fade" id="documentTab">

            <div class="card">

                <div class="card-header">
                    <h4>Your Document Requests</h4>
                </div>

                <div class="card-body text-center py-5">

                    <i data-feather="file-text"
                       width="50"
                       height="50"
                       class="text-muted mb-3"></i>

                    <h5 class="text-muted">
                        No document requests yet
                    </h5>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@section('js')

<script>
feather.replace();
</script>

@endsection


@section('styles')

<style>

.nav-tabs .nav-link{
    margin-right: 4px;
    padding: 8px 16px;
}

.nav-tabs .nav-link.active{
    background-color: #111827 !important;
    color: #fff !important;
}

</style>

@endsection

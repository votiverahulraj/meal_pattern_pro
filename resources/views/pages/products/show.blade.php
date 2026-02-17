@extends('layouts.app')

@section('content')
<style>

/* Tabs container */
#productTabs {
    border-bottom: none;
    background: #f8fafc;
    padding: 8px;
    border-radius: 10px;
    width: 100%;
    display: flex;
    justify-content: start;
}

/* Default tab */
#productTabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 10px 18px;
    margin-right: 5px;
    border-radius: 8px;
    transition: 0.3s;
    width: 100%;
    text-align: center;
}

/* Hover effect */
#productTabs .nav-link:hover {
   background: linear-gradient(135deg, #8e8d96, #6366f1);

    color: #0d6efd;
}

/* Active tab */
#productTabs .nav-link.active {
    background: linear-gradient(135deg, #0d6efd, #3d8bfd);
    color: white !important;
    box-shadow: 0 3px 8px rgba(13,110,253,0.3);
}
#productTabs .nav-item {
    flex: 1;
}


/* Tab content area */
.tab-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-top: 10px;
}

/* Card header improvement */
.card-header {
    background: white;
    border-bottom: none;
}

/* Badge improvement */
.badge {
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 20px;
}

</style>
<style>
    .nutri-box {
    background: #1e293b;
    border: 2px solid;
    border-radius: 10px;
    padding: 18px 10px;
    text-align: center;
    min-width: 120px;
    transition: 0.3s;
}

.nutri-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.nutri-value {
    font-size: 20px;
    font-weight: 700;
    color: white;
}

.nutri-label {
    font-size: 13px;
    color: #94a3b8;
}

</style>

<div class="page-heading" style="width:100%; max-width:100%;">


    <div class="page-title mb-3">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
            ← Back to Products
        </a>
    </div>

    <!-- Product Header -->
    <div class="card mb-3">
        <div class="card-body">

            <h3>{{ $product->name }}</h3>

            <p class="text-muted mb-0">
                {{ $product->brand }} | {{ $product->product_code }}
            </p>

        </div>
    </div>

        <!-- Tabs -->
        <div class="card" style="width:100%;">


            <div class="card-header">

                <ul class="nav nav-tabs card-header-tabs" id="productTabs">

                    <li class="nav-item">
                        <button class="nav-link active"
                            data-bs-toggle="tab"
                            data-bs-target="#overview">
                            Overview
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#documents">
                            Documents
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#nutrition">
                            Nutrition
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#details">
                            Details
                        </button>
                    </li>

                </ul>

            </div>

            <div class="card-body">

        <div class="tab-content">

        <!-- Overview Tab -->
        <div class="tab-pane fade show active" id="overview">


            <!-- Product Details Card -->
            <div class="card mb-4 shadow-sm border-0">

                <div class="card-header bg-light fw-bold">
                    Product Details
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Nutri Code</label>
                            <div class="fw-semibold">
                                {{ $product->nutri_code ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Manufacturer</label>
                            <div class="fw-semibold">
                                {{ $product->manufacturer ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Product Number</label>
                            <div class="fw-semibold">
                                {{ $product->product_number ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Unit Size</label>
                            <div>{{ ucfirst($product->unit_size) }}
                                {{-- <span class="badge bg-success px-3 py-2">
                                    {{ ucfirst($product->unit_size) }}
                                </span> --}}
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Packing Servings Card -->
            <div class="card mb-4 shadow-sm border-0">

                <div class="card-header bg-light fw-bold">
                    Packing Servings
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Serving Size</label>
                            <div class="fw-semibold">
                                {{ $product->serving_size ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Case Pack</label>
                            <div class="fw-semibold">
                                {{ $product->case_pack ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Shelf Life</label>
                            <div class="fw-semibold">
                                {{ $product->shelf_life ?? '-' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div>


        <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents">

                <!-- Documents Card -->
                <div class="card mb-4 shadow-sm border-0">

                    <div class="card-header bg-light fw-bold">
                        Product Documents
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <!-- Specification Sheet -->
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">
                                    Specification Sheet
                                </label>

                                <div class="fw-semibold">

                                    @if($product->product_specification_sheet)
                                        <a href="{{ asset('storage/'.$product->product_specification_sheet) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        View Document
                                        </a>
                                    @else
                                        -
                                    @endif

                                </div>
                            </div>


                            <!-- Formulation Statement -->
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">
                                    Formulation Statement
                                </label>

                                <div class="fw-semibold">

                                    @if($product->product_formulation_statement)
                                        <a href="{{ asset('storage/'.$product->product_formulation_statement) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-success">
                                        View Document
                                        </a>
                                    @else
                                        -
                                    @endif

                                </div>
                            </div>


                            <!-- Buy American Compliance -->
                            <div class="col-md-4 mb-3">
                                <label class="text-muted small">
                                    Buy American Compliance
                                </label>

                                <div class="fw-semibold">

                                    @if($product->buy_american_complaince)
                                        <a href="{{ asset('storage/'.$product->buy_american_complaince) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-info">
                                        View Document
                                        </a>
                                    @else
                                        -
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>





       <!-- Nutrition Tab -->
        <!-- Nutrition Tab -->
        <div class="tab-pane fade" id="nutrition">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-light fw-bold">
                    Macronutrients
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <!-- Calories -->
                        <div class="col">
                            <div class="nutri-box border-danger">
                                <div class="nutri-value">
                                    {{ number_format($product->calories ?? 0, 2) }}
                                </div>
                                <div class="nutri-label">
                                    Calories
                                </div>
                            </div>
                        </div>

                        <!-- Protein -->
                        <div class="col">
                            <div class="nutri-box border-primary">
                                <div class="nutri-value">
                                    {{ number_format($product->protein ?? 0, 2) }}g
                                </div>
                                <div class="nutri-label">
                                    Protein
                                </div>
                            </div>
                        </div>

                        <!-- Carbs -->
                        <div class="col">
                            <div class="nutri-box border-warning">
                                <div class="nutri-value">
                                    {{ number_format($product->carbs ?? 0, 2) }}g
                                </div>
                                <div class="nutri-label">
                                    Carbs
                                </div>
                            </div>
                        </div>

                        <!-- Fat -->
                        <div class="col">
                            <div class="nutri-box border-info">
                                <div class="nutri-value">
                                    {{ number_format($product->fat ?? 0, 2) }}g
                                </div>
                                <div class="nutri-label">
                                    Fat
                                </div>
                            </div>
                        </div>

                        <!-- Sat Fat -->
                        <div class="col">
                            <div class="nutri-box border-danger">
                                <div class="nutri-value">
                                    {{ number_format($product->sat_fat ?? 0, 2) }}g
                                </div>
                                <div class="nutri-label">
                                    Sat. Fat
                                </div>
                            </div>
                        </div>

                        <!-- Trans Fat -->
                        <div class="col">
                            <div class="nutri-box border-secondary">
                                <div class="nutri-value">
                                    {{ number_format($product->trans_fat ?? 0, 2) }}g
                                </div>
                                <div class="nutri-label">
                                    Trans Fat
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>




            <!-- Details Tab -->
        <div class="tab-pane fade" id="details">

            <!-- Ingredients Section -->
            <div class="card mb-4 shadow-sm border-0">

                <div class="card-header bg-light fw-bold">
                    Ingredients
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label class="text-muted small">
                                Product Ingredients
                            </label>

                            <div class="fw-semibold">
                                {{ $product->ingredients ?? '-' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Description Section -->
            <div class="card mb-4 shadow-sm border-0">

                <div class="card-header bg-light fw-bold">
                    Description
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label class="text-muted small">
                                Product Description
                            </label>

                            <div class="fw-semibold">
                                {{ $product->description ?? '-' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>



    </div>

</div>

@endsection

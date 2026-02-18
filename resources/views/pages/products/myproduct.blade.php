@extends('layouts.app')

@section('title', 'My Products')

@section('content')

<div class="main-content container-fluid">

    {{-- Page Title --}}
    <div class="page-title d-flex justify-content-between align-items-center mb-3">

        <div>
            <h3>My Products</h3>
        </div>

        <div>
            <a href="#" class="btn btn-success">
                Browse Repository
            </a>
        </div>

    </div>


    {{-- Search Card --}}
    <div class="card card-statistic mb-3">

        <div class="card-body">

            <div class="row">

                {{-- Search --}}
                <div class="col-md-4">
                    <input type="text"
                           class="form-control"
                           placeholder="Search products...">
                </div>


                {{-- Manufacturer Filter --}}
                <div class="col-md-3">
                    <select class="form-control">
                        <option>All Manufacturers</option>
                    </select>
                </div>


                {{-- Product Filter --}}
                <div class="col-md-3">
                    <select class="form-control">
                        <option>All Products</option>
                    </select>
                </div>

            </div>


            {{-- Count --}}
            <div class="mt-2 text-muted">
                0 of 0 products
            </div>

        </div>

    </div>


    {{-- Select options --}}
    <div class="mb-2">

        <label>
            <input type="checkbox"> Select All
        </label>

        <button class="btn btn-sm btn-primary ms-2">
            Select With Documents
        </button>

    </div>



    {{-- No Products Card --}}
    <div class="card card-statistic">

        <div class="card-body text-center">

            <p class="text-muted">
                No products in your profile yet
            </p>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-success">
                Browse Products
            </a>

        </div>

    </div>


</div>

@endsection
                                                                                                                                                                                                                                                            
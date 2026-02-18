@extends('layouts.app')
@section('content')
<div class="container my-5 bg-white">
<div class="d-flex justify-content-between align-items-center p-3">

    <h3 class="mb-0">User Details</h3>

    <a class="btn btn-warning btn-sm px-3"
       href="{{ route('user.list') }}">
        <i class="fa fa-arrow-left me-1"></i> Back
    </a>

</div>
    <!-- Tabs -->
    <ul class="nav nav-pills custom-tabs p-2 rounded-3">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#personalinformation">
                Personal Information
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#contact">
                Contact Information
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#operations">
                Operations
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#supply">
                Supply Chain
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4">

        <!-- Overview -->
        <div class="tab-pane fade show active custom-card p-4 rounded-4" id="personalinformation">
            <h4 class="fw-bold mb-4">Personal Information</h4>

            <div class="row gap-5">
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Name</p>
                    <h5 class="fw-semibold">{{ $user->name??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Email</p>
                    <h5 class="fw-semibold">{{ $user->email??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Mobile Number</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->phone??'' }}</h5>
                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="tab-pane fade custom-card p-4 rounded-4" id="contact">
            <h4 class="fw-bold mb-4 ">Contact Information</h4>
            <div class="row gap-5">
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">Address</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->address??'' }}</h5>
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">City</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->city??'' }}</h5>
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">State</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->state??'' }}</h5>
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">Pincode</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->pincode??'' }}</h5>
                </div>
            </div>
        </div>

        <!-- Nutrition -->
        <div class="tab-pane fade custom-card p-4 rounded-4" id="operations">
            <h4 class="fw-bold mb-4">Operations</h4>
            <div class="row gap-5 mb-4">
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">Job Title</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->job_title??'' }}</h5>
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">Federal Programs</p>
                    @foreach($user->user_detail->federal_programs as $value)
                    <h5 class="fw-semibold">{{ $value??'' }}</h5>
                    @endforeach
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">State</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->student_enrollment??'' }}</h5>
                </div>
                <div class="col-md-3 mb-3 card">
                    <p class="text-secondary mb-1">Pincode</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->meal_per_day??'' }}</h5>
                </div>
            </div>
            <div class="row gap-5">
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Buildings Served</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->building_served??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Annual Budget</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->annual_budget??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Main Distributor</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->main_distributor??'' }}</h5>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="tab-pane fade custom-card p-4 rounded-4" id="supply">
            <h4 class="fw-bold mb-4">Supply Chain</h4>
            <div class="row gap-5 mb-4">
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Software Provider</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->software_provider??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Monthly Hours Searching</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->monthly_hours??'' }}</h5>
                </div>
                <div class="col-md-4 mb-3 card">
                    <p class="text-secondary mb-1">Collection Method</p>
                    @foreach($user->user_detail->collection_method as $value)
                    <h5 class="fw-semibold">{{ $value??'' }}</h5>
                    @endforeach
                </div>

            </div>
            <div class="row gap-5 mb-4">
                <div class="col-md-6 mb-3 card">
                    <p class="text-secondary mb-1">Commodity Diverted</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->commodity_diverted??'' }}</h5>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="text-secondary mb-1">FoodCoop Member</p>
                    <h5 class="fw-semibold">{{ $user->user_detail->foodcoop_member??'' }}</h5>
                </div>
            </div>
        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
    $('.nav-link').click(function(){
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endsection
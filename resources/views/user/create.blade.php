@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="page-title">Add User</h4>
                <p class="text-muted mb-0">Enter User details below</p>
            </div>

            <div class="col-6 text-end">
                <a href="{{ route('user.list') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <form method="POST" action="{{ route('user.process') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- District -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Manufacturer -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="number" name="mobile_no" value="{{ old('mobile_no') }}"
                                class="form-control @error('mobile_no') is-invalid @enderror">
                            @error('mobile_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- Nutri Code -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                class="form-control @error('address') is-invalid @enderror">

                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Manufacturer -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                class="form-control @error('city') is-invalid @enderror">

                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Number -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" name="state" value="{{ old('state') }}"
                                class="form-control @error('state') is-invalid @enderror">

                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Unit Size -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pincode</label>
                            <input type="number" name="pincode" value="{{ old('pincode') }}"
                                class="form-control @error('pincode') is-invalid @enderror">

                            @error('pincode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Serving Size -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" name="jobtitle" value="{{ old('jobtitle') }}"
                                class="form-control @error('jobtitle') is-invalid @enderror">

                            @error('jobtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Case Pack -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Federal Programs</label>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror" type="checkbox" name="federal_programs[]" value="NSLP">
                                <label class="form-check-label">NSLP</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror" type="checkbox" name="federal_programs[]" value="SBP">
                                <label class="form-check-label">SBP</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror"
                                    type="checkbox" name="federal_programs[]" value="SFSP">
                                <label class="form-check-label">SFSP</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror"
                                    type="checkbox" name="federal_programs[]" value="ASSP">
                                <label class="form-check-label">ASSP</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror"
                                    type="checkbox" name="federal_programs[]" value="CACFP">
                                <label class="form-check-label">CACFP</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('federal_programs') is-invalid @enderror"
                                    type="checkbox" name="federal_programs[]" value="FFVP">
                                <label class="form-check-label">FFVP</label>
                            </div>
                            @error('federal_programs')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- Shelf Life -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student Enrollment</label>
                            <input type="text" name="student_enrollment" value="{{ old('student_enrollment') }}"
                                class="form-control @error('student_enrollment') is-invalid @enderror">

                            @error('student_enrollment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meals Per Day</label>
                            <input type="text" name="meals_per_day" value="{{ old('meals_per_day') }}"
                                class="form-control @error('meals_per_day') is-invalid @enderror">

                            @error('meals_per_day')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Specification Sheet -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Building Served</label>
                            <input type="number" name="building_served" value="{{ old('building_served') }}"
                                class="form-control @error('building_served') is-invalid @enderror">

                            @error('building_served')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buy American Compliance -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Annual Budget</label>
                            <input type="text" name="annual_budget" value="{{ old('annual_budget') }}"
                                class="form-control @error('annual_budget') is-invalid @enderror">

                            @error('annual_budget')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Calories -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Main Distributor</label>

                            <input type="text" name="us_food" value="{{ old('us_food') }}"
                                class="form-control @error('us_food') is-invalid @enderror">

                            @error('us_food')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Protein -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Software Provider</label>

                            <input type="text" name="software_provider" value="{{ old('software_provider') }}"
                                class="form-control @error('software_provider') is-invalid @enderror">

                            @error('software_provider')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Carbs -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Monthly Hours Searching</label>
                            <input type="number" name="monthly_hours_search" value="{{ old('monthly_hours_search') }}"
                                class="form-control @error('monthly_hours_search') is-invalid @enderror">

                            @error('monthly_hours_search')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Collection_method</label>

                            <div class="form-check">
                                <input class="form-check-input @error('collection_method') is-invalid @enderror" type="checkbox" name="collection_method[]" value="Calling Manufacturers">
                                <label class="form-check-label">Calling Manufacturers</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('collection_method') is-invalid @enderror" type="checkbox" name="collection_method[]" value="Email">
                                <label class="form-check-label">Email</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('collection_method') is-invalid @enderror" type="checkbox" name="collection_method[]" value="Websites">
                                <label class="form-check-label">Websites</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input @error('collection_method') is-invalid @enderror" type="checkbox" name="collection_method[]" value="Documents On File">
                                <label class="form-check-label">Documents On File</label>
                            </div>
                            @error('federal_programs')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Saturated Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Commodity Diverted</label>
                            <input type="number" name="commodity_diverted" value="{{ old('commodity_diverted') }}"
                                class="form-control @error('commodity_diverted') is-invalid @enderror">

                            @error('commodity_diverted')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trans Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">FoodCoop Member</label>
                            <input type="text" name="trans_fat" value="{{ old('trans_fat') }}"
                                class="form-control @error('trans_fat') is-invalid @enderror">

                            @error('trans_fat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Save Product
                            </button>
                        </div>

                </form>

            </div>
        </div>

    </div>

@endsection

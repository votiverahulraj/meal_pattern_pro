@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="page-title">Add Product</h4>
                <p class="text-muted mb-0">Enter product details below</p>
            </div>

            <div class="col-6 text-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
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

                <form id="productForm" method="POST" action="{{ route('admin.products.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- District -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">District</label>
                            <input type="number" name="district_id" class="form-control">
                        </div>

                        <!-- Manufacturer -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Manufacturer</label>
                            <input type="number" name="manufacturer_id" class="form-control">
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <!-- Nutri Code -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nutri Code</label>
                            <input type="text" name="nutri_code" class="form-control">
                        </div>

                        <!-- Manufacturer -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Manufacturer</label>
                            <input type="text" name="manufacturer" class="form-control">
                        </div>

                        <!-- Product Number -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Number</label>
                            <input type="text" name="product_number" class="form-control">
                        </div>

                        <!-- Unit Size -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit Size</label>
                            <input type="text" name="unit_size" class="form-control">
                        </div>

                        <!-- Serving Size -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Serving Size</label>
                            <input type="text" name="serving_size" class="form-control">
                        </div>

                        <!-- Case Pack -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Case Pack</label>
                            <input type="text" name="case_pack" class="form-control">
                        </div>

                        <!-- Shelf Life -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Shelf Life</label>
                            <input type="text" name="shift_life" class="form-control">
                        </div>

                        <!-- Product Specification Sheet -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Specification Sheet</label>
                            <input type="file" name="product_specification_sheet" class="form-control">
                        </div>

                        <!-- Product Formulation Statement -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Formulation Statement</label>
                            <input type="file" name="product_formulation_statement" class="form-control">
                        </div>

                        <!-- Buy American Compliance -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Buy American Compliance</label>
                            <input type="file" name="buy_american_complaince" class="form-control">
                        </div>
                        <!-- Calories -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Calories</label>
                            <input type="number" name="calories" class="form-control">
                        </div>

                        <!-- Protein -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Protein</label>
                            <input type="number" name="protein" class="form-control">
                        </div>

                        <!-- Carbs -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Carbs</label>
                            <input type="number" name="carbs" class="form-control">
                        </div>

                        <!-- Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fat</label>
                            <input type="number" name="fat" class="form-control">
                        </div>

                        <!-- Saturated Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Saturated Fat</label>
                            <input type="number" name="sat_fat" class="form-control">
                        </div>

                        <!-- Trans Fat -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trans Fat</label>
                            <input type="number" name="trans_fat" class="form-control">
                        </div>


                        <!-- Brand -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control">
                        </div>

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control">
                        </div>

                        <!-- Product Code -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Code</label>
                            <input type="text" name="product_code" class="form-control">
                        </div>

                        <!-- Description -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control"></textarea>
                        </div>

                        <!-- Ingredients -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ingredients</label>
                            <textarea name="ingredients" rows="3" class="form-control"></textarea>
                        </div>

                        <!-- Allergens -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Allergens</label>
                            <textarea name="allergens" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Nutritional Info -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nutritional Info</label>
                            <textarea name="nutritional_info" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Packaging -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Packaging</label>
                            <textarea name="packaging" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Storage -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Storage Requirements</label>
                            <textarea name="storage_requirements" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Preparation -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Preparation Instructions</label>
                            <textarea name="preparation_instructions" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Certifications -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Certifications</label>
                            <textarea name="certifications" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Meal Pattern -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meal Pattern Contributions</label>
                            <textarea name="meal_pattern_contributions" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- CN Statements -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">CN Statements</label>
                            <textarea name="cn_statements" rows="2" class="form-control"></textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                    </div>


                    <!-- Submit Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Product
                        </button>
                    </div>

                </form>
                <!-- Validation Modal -->
                <div class="modal fade" id="validationModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Missing Required Fields</h5>
                                <button type="button" class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <p>Please fill the following fields:</p>

                                <ul id="validationErrors" class="text-danger fw-semibold"></ul>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    OK
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function() {

                    document.getElementById('productForm').addEventListener('submit', function(e) {

                        let requiredFields = [

                            { name: 'district_id', label: 'District', type: 'text' },
                            { name: 'manufacturer_id', label: 'Manufacturer ID', type: 'text' },
                            { name: 'name', label: 'Product Name', type: 'text' },
                            { name: 'nutri_code', label: 'Nutri Code', type: 'text' },
                            { name: 'manufacturer', label: 'Manufacturer', type: 'text' },
                            { name: 'product_number', label: 'Product Number', type: 'text' },
                            { name: 'unit_size', label: 'Unit Size', type: 'text' },
                            { name: 'serving_size', label: 'Serving Size', type: 'text' },
                            { name: 'case_pack', label: 'Case Pack', type: 'text' },
                            { name: 'shift_life', label: 'Shelf Life', type: 'text' },

                            { name: 'calories', label: 'Calories', type: 'text' },
                            { name: 'protein', label: 'Protein', type: 'text' },
                            { name: 'carbs', label: 'Carbs', type: 'text' },
                            { name: 'fat', label: 'Fat', type: 'text' },

                            { name: 'brand', label: 'Brand', type: 'text' },
                            { name: 'category', label: 'Category', type: 'text' },
                            { name: 'product_code', label: 'Product Code', type: 'text' },

                            // ✅ FILE ATTACHMENTS
                            { name: 'product_specification_sheet', label: 'Product Specification Sheet', type: 'file' },
                            { name: 'product_formulation_statement', label: 'Product Formulation Statement', type: 'file' },
                            { name: 'buy_american_complaince', label: 'Buy American Compliance', type: 'file' }

                        ];

                        let emptyFields = [];

                        requiredFields.forEach(function(field) {

                            let input = document.querySelector('[name="' + field.name + '"]');

                            if (!input) return;

                            let isEmpty = false;

                            if (field.type === 'file') {

                                if (input.files.length === 0) {
                                    isEmpty = true;
                                }

                            } else {

                                if (input.value.trim() === '') {
                                    isEmpty = true;
                                }

                            }

                            if (isEmpty) {

                                emptyFields.push(field.label);
                                input.classList.add('is-invalid');

                            } else {

                                input.classList.remove('is-invalid');

                            }

                        });

                        if (emptyFields.length > 0) {

                            e.preventDefault();

                            let errorList = document.getElementById('validationErrors');
                            errorList.innerHTML = "";

                            emptyFields.forEach(function(field) {

                                let li = document.createElement('li');
                                li.innerText = field;
                                errorList.appendChild(li);

                            });

                            let modal = new bootstrap.Modal(
                                document.getElementById('validationModal')
                            );

                            modal.show();

                        }

                    });

                });
                </script>


                {{-- <script>
                    document.addEventListener('DOMContentLoaded', function() {

                        document.getElementById('productForm').addEventListener('submit', function(e) {

                            let requiredFields = [{
                                    name: 'district_id',
                                    label: 'District'
                                },
                                {
                                    name: 'manufacturer_id',
                                    label: 'Manufacturer ID'
                                },
                                {
                                    name: 'name',
                                    label: 'Product Name'
                                },
                                {
                                    name: 'nutri_code',
                                    label: 'Nutri Code'
                                },
                                {
                                    name: 'manufacturer',
                                    label: 'Manufacturer'
                                },
                                {
                                    name: 'product_number',
                                    label: 'Product Number'
                                },
                                {
                                    name: 'unit_size',
                                    label: 'Unit Size'
                                },
                                {
                                    name: 'serving_size',
                                    label: 'Serving Size'
                                },
                                {
                                    name: 'case_pack',
                                    label: 'Case Pack'
                                },
                                {
                                    name: 'shift_life',
                                    label: 'Shelf Life'
                                },
                                {
                                    name: 'calories',
                                    label: 'Calories'
                                },
                                {
                                    name: 'protein',
                                    label: 'Protein'
                                },
                                {
                                    name: 'carbs',
                                    label: 'Carbs'
                                },
                                {
                                    name: 'fat',
                                    label: 'Fat'
                                },
                                {
                                    name: 'brand',
                                    label: 'Brand'
                                },
                                {
                                    name: 'category',
                                    label: 'Category'
                                },
                                {
                                    name: 'product_code',
                                    label: 'Product Code'
                                }
                            ];

                            let emptyFields = [];

                            requiredFields.forEach(function(field) {

                                let input = document.querySelector('[name="' + field.name + '"]');

                                if (!input || input.value.trim() === '') {

                                    emptyFields.push(field.label);

                                    if (input) {
                                        input.classList.add('is-invalid');
                                    }

                                } else {

                                    input.classList.remove('is-invalid');

                                }

                            });

                            if (emptyFields.length > 0) {

                                e.preventDefault();

                                let errorList = document.getElementById('validationErrors');
                                errorList.innerHTML = "";

                                emptyFields.forEach(function(field) {

                                    let li = document.createElement('li');
                                    li.innerText = field;
                                    errorList.appendChild(li);

                                });

                                let modal = new bootstrap.Modal(
                                    document.getElementById('validationModal')
                                );

                                modal.show();

                            }

                        });

                    });
                </script> --}}



            </div>
        </div>

    </div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-6">
            <h4 class="page-title">Edit Product</h4>
            <p class="text-muted mb-0">Update product details below</p>
        </div>

        <div class="col-6 text-end">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>


    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form id="productForm" method="POST"
                action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <!-- District -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">District</label>
                        <input type="number"
                            name="district_id"
                            value="{{ $product->district_id }}"
                            class="form-control">
                    </div>

                    <!-- Manufacturer ID -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Manufacturer</label>
                        <input type="number"
                            name="manufacturer_id"
                            value="{{ $product->manufacturer_id }}"
                            class="form-control">
                    </div>

                    <!-- Product Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text"
                            name="name"
                            value="{{ $product->name }}"
                            class="form-control">
                    </div>

                    <!-- Nutri Code -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nutri Code</label>
                        <input type="text"
                            name="nutri_code"
                            value="{{ $product->nutri_code }}"
                            class="form-control">
                    </div>

                    <!-- Manufacturer -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Manufacturer</label>
                        <input type="text"
                            name="manufacturer"
                            value="{{ $product->manufacturer }}"
                            class="form-control">
                    </div>

                    <!-- Product Number -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Number</label>
                        <input type="text"
                            name="product_number"
                            value="{{ $product->product_number }}"
                            class="form-control">
                    </div>

                    <!-- Unit Size -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit Size</label>
                        <input type="text"
                            name="unit_size"
                            value="{{ $product->unit_size }}"
                            class="form-control">
                    </div>

                    <!-- Serving Size -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Serving Size</label>
                        <input type="text"
                            name="serving_size"
                            value="{{ $product->serving_size }}"
                            class="form-control">
                    </div>

                    <!-- Case Pack -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Case Pack</label>
                        <input type="text"
                            name="case_pack"
                            value="{{ $product->case_pack }}"
                            class="form-control">
                    </div>

                    <!-- Shelf Life -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Shelf Life</label>
                        <input type="text"
                            name="shift_life"
                            value="{{ $product->shift_life }}"
                            class="form-control">
                    </div>


                    <!-- Product Specification Sheet -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Specification Sheet</label>

                        @if($product->product_specification_sheet)
                            <div class="mb-2">
                                <a href="{{ asset('storage/'.$product->product_specification_sheet) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    View Current File
                                </a>
                                 <!-- Delete Button -->
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="deleteAttachment('product_specification_sheet')">
                                    Delete
                                </button>
                            </div>
                        @endif

                        <input type="file"
                        name="product_specification_sheet"
                        class="form-control"
                        data-existing="{{ $product->product_specification_sheet ? '1' : '0' }}">
                        <input type="hidden" name="delete_files[]" id="delete_files">


                    </div>


                    <!-- Product Formulation Statement -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Formulation Statement</label>

                        @if($product->product_formulation_statement)
                            <div class="mb-2">
                                <a href="{{ asset('storage/'.$product->product_formulation_statement) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    View Current File
                                </a>
                                   <!-- Delete Button -->
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="deleteAttachment('product_formulation_statement')">
                                    Delete
                                </button>
                            </div>
                        @endif

                        <input type="file"
                        name="product_formulation_statement"
                        class="form-control"
                        data-existing="{{ $product->product_formulation_statement ? '1' : '0' }}">

                    </div>


                    <!-- Buy American Compliance -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Buy American Compliance</label>

                        @if($product->buy_american_complaince)
                            <div class="mb-2">
                                <a href="{{ asset('storage/'.$product->buy_american_complaince) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    View Current File
                                </a>
                                   <!-- Delete Button -->
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="deleteAttachment('buy_american_complaince')">
                                    Delete
                                </button>

                            </div>
                        @endif

                        <input type="file"
                        name="buy_american_complaince"
                        class="form-control"
                        data-existing="{{ $product->buy_american_complaince ? '1' : '0' }}">

                    </div>


                    <!-- Calories -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Calories</label>
                        <input type="number"
                            name="calories"
                            value="{{ $product->calories }}"
                            class="form-control">
                    </div>

                    <!-- Protein -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Protein</label>
                        <input type="number"
                            name="protein"
                            value="{{ $product->protein }}"
                            class="form-control">
                    </div>

                    <!-- Carbs -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Carbs</label>
                        <input type="number"
                            name="carbs"
                            value="{{ $product->carbs }}"
                            class="form-control">
                    </div>

                    <!-- Fat -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fat</label>
                        <input type="number"
                            name="fat"
                            value="{{ $product->fat }}"
                            class="form-control">
                    </div>

                    <!-- Saturated Fat -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Saturated Fat</label>
                        <input type="number"
                            name="sat_fat"
                            value="{{ $product->sat_fat }}"
                            class="form-control">
                    </div>

                    <!-- Trans Fat -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Trans Fat</label>
                        <input type="number"
                            name="trans_fat"
                            value="{{ $product->trans_fat }}"
                            class="form-control">
                    </div>


                    <!-- Brand -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text"
                            name="brand"
                            value="{{ $product->brand }}"
                            class="form-control">
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text"
                            name="category"
                            value="{{ $product->category }}"
                            class="form-control">
                    </div>


                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="active"
                                {{ $product->status == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                            <option value="pending"
                                {{ $product->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                        </select>

                    </div>


                </div>


                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        Update Product
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

                                let existing = input.getAttribute('data-existing');

                                if (input.files.length === 0 && existing !== '1') {
                                    isEmpty = true;
                                }

                            } else {

                                if (input.value.trim() === "") {
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

            {{-- delete attahcment --}}
            <script>
            let deleteFiles = [];

            function deleteAttachment(fieldName)
            {
                if(confirm("Are you sure you want to delete this file?"))
                {
                    deleteFiles.push(fieldName);

                    document.getElementById('delete_files').value = deleteFiles;

                    alert("File will be deleted when you click Update Product");
                }
            }
            </script>



        </div>
    </div>

</div>

@endsection

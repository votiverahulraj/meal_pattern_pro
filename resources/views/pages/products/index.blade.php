@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Str;
@endphp

    <div class="page-heading">

        <div class="page-title mb-3">
            <div class="row">
                <div class="col-6">
                    <h3>Products</h3>
                </div>

                <div class="col-6 text-end" style="margin-left: 500px">
                       

                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Add Product
                    </a>
                </div>
            </div>
        </div>




        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>
        @endif


        <section class="section">
            <div class="card">
                <div class="card-header">
                    Product List
                </div>
                <div class="col-6 text-end " style="margin-left: 500px">
                       
                    <div class="text-end mb-4">

                        <button class="btn btn-success me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#importModal">
                            <i class="bi bi-upload"></i> Import
                        </button>

                        <a href="{{ route('admin.products.export') }}"
                        class="btn btn-success">
                            Export
                        </a>

                    </div>

                </div>
                
                    


                <div class="card-body">
                        <div class="table-responsive">

                            <table id="productsTable" class="table table-striped table-hover nowrap" style="width:100%">

                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>District ID</th>
                                        <th>Manufacturer ID</th>

                                        <th>Name</th>
                                        <th>Nutri Code</th>
                                        <th>Manufacturer</th>
                                        <th>Product Number</th>

                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Product Code</th>

                                        <th>Unit Size</th>
                                        <th>Serving Size</th>
                                        <th>Case Pack</th>
                                        <th>Shelf Life</th>

                                        <th>Calories</th>
                                        <th>Protein</th>
                                        <th>Carbs</th>
                                        <th>Fat</th>
                                        <th>Sat Fat</th>
                                        <th>Trans Fat</th>

                                        <th>Description</th>
                                        <th>Ingredients</th>
                                        <th>Allergens</th>

                                        <th>Nutritional Info</th>
                                        <th>Packaging</th>
                                        <th>Storage</th>
                                        <th>Preparation</th>

                                        <th>Certifications</th>
                                        <th>Meal Pattern</th>
                                        <th>CN Statements</th>

                                        <th>Status</th>

                                        <th>Spec Sheet</th>
                                        <th>Formulation</th>
                                        <th>Compliance</th>

                                        <th width="150">Action</th>

                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($products as $product)

                                    <tr>

                                        <td>{{ $product->id }}</td>

                                        <td>{{ $product->district_id }}</td>
                                        <td>{{ $product->manufacturer_id }}</td>

                                        <td>
                                            <a href="{{ route('admin.products.show', $product->id) }}"
                                            class="fw-bold text-primary">
                                                {{ $product->name }}
                                            </a>
                                        </td>

                                        <td>{{ $product->nutri_code }}</td>
                                        <td>{{ $product->manufacturer }}</td>
                                        <td>{{ $product->product_number }}</td>

                                        <td>{{ $product->brand }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $product->product_code }}</td>

                                        <td>{{ $product->unit_size }}</td>
                                        <td>{{ $product->serving_size }}</td>
                                        <td>{{ $product->case_pack }}</td>
                                        <td>{{ $product->shift_life }}</td>

                                        <td>{{ $product->calories }}</td>
                                        <td>{{ $product->protein }}</td>
                                        <td>{{ $product->carbs }}</td>
                                        <td>{{ $product->fat }}</td>
                                        <td>{{ $product->sat_fat }}</td>
                                        <td>{{ $product->trans_fat }}</td>

                                        <td>{{ Str::limit($product->description, 50) }}</td>
                                        <td>{{ Str::limit($product->ingredients, 50) }}</td>
                                        <td>{{ Str::limit($product->allergens, 50) }}</td>

                                        <td>{{ Str::limit($product->nutritional_info, 50) }}</td>
                                        <td>{{ Str::limit($product->packaging, 50) }}</td>
                                        <td>{{ Str::limit($product->storage_requirements, 50) }}</td>
                                        <td>{{ Str::limit($product->preparation_instructions, 50) }}</td>

                                        <td>{{ Str::limit($product->certifications, 50) }}</td>
                                        <td>{{ Str::limit($product->meal_pattern_contributions, 50) }}</td>
                                        <td>{{ Str::limit($product->cn_statements, 50) }}</td>


                                        <!-- Status -->
                                        <td>

                                            <span class="badge 
                                                @if ($product->status == 'active') bg-success
                                                @elseif($product->status == 'inactive') bg-danger
                                                @else bg-warning @endif">

                                                {{ ucfirst($product->status) }}

                                            </span>

                                        </td>


                                        <!-- Spec Sheet -->
                                        <td>

                                            @if($product->product_specification_sheet)

                                                <a href="{{ Storage::url($product->product_specification_sheet) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-info">
                                                    View
                                                </a>

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <!-- Formulation -->
                                        <td>

                                            @if($product->product_formulation_statement)

                                                <a href="{{ Storage::url($product->product_formulation_statement) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-info">
                                                    View
                                                </a>

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <!-- Compliance -->
                                        <td>

                                            @if($product->buy_american_complaince)

                                                <a href="{{ Storage::url($product->buy_american_complaince) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-info">
                                                    View
                                                </a>

                                            @else

                                                -

                                            @endif

                                        </td>


                                        <!-- Action -->
                                        <td>

                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal"
                                                    data-id="{{ $product->id }}">
                                                Delete
                                            </button>

                                        </td>


                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>



                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Are you sure you want to delete this product?
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>

                                    <form id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            Yes, Delete
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    
                    <!-- Import Modal -->
                    <div class="modal fade" id="importModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Import Products</h5>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <form action="{{ route('admin.products.import') }}"
                                    method="POST"
                                    enctype="multipart/form-data">

                                    @csrf

                                    <div class="modal-body">

                                        <label>Select Excel File</label>

                                        <input type="file"
                                            name="file"
                                            class="form-control"
                                            required>

                                        <small class="text-muted">
                                            Supported: .xlsx, .csv
                                        </small>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="submit"
                                            class="btn btn-success">
                                            Import
                                        </button>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>  
                        {{--delete modal--}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {

                            var deleteModal = document.getElementById('deleteModal');

                            deleteModal.addEventListener('show.bs.modal', function(event) {

                                var button = event.relatedTarget;
                                var productId = button.getAttribute('data-id');

                                var form = document.getElementById('deleteForm');

                                form.action = "/admin/products/" + productId;

                            });

                        });
                    </script>
                    {{-- success alert --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {

                            let alert = document.getElementById('successAlert');

                            if (alert) {
                                setTimeout(function() {
                                    alert.classList.remove('show');
                                    alert.classList.add('fade');

                                    setTimeout(function() {
                                        alert.remove();
                                    }, 500);

                                }, 4000); // 4 seconds
                            }

                        });
                    </script>
                @section('scripts')
                    <script>
                        $(document).ready(function() {

                            var table = $('#productsTable').DataTable({

                                dom: 'Bfrtip',

                                buttons: ['copy', 'csv', 'pdf', 'print'],

                                pageLength: 10,

                                order: [
                                    [0, 'desc']
                                ],

                                columnDefs: [{
                                    targets: 0,
                                    searchable: false,
                                    orderable: false
                                }]

                            });

                            // Auto serial number update
                            table.on('order.dt search.dt', function() {

                                table.column(0, {
                                        search: 'applied',
                                        order: 'applied'
                                    })
                                    .nodes()
                                    .each(function(cell, i) {

                                        cell.innerHTML = i + 1;

                                    });

                            }).draw();

                        });
                    </script>
                @endsection






            </div>

        </div>
    </section>

</div>

@endsection

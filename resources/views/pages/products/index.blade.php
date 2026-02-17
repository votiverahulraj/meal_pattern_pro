@extends('layouts.app')

@section('content')

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

                <div class="card-body">

                    <table id="productsTable" class="table table-striped table-hover">


                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>District</th>
                                    <th>Manufacturer</th> --}}
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Product Code</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $product)
                                <tr>

                                    <td></td>


                                    {{-- <td>{{ $product->district_id }}</td>

                                    <td>{{ $product->manufacturer_id }}</td> --}}

                                    {{-- <td>{{ $product->name }}</td> --}}
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                            class="fw-bold text-primary">
                                            {{ $product->name }}
                                        </a>
                                    </td>


                                    <td>{{ $product->brand }}</td>

                                    <td>{{ $product->category }}</td>

                                    <td>{{ $product->product_code }}</td>

                                    <td>
                                        <span
                                            class="badge 
                                            @if ($product->status == 'active') bg-success
                                            @elseif($product->status == 'inactive') bg-danger
                                            @else bg-warning @endif">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-warning">Edit
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-id="{{ $product->id }}">
                                            Delete
                                            <i class="bi bi-trash"></i>
                                        </button>



                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

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

                                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],

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

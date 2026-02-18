@extends('layouts.app')
@section('content')
    <div class="card">
        @if (session('success'))
            <span class="alert alert-success">{{ session('success') }}</span>
        @endif
        <div class="card-header w-100 d-flex justify-content-between">
            <div>
                <h4>Orders Today</h4>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('user.add') }}"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table w-100" id="usertable">

                <thead>
                    <tr>
                        <th>S. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $key => $rows)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $rows->name ?? '' }}</td>
                            <td>{{ $rows->email ?? '' }}</td>
                            <td>{{ $rows->user_detail->phone ?? '' }}</td>
                            <td>
                                <a class="text-warning" href="{{ route('user.edit', $rows->id) }}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" class="text-danger delete-btn" data-id="{{ $rows->id }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a class="text-info" href="{{ route('user.details', $rows->id) }}"><i
                                        class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content admin-modal">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">
                        <i class="fa fa-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <a href="#" class="btn btn-danger" id="confirmDelete">
                        Yes, Delete
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Buttons JS for Export -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usertable').DataTable({
                // Enable buttons (Export, Print)
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                // Enable ordering
                ordering: true,
                // Enable search and pagination
                paging: true,
                searching: true,
                // Page length options
                lengthMenu: [10, 25, 50, 75, 100],
            });
        });

        $(document).ready(function() {

            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');

                var url = "{{ route('user.delete', ':id') }}";
                url = url.replace(':id', id);

                $('#confirmDelete').attr('href', url);

                var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            });

        });
    </script>
@endsection

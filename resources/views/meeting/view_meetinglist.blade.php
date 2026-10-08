@extends('layouts.app')
@section('content')
    <style>
        .modal {
            z-index: 1055;
        }

        .modal-dialog.modal-fullscreen {
            width: 100vw !important;
            max-width: 100vw !important;
            height: 100vh;
            margin: 0;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5 class="card-title mb-3">View Meeting List</h5>


                </div>
            </div>
        </div>
    </div>

    <div class="modal-header bg-dark text-white">
        <div>
            <h5 class="mb-0">👥 Registered Users</h5>
            <small class="text-muted">Meeting participants list</small>
        </div>
        {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button> --}}
    </div>

    <!-- BODY -->
    <div class="modal-body bg-light">

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h6>Total Users</h6>
                        <h4 id="userCount">0</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <h6>Paid Amount</h6>
                        <h4 class="text-success">₹ <span id="paidAmount">0</span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm border-warning">
                    <div class="card-body">
                        <h6>Unpaid Amount</h6>
                        <h4 class="text-warning">₹ <span id="unpaidAmount">0</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive bg-white rounded shadow-sm">
            <table id="usersTable" class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Mobile</th>
                        <th>Photo</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="spinner-border text-primary"></div>
                            <div>Loading...</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

    </div>
    </div>
    </div>
@endsection
@push('page_scripts')
    <script></script>
@endpush

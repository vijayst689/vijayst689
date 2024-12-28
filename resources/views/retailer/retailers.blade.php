@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Retailers Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-auto">
                    <div class="position-relative">
                        <input class="form-control px-5" type="search" placeholder="Search">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>
                <div class="col-auto flex-grow-1 overflow-auto">
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <a href="{{ url('addretailer') }}" class="btn btn-primary px-4"><i
                                class="bi bi-plus-lg me-2"></i>Add Retailer</a>
                    </div>
                </div>
            </div><!--end row-->

            <div class="card mt-4">
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewretailers as $key => $cus)
                                        <tr>
                                            <td>R{{ $cus->id }}</td>
                                            <td>{{ $cus->name }}</td>
                                            <td>{{ $cus->phone }}</td>
                                            <td>{{ $cus->status }}</td>
                                            <td>{{ $cus->email }}</td>
                                            <td><img src="/upload/retailer/{{ $cus->profile }}" class="rounded-circle"
                                                    width="40" height="40" alt=""></td>
                                            <td>{{ $cus->cpassword }}</td>
                                            <td>
                                                <button
                                                    onclick="edit_retailer('{{ $cus->id }}','{{ $cus->name }}','{{ $cus->phone }}','{{ $cus->aadhaar_no }}','{{ $cus->gender }}','{{ $cus->email }}','{{ $cus->date_of_birth }}','{{ $cus->address }}')"
                                                    ype="button" style="font-size: small"
                                                    class="btn btn-grd btn-grd-primary px-1">Edit</button>

                                                @if (Auth::user()->user_type_id == 2)
                                                    <button
                                                        onclick="statusupdates('{{ $cus->id }}','{{ $cus->status }}')"
                                                        type="button" class="btn-sm btn btn-success">Update Status</button>
                                                @endif

                                                @if (Auth::user()->user_type_id == 3)
                                                    <button
                                                        onclick="edit_status('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->status }}')"
                                                        type="button" class="btn-sm btn btn-success">Status Update</button>
                                                @endif

                                                <a href="{{ url('/userpermission', $cus->id) }}" type="button"
                                                    style="font-size: small" class="btn btn-inverse-info px-1">Permission</a>

                                                <a onclick="return confirm('Do you want to confirm delete retailer?')"
                                                    href="{{ url('/dropretailer', $cus->id) }}" type="button"
                                                    style="font-size: small" class="btn btn-inverse-danger px-1">Drop</a>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card rounded-4">
                <div class="">
                    <div class="modal fade" id="editretailer">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <h5 class="modal-title">Update Retailers</h5>
                                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ url('/updateretailer') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-6">
                                                <input type="hidden" name="retailer_id" id="retailerid" />
                                                <label for="editname" class="form-label">Name</label>
                                                <input name="name" maxlength="30" type="text" class="form-control"
                                                    id="editname" placeholder="Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editphone" class="form-label">Phone</label>
                                                <input type="text" class="form-control number" id="editphone"
                                                    name="phone" maxlength="10" placeholder="Phone">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editadhar" class="form-label">Aadhaar
                                                    No</label>
                                                <input type="text" name="aadhaar_no" class="form-control"
                                                    maxlength="12" id="editadhar" placeholder="Aadhaar No">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editgender" class="form-label">Gender</label>
                                                <select id="editgender" name="gender" class="form-select">
                                                    <option>Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editemail" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="editemail"
                                                    maxlength="60" placeholder="Email">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editstatus" class="form-label">Status</label>
                                                <select type="text" name="status" class="form-select"
                                                    id="editstatus">
                                                    <option>Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="input8" class="form-label">Profile</label>
                                                <input type="file" name="profile" class="form-control"
                                                    id="input8">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="editaddress" class="form-label">Address</label>
                                                <textarea class="form-control" name="address" id="editaddress" placeholder="Address ..." rows="3"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-grd-danger px-4">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card rounded-4">
                <div class="">
                    <div class="modal fade" id="statusupdate">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form method="post" class="row g-3" action="{{ url('/updatestatus') }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" name="request_id" id="request_id" />
                                                    <div class="mb-3">
                                                        <div class="mb-3">
                                                            <label for="editamount" class="form-label">Amount</label>
                                                            <input readonly type="text" name="amount"
                                                                class="form-control number" maxlength="5" value="2500"
                                                                placeholder="Amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select id="upstatus" type="text" class="form-control"
                                                            maxlength="7" name="status">
                                                            <option>Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mb-3">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card rounded-4">
                <div class="">
                    <div class="modal fade" id="statusup">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ url('/retailerstatusupdate') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="statusid" id="status_id" />
                                                    <div class="mb-3">
                                                        <label for="editstatusupdate" class="form-label">Status</label>
                                                        <select name="status" type="text" maxlength="8"
                                                            class="form-control" id="editstatusupdate">
                                                            <option value="">Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        function edit_retailer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status) {
            $("#editname").val(name);
            $("#editphone").val(phone);
            $("#editadhar").val(aadhaar_no);
            $("#editgender").val(gender);
            $("#editemail").val(email);
            $("#editdob").val(date_of_birth);
            $("#editaddress").val(address);
            $("#editstatus").val(status);
            $("#retailerid").val(id);
            $("#editretailer").modal("show");
        }

        function edit_status(id, status) {
            $("#upstatus").val(status);
            $("#request_id").val(id);
            $("#statusupdate").modal("show");
        }

        function statusupdates(id, status) {
            $("#editstatusupdate").val(status);
            $("#status_id").val(id);
            $("#statusup").modal("show");
        }
    </script>
@endpush

@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Customer</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url('addcustomer') }}"class="btn btn-info"><i
                                class="bi bi-chat me-2"></i>Add Customers</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($viewcustomers as $key => $cus)
                                            <td>C{{ $cus->id }}</td>
                                        <td>
                                            <a class="d-flex align-items-center gap-3" href="{{ url('profile') }}">
                                                <div class="customer-pic">
                                                    <img src="/upload/users/profile_photo/{{ $cus->profile }}"
                                                        class="rounded-circle" width="30" height="30" alt="">
                                                </div>
                                                <p class="mb-0 customer-name fw-bold">{{ $cus->name }}</p>
                                            </a>
                                        </td>
                                        <td>{{ $cus->phone }}</td>
                                        <td style="white-space: nowrap">

                                            <a href="{{ url('/editcustomer', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-primary">Edit</a>

                                            <a href="{{ url('/services/1', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-warning">TNEGA</a>

                                            <a href="{{ url('/documents', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-success">Document</a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="">
                                    <div class="modal fade" id="editcustomer">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                                    <h5 class="modal-title">Edit Customer</h5>
                                                    <a href="javascript:;" class="primaery-menu-close"
                                                        data-bs-dismiss="modal">
                                                        <i class="material-icons-outlined">close</i>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <form class="row g-3" action="{{ url('/updatecustomer') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="customer_id" id="cusid" />
                                                                <label for="editname" class="form-label">Name</label>
                                                                <input name="name" maxlength="30" type="text"
                                                                    class="form-control" id="editname" placeholder="Name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editphone" class="form-label">Phone</label>
                                                                <input type="text" class="form-control number"
                                                                    id="editphone" name="phone" maxlength="10"
                                                                    placeholder="Phone">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editadhar" class="form-label">Aadhaar
                                                                    No</label>
                                                                <input type="text" name="aadhaar_no"
                                                                    class="form-control" maxlength="12" id="editadhar"
                                                                    placeholder="Aadhaar No">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editgender" class="form-label">Gender</label>
                                                                <select id="editgender" name="gender"
                                                                    class="form-select">
                                                                    <option>Select</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editemail" class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control"
                                                                    id="editemail" placeholder="Email">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editdob" class="form-label">DOB</label>
                                                                <input type="date" name="date_of_birth"
                                                                    class="form-control" id="editdob">
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
                                                            <div class="col-md-6">
                                                                <label for="input8" class="form-label">Profile</label>
                                                                <input type="file" name="profile" class="form-control"
                                                                    id="input8">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="editaddress"
                                                                    class="form-label">Address</label>
                                                                <textarea class="form-control" id="editaddress" placeholder="Address ..." rows="3"></textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                                    <button type="submit"
                                                                        class="btn btn-grd-danger px-4">Submit</button>
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
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('page_scripts')
        <script>
            function edit_customer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status) {
                $("#editname").val(name);
                $("#editphone").val(phone);
                $("#editadhar").val(aadhaar_no);
                $("#editgender").val(gender);
                $("#editemail").val(email);
                $("#editdob").val(date_of_birth);
                $("#editaddress").val(address);
                $("#editstatus").val(status);
                $("#cusid").val(id);
                $("#editcustomer").modal("show");
            }
        </script>
    @endpush

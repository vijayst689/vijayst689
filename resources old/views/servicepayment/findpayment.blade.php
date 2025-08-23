@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Payment Details</div>
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
                    <form class="row g-4" action="{{ url('/addfind_payment') }}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }}
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Service Name</th>
                                    <th>Admin</th>
                                    <th>Distributor</th>
                                    <th>Retailer</th>
                                    <th>Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key => $ser)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $ser->name }}</td>
                                        <td><input class="form-control decimal"
                                            value="{{ $ser->amount }}" readonly /></td>
                                        <input name="parent_id[]" type="hidden" value="1" />
                                        <input name="service_id[]" type="hidden" value="{{ $ser->id }}" />
                                        @if (count($ser->payment) > 0)
                                            @foreach ($ser->payment as $key1 => $payment)
                                                <td><input class="form-control decimal"
                                                        name="distributor_amount[]" type="text"
                                                        maxlength="6"
                                                        value="{{ $payment->distributor_amount }}" /></td>
                                                <td><input class="form-control decimal" name="retailer_amount[]"
                                                        type="text" maxlength="6"
                                                        value="{{ $payment->retailer_amount }}" /></td>
                                                <td><input class="form-control decimal" name="customer_amount[]"
                                                        type="text" maxlength="6"
                                                        value="{{ $payment->customer_amount }}" /></td>
                                            @endforeach
                                        @else
                                            <td><input class="form-control decimal" name="distributor_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                            <td><input class="form-control decimal" name="retailer_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                            <td><input class="form-control decimal" name="customer_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                        @endif
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                      </div>
                     </div>
                    </div>
                    <div class="text-center">
                        <div class="col-12">
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
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

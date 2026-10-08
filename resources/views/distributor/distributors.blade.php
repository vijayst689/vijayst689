@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Distributors</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Wallet</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($distributors as $key => $dis)
                                    <tr>
                                        <td>D{{ $dis->id }}</td>
                                        <td>
                                            <a class="d-flex align-items-center gap-3" href="{{ url('profile') }}">
                                                <div class="customer-pic">
                                                    <img src="/upload/distributor/{{ $dis->profile }}"
                                                        class="rounded-circle" width="30" height="30" alt="">
                                                </div>
                                                <p class="mb-0 customer-name fw-bold">{{ $dis->name }}</p>
                                            </a>
                                        </td>
                                        <td>{{ $dis->phone }}</td>
                                        <td class="text-danger">{{ $dis->wallet }}</td>
                                        <td>{{ $dis->status }}</td>
                                        <td>{{ $dis->email }}</td>
                                        <td>{{ $dis->cpassword }}</td>
                                        <td style="white-space: nowrap">

                                            @if (Auth::user()->user_type_id == 2)
                                                <button
                                                    onclick="edit_distributor('{{ $dis->id }}','{{ $dis->name }}','{{ $dis->phone }}','{{ $dis->aadhaar_no }}','{{ $dis->gender }}','{{ $dis->email }}','{{ $dis->date_of_birth }}','{{ $dis->address }}','{{ $dis->dist_id }}','{{ $dis->taluk_id }}','{{ $dis->panchayath_id }}')"
                                                    type="button" class="btn-sm btn btn-primary">Edit</button>

                                                <button
                                                    onclick="edit_status('{{ $dis->id }}','{{ $dis->status }}','{{ $dis->user_type_id }}')"
                                                    type="button" class="btn-sm btn btn-success">Update</button>

                                                @if ($dis->verified == '')
                                                    <a href="{{ url('/nalavariyam_permission', $dis->id) }}" type="button"
                                                        style="font-size: small" class="btn-sm btn btn-info">Ramji</a>
                                                @else
                                                    <a type="button" style="font-size: small"
                                                        class="btn-sm btn btn-success">Verified</a>
                                                @endif
                                            @endif
                                            
                                            @if (Auth::user()->user_type_id == 5)
                                                <a href="{{ url('/service', $dis->id) }}"
                                                    class="btn-sm btn btn-warning">Service</a>

                                                <a href="{{ url('/documents', $dis->id) }}"
                                                    class="btn-sm btn btn-success">Document</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="editdistributor">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Distributors</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updatedistributor') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="distributor_id" id="dist_id" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Name</label>
                                                <input name="name" type="text" maxlength="30" class="form-control"
                                                    id="editname" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="editphone" class="form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control number"
                                                    maxlength="10" id="editphone" placeholder="Phone">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="editemail" class="form-label">Email</label>
                                                    <input type="text" name="email" maxlength="50" class="form-control"
                                                        id="editemail" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="editadhar" class="form-label">Aadhaar No</label>
                                                    <input type="text" name="aadhaar_no" maxlength="12"
                                                        class="form-control number" id="editadhar" placeholder="Aadhaar No">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="editdob" class="form-label">DOB</label>
                                                    <input name="date_of_birth" type="date" maxlength="30"
                                                        class="form-control" id="editdob" placeholder="Date Of Birth">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="editgender" class="form-label">Gender</label>
                                                    <select type="text" class="form-control" maxlength="10"
                                                        id="editgender" name="gender">
                                                        <option>Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Profile</label>
                                                    <input type="file" maxlength="30" name="profile"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="editaddress" class="form-label">Address</label>
                                                    <textarea type="text" rows="2" name="address" class="form-control" id="editaddress"
                                                        placeholder="Address"></textarea>
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
        <div class="col-md-6">
            <div class="card-body">
                <div class="modal fade" id="statusup">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalform1">Distributor Active</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-1">
                                <div class="form-body">
                                    <form class="row g-3" action="{{ url('/distristatusupdate') }}" method="post"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="hidden" name="statusid" id="status_id" />
                                                <div class="mb-3">
                                                    <label for="editstatus" class="form-label">Status</label>
                                                    <select name="status" type="text" maxlength="8"
                                                        class="form-control" id="editstatus">
                                                        <option value="">Select</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="edittype" class="form-label">UserType</label>
                                                <select name="user_type_id" type="text" maxlength="8"
                                                    class="form-control" id="edittype">
                                                    <option value="">Select</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Distributor</option>
                                                </select>
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
    @endsection
    @push('page_scripts')
        <script>
            function edit_distributor(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status) {
                $("#editname").val(name);
                $("#editphone").val(phone);
                $("#editadhar").val(aadhaar_no);
                $("#editgender").val(gender);
                $("#editemail").val(email);
                $("#editdob").val(date_of_birth);
                $("#editaddress").val(address);
                $("#editstatus").val(status);
                $("#dist_id").val(id);
                $("#editdistributor").modal("show");
            }

            function edit_status(id, status, user_type_id) {
                $("#editstatus").val(status);
                $("#edittype").val(user_type_id);
                $("#status_id").val(id);
                $("#statusup").modal("show");
            }
        </script>
    @endpush

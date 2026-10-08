@extends('layouts.app')
@section('content')
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
                    <h5 class="card-title">Retaillers</h5>
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
                                @foreach ($viewretailers as $key => $cus)
                                    <tr>
                                        <td>R{{ $cus->id }}</td>
                                        <td>{{ $cus->name }}</td>
                                        <td>{{ $cus->phone }}</td>
                                        <td class="text-danger">{{ $cus->wallet }}</td>
                                        <td>{{ $cus->status }}</td>
                                        <td>{{ $cus->email }}</td>
                                        <td>{{ $cus->cpassword }}</td>
                                        <td style="white-space: nowrap">
                                            @php
                                                $address1 = $cus->address;
                                                $address1 = str_replace(PHP_EOL, ' ', $address1);
                                                $address1 = str_replace("\r\n", ' ', $address1);
                                                $address1 = str_replace("\n", ' ', $address1);
                                                $NEWLINE_RE = '/(\r\n)|\r|\n/';
                                                $address1 = preg_replace($NEWLINE_RE, ' ', $address1);
                                            @endphp

                                            @if (Auth::user()->user_type_id == 2)
                                                <button
                                                    onclick="edit_retailer('{{ $cus->id }}','{{ $cus->name }}','{{ $cus->phone }}','{{ $cus->aadhaar_no }}','{{ $cus->gender }}','{{ $cus->email }}','{{ $cus->date_of_birth }}','{{ $address1 }}','{{ $cus->status }}','{{ $cus->dist_id }}','{{ $cus->taluk_id }}','{{ $cus->panchayath_id }}')"
                                                    type="button" class="btn-sm btn btn-primary">Edit</button>
                                                <button
                                                    onclick="statusupdates('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->user_type_id }}')"
                                                    type="button" class="btn-sm btn btn-success">Update
                                                </button>
                                                @if ($cus->verified == '')
                                                    <a href="{{ url('/nalavariyam_permission', $cus->id) }}" type="button"
                                                        style="font-size: small" class="btn-sm btn btn-info">Ramji</a>
                                                @else
                                                    <a type="button" style="font-size: small"
                                                        class="btn-sm btn btn-success">Verified</a>
                                                @endif
                                            @endif

                                            {{-- @if (Auth::user()->user_type_id == 2)
                                                <button
                                                    onclick="edit_status('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->status }}')"
                                                    type="button" class="btn-sm btn btn-success">Pay</button>
                                            @endif --}}
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
            <div class="modal fade" id="editretailer">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Retailers</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updateretailer') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="retailerid" id="retailer_id" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Name</label>
                                                <input required name="name" type="text" maxlength="30"
                                                    class="form-control" id="editname" placeholder="Name">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editemail" class="form-label">Email</label>
                                                <input required type="text" name="email" maxlength="50"
                                                    class="form-control" id="editemail" placeholder="Email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editdob" class="form-label">DOB</label>
                                                <input required name="date_of_birth" type="date" maxlength="30"
                                                    class="form-control" id="editdob" placeholder="Date Of Birth">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Profile</label>
                                                <input required type="file" maxlength="30" name="profile"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="editphone" class="form-label">Phone</label>
                                                <input required type="text" name="phone" class="form-control number"
                                                    maxlength="10" id="editphone" placeholder="Phone">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editadhar" class="form-label">Aadhaar No</label>
                                                <input required type="text" name="aadhaar_no" maxlength="12"
                                                    class="form-control number" id="editadhar" placeholder="Aadhaar No">
                                            </div>
                                            <div class="mb-3">
                                                <label for="editgender" class="form-label">Gender</label>
                                                <select required type="text" class="form-control" maxlength="10"
                                                    id="editgender" placeholder="Phone" name="gender">
                                                    <option>Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="editaddress" class="form-label">Address</label>
                                                    <textarea required type="text" rows="2" name="address" class="form-control" id="editaddress"
                                                        placeholder="Address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
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
            <div class="modal fade" id="statusupdate" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form method="post" class="row g-3" action="{{ url('/updatestatus') }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="request_id" id="request_id" />
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="editamount" class="form-label">Amount</label>
                                                    <input readonly type="text" id="amo" name="amount"
                                                        class="form-control number" maxlength="5" value="2500"
                                                        placeholder="Amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center mb-3">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" id="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
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
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="edittype" class="form-label">UserType</label>
                                                <select name="user_type_id" type="text" maxlength="8"
                                                    class="form-control" id="edittype">
                                                    <option value="">Select</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Distributor</option>
                                                    <option value="4">Retailler</option>
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
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = $("#amo").val();
            $(function() {
                if (parseFloat(amount) > parseInt(wallet)) {
                    $('#save').prop("disabled", true);
                    $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                        'color': 'red',
                        'font-size': '150%',
                        'font-weight': 'bold'
                    });
                }
            });

            function edit_retailer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status,
                dist_id, taluk_id, panchayath_id) {
                $("#editname").val(name);
                $("#editphone").val(phone);
                $("#editadhar").val(aadhaar_no);
                $("#editgender").val(gender);
                $("#editemail").val(email);
                $("#editdob").val(date_of_birth);
                $("#editaddress").val(address);
                $("#dist_id").val(dist_id);
                $("#retailer_id").val(id);
                $("#editretailer").modal("show");
            }

            function edit_status(id, status) {
                $("#upstatus").val(status);
                $("#request_id").val(id);
                $("#statusupdate").modal("show");
            }

            function statusupdates(id, status, user_type_id) {
                $("#editstatusupdate").val(status);
                $("#edittype").val(user_type_id);
                $("#status_id").val(id);
                $("#statusup").modal("show");
            }
        </script>
    @endpush

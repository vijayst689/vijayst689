@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn-sm btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addcustomer">Add</button>
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
                    <h5 class="card-title">Member</h5>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Full Name</th>
                                    <th> District</th>
                                    <th> Mobile Number</th>
                                    <th> Aadhar Number</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $key => $m)
                                    <tr>
                                        <td>{{ $m->id }}</td>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->district_name }}</td>
                                        <td>{{ $m->phone }}</td>
                                        <td>{{ $m->aadhaar_no }}</td>
                                        <td>{{ $m->status }}</td>
                                        <td>
                                            {{-- <button
                                            onclick="edit_retailer('{{ $m->id }}','{{ $m->name }}','{{ $m->phone }}','{{ $m->aadhaar_no }}','{{ $m->status }}')"
                                            type="button" class="btn-sm btn btn-primary">Edit</button> --}}

                                            <a class="btn btn-primary" href="{{ url('/online_services', $m->id) }}"><i
                                                    class="fas fa-arrow-circle-right"></i>Services</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ url('/addnalavariyam_member') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select required name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($district as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select required name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="name" placeholder="Full Name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                    <input required onkeyup="nalavariyam_duplicateaadhar(0)" type="text"
                                                        class="form-control number" name="aadhaar_no" id="aadhaar_no"
                                                        maxlength="12" placeholder="Aadhaar Number" />
                                                    <span id="dupaadhar" style="color:red"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input required onkeyup="nalavariyam_duplicatephone(0)" type="text"
                                                        class="form-control number" name="phone" id="phone"
                                                        maxlength="10" placeholder="Phone" />
                                                    <span id="dupphone" style="color:red"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="save" type="submit" class="btn btn-primary">Submit</button>
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

            $('#dist_id').on('change', function() {
                var dist_id = this.value;
                $("#taluk").html('');
                var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                        $.each(result, function(key, value) {
                            $("#taluk").append('<option value="' + value
                                .id + '">' + value.taluk_name + '</option>');
                        });
                        $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                    }
                });
            });


            function nalavariyam_duplicateaadhar(id) {
                var aadhaar_no = $("#aadhaar_no").val().trim();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "post",
                    url: '{{ url('nalavariyam_checkaadhar') }}',
                    data: {
                        id: id,
                        aadhaar_no: aadhaar_no,
                        _token: _token
                    },

                    success: function(res) {
                        console.log(res);
                        if (res.exists) {
                            $("#save").prop('disabled', true);
                            $("#dupaadhar").html("aadhar no alredy exists!");
                        } else {
                            $("#dupaadhar").html("");
                        }
                        if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                            $("#save").prop('disabled', false);
                        } else {
                            $("#save").prop('disabled', true);
                        }
                    },
                    error: function(jqXHR, exception) {
                        console.log(exception);
                    }
                });
            }

            function nalavariyam_duplicatephone(id) {
                var phone = $("#phone").val().trim();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "post",
                    url: '{{ url('nalavariyam_checkphone') }}',
                    data: {
                        id: id,
                        phone: phone,
                        _token: _token
                    },

                    success: function(res) {
                        if (res.exists) {
                            $("#save").prop('disabled', true);
                            $("#dupphone").html("mobile no alredy exists!");
                        } else {
                            $("#dupphone").html("");
                        }
                        if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                            $("#save").prop('disabled', false);
                        } else {
                            $("#save").prop('disabled', true);
                        }
                    },

                    error: function(jqXHR, exception) {
                        console.log(exception);
                    }
                });
            }
        </script>
    @endpush

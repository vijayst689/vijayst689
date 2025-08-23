@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            </div>
            <div class="row g-3">

                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <button type="button" class="btn btn-grd-primary px-2" data-bs-toggle="modal"
                        data-bs-target="#addcustomer">Add</button>
                </div>
            </div><!--end row-->
              <h4 class="">Member Details
                </h4>
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
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> Id</th>
                                    <th> District</th>
                                    <th> Full Name</th>
                                    <th> Phone</th>
                                    <th> Status</th>
                                    @if (Auth::user()->user_type_id == 1)
                                        <th> Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nalavariyam_customer as $key => $service)
                                    <tr>
                                        <td>{{ $service->id }}</td>
                                        <td>{{ $service->district_name }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->phone }}</td>
                                        <td>{{ $service->status }}</td>
                                        @if (Auth::user()->user_type_id == 1)
                                            <td>
                                                <a class="btn btn-sm btn-primary" onclick="show_purchase_modal()"
                                                    href="{{ url('/nalavariyam_services') }}"><i
                                                        class="fas fa-arrow-circle-right"></i>Services</a>
                                            </td>
                                        @endif
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
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Full Name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                    <input required type="text" class="form-control number"
                                                        name="aadhaar_no" placeholder="Aadhaar Number" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Phone</label>
                                                    <input required type="text" class="form-control number"
                                                        name="phone" placeholder="Phone" />
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
    </main>
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
            var url = "{{ url('service/get_taluk') }}/" + dist_id;
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

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
@endpush

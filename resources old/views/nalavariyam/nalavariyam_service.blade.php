@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row g-3">
                @if (Auth::user()->user_type_id == 1)
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <button type="button" class="btn btn-grd-primary px-2" data-bs-toggle="modal"
                            data-bs-target="#addservice">Add</button>
                    </div>
                @endif
            </div><!--end row-->
             <h4 class="">Service
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
                                    <th> S No</th>
                                    <th> Service Name</th>
                                    @if (Auth::user()->user_type_id == 1)
                                        <th> Status</th>
                                        <th> Edit</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nalavariyam_service as $key => $service)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $service->service_name }}</td>

                                        @if (Auth::user()->user_type_id == 1)
                                            <td>{{ $service->status }}</td>
                                            <td>
                                                <a href="{{ url('editnalavariyam_service', $service->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fa fa-edit"title="Edit"></i>
                                                    Edit</a>
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
                <div class="modal fade" id="addservice" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Services</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/addnalavariyam_service') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="service_name">Service Name</label>
                                                    <input type="text" required="required" class="form-control"
                                                        name="service_name" id="service_name"
                                                        placeholder="Enter Service Name">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Service Type</label>
                                                        <select class="form-control select2" name="servicetype"
                                                            id="service_type" required="required" style="width: 100%;">
                                                            <option value="">Select Service Type</option>
                                                            <option value="1">Normal</option>
                                                            <option value="2">Scholarship</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="service_payment">Service Payment"</label>
                                                            <input required="required" type="text"
                                                                class="form-control number" name="service_payment"
                                                                id="service_payment" placeholder="Enter Service Payment">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="datehidden">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="full_name">From Date</label>
                                                            <input type="date" class="form-control" name="from_date"
                                                                id="from_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>To Date</label>
                                                            <input type="date" class="form-control" name="to_date"
                                                                id="to_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="user_photo">புகைப்படம்</label>
                                                    <div class="input-group">
                                                        <input type="file" class="custom-file-input" name="from_image"
                                                            id="from_image" autocomplete="off">
                                                        <label class="custom-file-label" for="from_image">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <table id="example2" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th> S No</th>
                                                            <th> District Name</th>
                                                            <th> Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($district as $key => $districtlist)
                                                            <tr>
                                                                <td>{{ $districtlist->id }}
                                                                    <input type="hidden" name="dist_id[]"
                                                                        value="{{ $districtlist->id }}">
                                                                </td>
                                                                <td>{{ $districtlist->district_name }}</td>
                                                                <td>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                            name="check_{{ $districtlist->id }}"
                                                                            value="2">
                                                                        Offline
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $service->service_payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });

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

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
                    <h5 class="card-title">Wallet Details</h5>
                    <div class="col-auto mb-2">
                        @if ( Auth::user()->user_type_id == 2 )
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#ramjirequest">Add Money</button>
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Date Time</th>
                                    <th>From ID</th>
                                    <th>To ID</th>
                                    <th>Title</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raviewamount as $key => $am)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $am->paydate }}&nbsp;{{ $am->time }}</td>
                                        <td>{{ $am->from_id }}</td>
                                        <td>{{ $am->to_id }}</td>
                                        <td>{{ $am->ad_info }}</td>
                                        @if ($am->service_status == 'Out Payment')
                                            <td class="text-danger">- {{ $am->amount }}</td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td class="text-success">+ {{ $am->amount }}</td>
                                        @endif
                                        <td>{{ $am->service_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td>{{ Auth::user()->rawallet }}</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="addmoney" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="row g-3" action="{{ url('/adminaddwallet') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="wallet" maxlength="6" type="text" class="form-control"
                                    placeholder="Amount">
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
            <div class="modal fade" id="ramjirequest" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Ramji Wallet Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="form-body">
                            <form method="post" class="row g-3" action="{{ url('/ramjisaverequest') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="/upload/qr/qrimgramji.jpeg" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Amount</label>
                                            <input name="amount" type="text" maxlength="6" class="form-control number"
                                                placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Paid Image (Screen)</label>
                                            <input type="file" name="req_image" class="form-control" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="Submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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

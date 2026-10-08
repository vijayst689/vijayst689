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
                    <form class="row g-3" action="{{ url('/addsubservice') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="service_id" value="{{ $id }}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input class="form-control" readonly type="text" maxlength="70"
                                        value="{{ $servicename }}" placeholder="Service Name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if (Auth::user()->user_type_id == 1)
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sub Service Name</label>
                                        <input class="form-control" type="text" name="service_name" maxlength="100"
                                            autofocus placeholder="Service Name" />
                                    </div>
                                @endif
                                @if (Auth::user()->user_type_id == 2)
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sub Service Name</label>
                                        <input readonly class="form-control" type="text" name="service_name"
                                            maxlength="100" autofocus placeholder="Service Name" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if (Auth::user()->user_type_id == 1)
                                    <div class="mb-3">
                                        <label for="" class="form-label">Amount</label>
                                        <input class="form-control number" type="text" name="amount" maxlength="5"
                                            placeholder="Amount" />
                                    </div>
                                @endif
                                @if (Auth::user()->user_type_id == 2)
                                    <div class="mb-3">
                                        <label for="" class="form-label">Amount</label>
                                        <input readonly class="form-control number" type="text" name="amount"
                                            maxlength="5" placeholder="Amount" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="col-md-12">
                                @if (Auth::user()->user_type_id == 1)
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                @endif
                            </div>
                    </form>
                </div>
                <h5 class="card-title">All Services</h5>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>SubSevice Name</th>
                                <th>SubSevice Image</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service as $key => $ser)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ser->service_name }}</td>
                                    <td>
                                        <div class="customer-pic">
                                            <img src="/upload/sub_service/{{ $ser->sub_service_image }}"
                                                class="rounded-circle" width="30" height="30" alt="">
                                        </div>
                                    </td>
                                    <td>{{ $ser->status }}</td>
                                    <td>{{ $ser->amount }}</td>
                                    <td style="white-space: nowrap">
                                        <button
                                            onclick="edit_service('{{ $ser->id }}','{{ $ser->service_name }}','{{ $ser->status }}','{{ $ser->amount }}','{{ $ser->ramjiservice_id }}')"
                                            type="button" class="btn-sm btn btn-primary">Edit</button>
                                        @if (Auth::user()->user_type_id == 1)
                                            <a onclick="return confirm('Do you want to confirm delete subservice!?')"
                                                href="{{ url('/dropsubservice', $ser->id) }}" type="button"
                                                class="btn-sm btn btn-danger">Drop</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="editser">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Edit SubServices</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updatesubservice') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <input type="hidden" name="service_id" id="serviceid" />
                                        {{-- Left Side --}}
                                        <div class="col-md-6">

                                            @if (Auth::user()->user_type_id == 1)
                                                <div class="mb-3">
                                                    <label for="editname" class="form-label">SubService Name</label>
                                                    <input name="service_name" type="text" maxlength="100"
                                                        class="form-control" id="editname"
                                                        placeholder="SubService Name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="sub_service_image" class="form-label">Sub Service
                                                        Image</label>
                                                    <input id="sub_service_image" class="form-control" type="file"
                                                        name="sub_service_image">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editam" class="form-label">Amount</label>
                                                    <input name="amount" maxlength="6" type="text"
                                                        class="form-control number" id="editam" placeholder="Amount">
                                                </div>
                                            @endif

                                            @if (Auth::user()->user_type_id == 2)
                                                <div class="mb-3">
                                                    <label for="editname" class="form-label">SubService Name</label>
                                                    <input readonly name="service_name" type="text" maxlength="100"
                                                        class="form-control" id="editname"
                                                        placeholder="SubService Name">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editam" class="form-label">Amount</label>
                                                    <input readonly name="amount" maxlength="6" type="text"
                                                        class="form-control number" id="editam" placeholder="Amount">
                                                </div>
                                            @endif

                                        </div>

                                        {{-- Right Side --}}
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="editstatus" class="form-label">Status</label>
                                                <select name="status" class="form-control" id="editstatus">
                                                    <option value="">Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="software" class="form-label">Software</label>
                                                <input id="software" class="form-control" type="file"
                                                    name="software">
                                            </div>

                                            @if (Auth::user()->user_type_id == 1)
                                                <div class="mb-3">
                                                    <label for="ramjiservice_id" class="form-label">Service ID</label>
                                                    <input name="ramjiservice_id" maxlength="5" type="text"
                                                        class="form-control number" id="ramjiservice_id"
                                                        placeholder="Ramji Service ID">
                                                </div>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
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
                function edit_service(id, service_name, status, amount, ramjiservice_id) {
                    $("#editname").val(service_name);
                    $("#editstatus").val(status);
                    $("#editam").val(amount);
                    $("#serviceid").val(id);
                    $("#ramjiservice_id").val(ramjiservice_id);
                    $("#editser").modal("show");
                }
            </script>
        @endpush

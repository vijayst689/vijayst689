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
                    <div class="btn-group">
                     @if (Auth::user()->user_type_id == 1)
                            <a href="{{ url('/service') }}" class="btn btn-primary"><i class="bi bi-chat me-2"></i>Add
                                Service</a>
                        @endif
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
                    <form action="{{ url('/addsubservice') }}" id="formAccountSettings" method="POST"
                        enctype="multipart/form-data" class="mb-3">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" name="service_id" value="{{ $id }}">
                            <div class="col-md-6">
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
                        <div class="mt-2 text-center">
                            @if (Auth::user()->user_type_id == 1)
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                            @endif
                        </div>
                    </form>
                   <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>SubSevice Name</th>
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
                                            <td>{{ $ser->status }}</td>
                                            <td>{{ $ser->amount }}</td>
                                            <td style="white-space: nowrap">
                                                <button
                                                    onclick="edit_service('{{ $ser->id }}','{{ $ser->service_name }}','{{ $ser->status }}','{{ $ser->amount }}')"
                                                    ype="button" style="font-size: small"
                                                    class="btn btn-primary">Edit</button>

                                                @if (Auth::user()->user_type_id == 1)
                                                    <a onclick="return confirm('Do you want to confirm delete service?')"
                                                        href="{{ url('/dropsubservice', $ser->id) }}" type="button"
                                                        style="font-size: small"
                                                        class="btn btn-danger">Drop</a>
                                                @endif
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    <div class="col-12">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="">
                                    <div class="modal fade" id="editser">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                                    <h5 class="modal-title">Update SubService</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <form class="row g-3" action="{{ url('/updatesubservice') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <input type="hidden" name="service_id" id="serviceid" />
                                                                <div class="col-md-6">
                                                                    @if (Auth::user()->user_type_id == 1)
                                                                        <div class="mb-3">
                                                                            <label for="editname"
                                                                                class="form-label">SubService Name</label>
                                                                            <input name="service_name" type="text"
                                                                                maxlength="100" class="form-control"
                                                                                id="editname"
                                                                                placeholder="SubService Name">
                                                                        </div>
                                                                        <label for="editam"
                                                                            class="form-label">Amount</label>
                                                                        <input name="amount" maxlength="6"
                                                                            type="text" class="form-control number"
                                                                            id="editam" placeholder="Amount">
                                                                    @endif
                                                                    @if (Auth::user()->user_type_id == 2)
                                                                        <div class="mb-3">
                                                                            <label for="editname"
                                                                                class="form-label">SubService Name</label>
                                                                            <input readonly name="service_name"
                                                                                type="text" maxlength="100"
                                                                                class="form-control" id="editname"
                                                                                placeholder="SubService Name">
                                                                        </div>
                                                                        <label for="editam"
                                                                            class="form-label">Amount</label>
                                                                        <input readonly name="amount" maxlength="6"
                                                                            type="text" class="form-control number"
                                                                            id="editam" placeholder="Amount">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="editstatus"
                                                                            class="form-label">Status</label>
                                                                        <select type="text" name="status"
                                                                            class="form-control" maxlength="10"
                                                                            id="editstatus" placeholder="Status">
                                                                            <option value="">Select</option>
                                                                            <option value="Active">Active</option>
                                                                            <option value="Inactive">Inactive</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label>Software</label>
                                                                        <input class="form-control" type="file"
                                                                            name="software">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                    </div>
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
        function edit_service(id, service_name, status, amount) {
            $("#editname").val(service_name);
            $("#editstatus").val(status);
            $("#editam").val(amount);
            $("#serviceid").val(id);
            $("#editser").modal("show");
        }
    </script>
@endpush

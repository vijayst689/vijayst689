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
                        <a href="{{ url('/addutilityservice') }}" type="button" class="btn btn-info">Add Operator</a>
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
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Service_type</th>
                                    <th>Commission</th>
                                    <th>Admin Comission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operator as $key => $o)
                                    <tr>
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->code }}</td>
                                        <td>{{ $o->name }}</td>
                                        <td>{{ $o->service_type }}</td>
                                        <td>{{ $o->commission }}</td>
                                        <td>{{ $o->admin_commission }}</td>
                                        <td>
                                            <button
                                                onclick="edit_operator('{{ $o->id }}','{{ $o->code }}','{{ $o->service_type }}','{{ $o->name }}','{{ $o->commission }}','{{ $o->admin_commission }}')"
                                                ype="button" style="font-size: small"
                                                class="btn btn-primary">Edit</button>

                                            <a onclick="return confirm('Do you want to confirm delete operator?')"
                                                href="{{ url('/deleteoperator', $o->id) }}" type="button"
                                                style="font-size: small" class="btn btn-danger">Drop</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card rounded-4">
                <div class="">
                    <div class="modal fade" id="editoper">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <h5 class="modal-title">Update Operators</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ url('/updateoperator') }}" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-md-6">
                                                <input type="hidden" name="opr_id" id="opr_id" />
                                                <label for="editcode" class="form-label">Code</label>
                                                <input name="code" maxlength="10" type="text" class="form-control"
                                                    id="editcode" placeholder="Code">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="edittype" class="form-label">Service Type</label>
                                                <select id="edittype" class="form-control" name="service_type">
                                                    <option value="">Select Service Type</option>
                                                    <option value="1">Mobile Prepaid</option>
                                                    <option value="2">DTH</option>
                                                    <option value="3">Fastag</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editname" class="form-label">Operator Name</label>
                                                <input type="text" class="form-control" id="editname" name="name"
                                                    maxlength="10" placeholder="Operator Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editcom" class="form-label">Commission</label>
                                                <input type="text" name="commission" class="form-control" maxlength="5"
                                                    id="editcom" placeholder="Commission">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="editadmin" class="form-label">Admin Commission</label>
                                                <input type="text" name="admin_commission" class="form-control"
                                                    id="editadmin" maxlength="5" placeholder="Admin Commission">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
@push('page_scripts')
    <script>
        function edit_operator(id, code, service_type, name, commission, admin_commission) {
            $("#editcode").val(code);
            $("#edittype").val(service_type);
            $("#editname").val(name);
            $("#editcom").val(commission);
            $("#editadmin").val(admin_commission);
            $("#opr_id").val(id);
            $("#editoper").modal("show");
        }
    </script>
@endpush

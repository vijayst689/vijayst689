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
                    <h2 class="card-title">Operators</h2>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
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
                                                    class="btn-sm btn btn-primary">Edit</button>

                                                <a onclick="return confirm('Do you want to confirm delete operator?')"
                                                    href="{{ url('/deleteoperator', $o->id) }}" type="button"
                                                    style="font-size: small" class="btn btn-inverse-danger px-1">Drop</a>
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
            <div class="modal fade" id="editoper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Operators</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
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
                                        <input type="text" name="admin_commission" class="form-control" id="editadmin"
                                            maxlength="5" placeholder="Admin Commission">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">
                                            Close
                                        </button>
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


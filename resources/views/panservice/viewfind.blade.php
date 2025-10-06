@extends('layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Srirengainfotech.in</div>
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
                    <a href="{{ url('/addfindservice') }}" type="button" class="btn btn-info">Add Find</a>
                </div>
            </div>
        </div>
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
                    <table id="" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Sl No</th>
                                <th>Service Name</th>
                                <th>Image</th>
                                <th>Charges</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-dark">
                            @foreach ($find as $key => $f)
                            <tr class="text-white">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $f->name }}</td>
                                <td><img src="/upload/find_service/{{ $f->ser_image }}" class="rounded-circle"
                                        width="40" height="40" alt=""></td>
                                <td>{{ $f->amount }}</td>
                                <td> <a class="btn btn-sm btn-danger text-white"><i
                                            class='bx bx-btn'></i>{{ $f->status }}</a>
                                    <button
                                        onclick="edit_service('{{ $f->id }}','{{ $f->name }}','{{ $f->amount }}','{{ $f->ramjiservice_id }}')"
                                        type="button" style="font-size: small"
                                        class="btn btn-primary">Edit</button>

                                    <button onclick="editstatus('{{ $f->id }}','{{ $f->status }}')"
                                        type="button" style="font-size: small" class="btn btn-success">Status
                                        Update</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
                                                <h5 class="modal-title">Update FindService</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <form class="modal-content" action="{{ url('/updatefind') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" name="findid" id="findid">
                                                                <div class="col mb-3">
                                                                    <label for="name" class="form-label">FindService
                                                                        Name</label>
                                                                    <input type="text" id="editservice"
                                                                        name="name" class="form-control"
                                                                        placeholder="FindService Name" />
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label for="amount"
                                                                        class="form-label">Amount</label>
                                                                    <input type="text" id="editamount" name="amount"
                                                                        class="form-control number" maxlength="5"
                                                                        placeholder="Amount" />
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label for="amount"
                                                                        class="form-label">Service ID</label>
                                                                    <input type="text" id="ramjiservice_id" name="ramjiservice_id"
                                                                        class="form-control number" maxlength="5"
                                                                        placeholder="Service ID" />
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="ser_image" class="form-label">Service
                                                                        Image</label>
                                                                    <input type="file" name="ser_image"
                                                                        class="form-control" maxlength="5" />
                                                                </div>
                                                            </div>
                                                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card rounded-4">
            <div class="card-body">
                <div class="">
                    <div class="modal fade" id="editfind">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <h5 class="modal-title">Status Update</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="modal-content" action="{{ url('/updatestatusfind') }}"
                                            method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="row">
                                                    <input type="hidden" name="statusid" id="statusid">
                                                    <div class="col mb-3">
                                                        <label for="name" class="form-label">Status</label>
                                                        <select type="text" id="editsta" name="status"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
            </div>
        </div>
    </div>
    @endsection
    @push('page_scripts')
    <script>
        function edit_service(id, name, amount, ramjiservice_id) {
            $("#editservice").val(name);
            $("#editamount").val(amount);
            $("#findid").val(id);
            $("#ramjiservice_id").val(ramjiservice_id);
            $("#editser").modal("show");
        }

        function editstatus(id, status) {
            $("#editsta").val(status);
            $("#statusid").val(id);
            $("#editfind").modal("show");
        }
    </script>
    @endpush
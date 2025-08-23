@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a href="{{ url('/addcan') }}" class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>ADD
                        CAN</a>
                </div>
            </div>
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                                <thead>
                                    <tr class="text-white">
                                        <th>Sl No</th>
                                        <th>Service Name</th>
                                        <th>Charges</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewcan as $key => $c)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->amount }}</td>
                                            <td>{{ $c->status }}</td>
                                            <td><img src="/upload/canservice/{{ $c->ser_image }}" class="rounded-circle"
                                                    width="40" height="40" alt=""></td>
                                            <td>
                                                <button
                                                    onclick="edit_can('{{ $c->id }}','{{ $c->name }}','{{ $c->amount }}')"
                                                    type="button" class="btn-sm btn btn-primary">Edit</button>

                                                <button
                                                    onclick="statusupdate('{{ $c->id }}','{{ $c->status }}')"
                                                    type="button" class="btn-sm btn btn-success">Status</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="modal fade" id="editcan">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update
                                                Canservice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body mt-1">
                                            <div class="form-body">
                                                <form class="modal-content" action="{{ url('/updatecan') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <input type="hidden" name="canid" id="canid">
                                                            <div class="col mb-3">
                                                                <label for="name" class="form-label">Service
                                                                    Name</label>
                                                                <input type="text" id="editservice" name="name"
                                                                    class="form-control" placeholder="Service Name" />
                                                            </div>
                                                            <div class="col mb-3">
                                                                <label for="amount" class="form-label">Amount</label>
                                                                <input type="text" id="editamount" name="amount"
                                                                    class="form-control number" maxlength="5"
                                                                    placeholder="Amount" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="ser_image" class="form-label">Service
                                                                    Image</label>
                                                                <input type="file" name="ser_image" class="form-control"
                                                                    maxlength="5" />
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
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="modal fade" id="editup">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title align-self-center" id="exampleModalform1">Status
                                                    Update</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mt-1">
                                                <div class="form-body">
                                                    <form class="modal-content" action="{{ url('/canupdatestatus') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" name="statusid" id="statusid">
                                                                <div class="col mb-3">
                                                                    <label for="name"
                                                                        class="form-label">Status</label>
                                                                    <select id="editsta"name="status"
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
    </main>
@endsection
@push('page_scripts')
    <script>
        function edit_can(id, name, amount, status, ) {
            $("#editservice").val(name);
            $("#editamount").val(amount);
            $("#editstatus").val(status);
            $("#canid").val(id);
            $("#editcan").modal("show");
        }

        function statusupdate(id, status) {
            $("#editsta").val(status);
            $("#statusid").val(id);
            $("#editup").modal("show");
        }
    </script>
@endpush

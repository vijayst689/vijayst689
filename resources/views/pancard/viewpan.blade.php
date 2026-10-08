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
                    <h2 class="card-title">Pan Services</h2>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Service Name</th>
                                    <th>Amount</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($viewpan as $key => $p)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->amount }}</td>
                                        <td><img src="/upload/panservice/{{ $p->ser_image }}" class="rounded-circle"
                                                width="40" height="40" alt=""></td>
                                        <td> <a class="btn btn-sm btn-danger text-white"><i
                                                    class='bx bx-btn'></i>{{ $p->status }}</a>

                                            <button
                                                onclick="edit_pan('{{ $p->id }}','{{ $p->name }}','{{ $p->amount }}','{{ $p->ramjiservice_id }}')"
                                                type="button" class="btn-sm btn btn-primary">Edit</button>
                                            <button
                                                    onclick="statusupdate('{{ $p->id }}','{{ $p->status }}')"
                                                    type="button" style="font-size: small"
                                                    class="btn-sm btn btn-success">Status Update</button>
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
            <div class="modal fade" id="editpan">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update PanServices</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="modal-content" action="{{ url('/updatepan') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <input type="hidden" name="panid" id="panid">
                                            <div class="col mb-3">
                                                <label for="name" class="form-label">PanService
                                                    Name</label>
                                                <input type="text" id="editservice" name="name" class="form-control"
                                                    placeholder="PanService Name" />
                                            </div>
                                            <div class="col mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="text" id="editamount" name="amount"
                                                    class="form-control number" placeholder="Amount" />
                                            </div>
                                            <div class="col mb-3">
                                                <label for="ser_image" class="form-label">Service
                                                    Image</label>
                                                <input type="file" name="ser_image" class="form-control"
                                                    maxlength="5" />
                                            </div>
                                            
                                        </div>
                                        <div class="col mb-3">
                                                <label for="amount"
                                                    class="form-label">Service ID</label>
                                            <input type="text" id="ramjiservice_id" name="ramjiservice_id"
                                                    class="form-control number" maxlength="5"
                                                    placeholder="Service ID" />
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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
            function edit_pan(id, name, amount, ramjiservice_id) {
                $("#editservice").val(name);
                $("#editamount").val(amount);
                $("#panid").val(id);
                $("#ramjiservice_id").val(ramjiservice_id);
                $("#editpan").modal("show");
            }

            function editstatus(id, status) {
                $("#editsta").val(status);
                $("#pan_id").val(id);
                $("#editsta").modal("show");
            }
        </script>
    @endpush

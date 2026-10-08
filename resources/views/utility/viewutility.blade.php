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
                    <h2 class="card-title">Utility Services</h2>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Service Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($utility as $key => $u)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td><img src="/upload/uti_image/{{ $u->ser_image }}" class="rounded-circle"
                                                width="40" height="40" alt=""></td>
                                            <td> <a class="btn btn-sm btn-danger text-white"><i
                                                        class='bx bx-btn'></i>{{ $u->status }}</a>
                                                <button
                                                    onclick="edit_service('{{ $u->id }}','{{ $u->name }}')"
                                                    type="button" style="font-size: small"
                                                    class="btn-sm btn btn-primary">Edit</button>

                                                {{-- <button
                                                    onclick="statusupdate('{{ $u->id }}','{{ $u->status }}')"
                                                    type="button" style="font-size: small"
                                                    class="btn-sm btn btn-success">Status Update</button> --}}

                                                <a href="{{ url('/operator', $u->id) }}"
                                                     style="font-size: small"
                                                    class="btn-sm btn btn-primary">Operator</button>
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
            <div class="modal fade" id="editser">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update UtilityService</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="modal-content" action="{{ url('/updateutility') }}"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="utilityid" id="utilityid">
                                        <div class="col mb-3">
                                            <label for="name" class="form-label">UtilityService
                                                Name</label>
                                            <input type="text" id="editservice"
                                                name="name" class="form-control"
                                                placeholder="UtilityService Name" />
                                        </div>
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
    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="editup">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Status Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="modal-content" action="{{ url('/updatestatusuti') }}"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="utiid" id="utiid">
                                        <div class="col mb-3">
                                            <label for="name" class="form-label">UtilityStatus</label>
                                            <select type="text" id="editsta"
                                                name="status" class="form-control">
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

@endsection
@push('page_scripts')
    <script>
    function edit_service(id, name, status, ) {
            $("#editservice").val(name);
            $("#editstatus").val(status);
            $("#utilityid").val(id);
            $("#editser").modal("show");
        }

   function statusupdate(id, status ) {
            $("#editsta").val(status);
            $("#statusid").val(id);
            $("#editup").modal("show");
        }
    </script>
@endpush


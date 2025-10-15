@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Requirement Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requirement as $key => $n)
                                    <tr>
                                        <td>{{ $n->id }}</td>
                                        <td class="card-title text-dark">{{ $n->requirement_name }}</td>
                                        <td class="card-title text-danger">{{ $n->status }}</td>
                                        <td>
                                            @if(Auth::user()->user_type_id == 2)
                                            <button onclick="edit_requirement('{{ $n->id }}','{{ $n->requirement_name }}','{{ $n->status }}')"
                                                type="button" class="btn-sm btn btn-primary">Edit</button>

                                            {{-- <a onclick="return confirm('Do you want to confirm delete notification!?')"
                                                href="{{ url('/dropnotification', $n->id) }}" type="button"
                                                class="btn-sm btn btn-danger">Drop</a> --}}
                                            @endif
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
            <div class="modal fade" id="editrequir">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Requirement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updaterequirement') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="require_id" id="require_id" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Requirement Name</label>
                                                <input required name="requirement_name" type="text" maxlength="200" class="form-control" id="editrequirename"
                                                    placeholder="Content">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
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
        function edit_requirement(id, requirement_name) {
            $("#editrequirename").val(requirement_name);
            $("#require_id").val(id);
            $("#editrequir").modal("show");
        }

        function edit_status(id, status) {
            $("#upstatus").val(status);
            $("#status_id").val(id);
            $("#statusupdate").modal("show");
        }
    </script>
@endpush

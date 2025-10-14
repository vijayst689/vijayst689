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
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Requirement</th>
                                    <th>Username</th>
                                    {{-- @if(Auth::user()->user_type_id == 2)
                                    <th>Action</th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enquiry as $key => $n)
                                    <tr>
                                        <td>{{ $n->id }}</td>
                                        <td class="card-title text-dark">{{ $n->name }}</td>
                                        <td class="card-title text-info">{{ $n->mobile }}</td>
                                        <td class="card-title text-success">{{ $n->email }}</td>
                                        <td class="card-title text-primary">{{ $n->requirement }}</td>
                                        <td class="card-title text-danger">{{ $n->user_name }}</td>
                                        {{-- <td>
                                            @php
                                                $enquiry1 = $n->enquiry;
                                                $enquiry1 = str_replace(PHP_EOL, ' ', $enquiry1);
                                                $enquiry1 = str_replace("\r\n", ' ', $enquiry1);
                                                $enquiry1 = str_replace("\n", ' ', $enquiry1);
                                                $NEWLINE_RE = '/(\r\n)|\r|\n/';
                                                $enquiry1 = preg_replace($NEWLINE_RE, ' ', $enquiry1);
                                            @endphp
                                            @if(Auth::user()->user_type_id == 2)
                                            <button onclick="edit_notify('{{ $n->id }}','{{ $enquiry1 }}')"
                                                type="button" class="btn-sm btn btn-primary">Edit</button>

                                            <a onclick="return confirm('Do you want to confirm delete notification!?')"
                                                href="{{ url('/dropnotification', $n->id) }}" type="button"
                                                class="btn-sm btn btn-danger">Drop</a>
                                            @endif
                                        </td> --}}
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
            <div class="modal fade" id="editnoti">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updatenotification') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="notify_id" id="notify_id" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Content</label>
                                                <textarea required name="notify" type="text" maxlength="1000" class="form-control" id="editnotify"
                                                    placeholder="Content"></textarea>
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

    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="statusupdate" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form method="post" class="row g-3" action="{{ url('/notificationstatusupdate') }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="status_id" id="status_id" />
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select type="text" id="upstatus" name="status"
                                                        class="form-control" placeholder="Status">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mb-3">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" id="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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
        function edit_notify(id, notify) {
            $("#editnotify").val(notify);
            $("#notify_id").val(id);
            $("#editnoti").modal("show");
        }

        function edit_status(id, status) {
            $("#upstatus").val(status);
            $("#status_id").val(id);
            $("#statusupdate").modal("show");
        }
    </script>
@endpush

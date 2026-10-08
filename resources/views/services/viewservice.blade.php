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
                    <h5 class="card-title">All Services</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Service Name</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allservice as $key => $ser)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-danger">{{ $ser->service_name }}</td>
                                        <td>{{ $ser->status }}</td>
                                        <td>
                                            <div class="customer-pic">
                                                <img src="/upload/service/{{ $ser->service_image }}" class="rounded-circle"
                                                    width="30" height="30" alt="">
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap">
                                            <button
                                                onclick="edit_service('{{ $ser->id }}','{{ $ser->service_name }}','{{ $ser->status }}')"
                                                ype="button" style="font-size: small"
                                                class="btn-sm btn btn-primary">Edit</button>

                                            @if( Auth::user()->user_type_id == 1 )
                                            <button onclick="return confirm('Do you want to confirm delete service?')"
                                                href="{{ url('/dropservice', $ser->id) }}" type="button"
                                                style="font-size: small" class="btn-sm btn btn-danger">Drop</button>
                                            @endif
                                            <a href="{{ url('/subservice', $ser->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-info">Sub Service</a>

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
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Services</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updateservice') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        @if( Auth::user()->user_type_id == 1)
                                        <div class="col-md-12">
                                            <input type="hidden" name="service_id" id="serviceid" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Name</label>
                                                <input name="service_name" type="text" maxlength="30" class="form-control" id="editname" placeholder="Name">
                                            </div>
                                        </div>
                                        @endif
                                        @if( Auth::user()->user_type_id == 2)
                                        <div class="col-md-12">
                                            <input type="hidden" name="service_id" id="serviceid" />
                                            <div class="mb-3">
                                                <label for="editname" class="form-label">Name</label>
                                                <input readonly name="service_name" type="text" maxlength="30" class="form-control" id="editname" placeholder="Name">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Service Image</label>
                                                <input name="service_image" type="file" maxlength="30"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="editstatus" class="form-label">Status</label>
                                                <select type="text" name="status" maxlength="12" class="form-control"
                                                    id="editstatus">
                                                    <option value="">Select</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        function edit_service(id, service_name, status) {
            $("#editname").val(service_name);
            $("#editstatus").val(status);
            $("#serviceid").val(id);
            $("#editser").modal("show");
        }
    </script>
@endpush

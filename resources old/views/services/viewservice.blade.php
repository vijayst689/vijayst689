@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">All Services</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="col-auto">
                        @if (Auth::user()->user_type_id == 1)
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <a href="{{ url('/service') }}" class="btn btn-grd btn-grd-info px-3"><i
                                        class="bi bi-chat me-2"></i>Add Services</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!--end row-->

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
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Service Name</th>
                                        <th>Service Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allservice as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-danger">{{ $ser->service_name }}</td>
                                            <td>
                                                <div class="customer-pic">
                                                    <img src="/upload/service/{{ $ser->service_image }}"
                                                        class="rounded-circle" width="30" height="30" alt="">
                                                </div>
                                            </td>
                                            <td>{{ $ser->status }}</td>
                                            <td style="white-space: nowrap">
                                                <button
                                                    onclick="edit_service('{{ $ser->id }}','{{ $ser->service_name }}','{{ $ser->status }}')"
                                                    ype="button" style="font-size: small"
                                                    class="btn btn-grd btn-grd-primary px-2">Edit</button>
                                                @if (Auth::user()->user_type_id == 1)
                                                    <button
                                                        onclick="return confirm('Do you want to confirm delete service?')"
                                                        href="{{ url('/dropservice', $ser->id) }}" type="button"
                                                        style="font-size: small"
                                                        class="btn btn-inverse-danger px-2">Drop</button>
                                                @endif
                                                    <a href="{{ url('/subservice', $ser->id) }}" style="font-size: small"
                                                        class="btn btn-grd btn-grd-branding px-1">Sub Service</a>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="">
                                    <div class="modal fade" id="editser">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                                    <h5 class="modal-title">Update Service</h5>
                                                    <a href="javascript:;" class="primaery-menu-close"
                                                        data-bs-dismiss="modal">
                                                        <i class="material-icons-outlined">close</i>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <form class="row g-3" action="{{ url('/updateservice') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                        <input type="hidden" name="service_id" id="serviceid" />
                                                            @if( Auth::user()->user_type_id == 1)
                                                            <div class="col-md-6">
                                                                <label for="editname" class="form-label">Service
                                                                    Name</label>
                                                                <input name="service_name" maxlength="30" type="text"
                                                                    class="form-control" id="editname"
                                                                    placeholder="Service Name">
                                                            </div>
                                                            @endif
                                                            @if( Auth::user()->user_type_id == 2)
                                                            <div class="col-md-6">
                                                                <label for="editname" class="form-label">Service
                                                                    Name</label>
                                                                <input readonly name="service_name" maxlength="30" type="text"class="form-control" id="editname"
                                                                    placeholder="Service Name">
                                                            </div>
                                                            @endif
                                                            <div class="col-md-6">
                                                                <label for="" class="form-label">Service
                                                                    Image</label>
                                                                <input name="service_image" maxlength="30" type="file"
                                                                    class="form-control" placeholder="Service Name">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editstatus" class="form-label">Status</label>
                                                                <select type="text" name="status" class="form-select"
                                                                    id="editstatus">
                                                                    <option>Select</option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                                    <button type="submit"
                                                                        class="btn btn-grd-danger px-4">Submit</button>
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
            </div>
        </div>
    </main>
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

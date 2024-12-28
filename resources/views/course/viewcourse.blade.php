@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Courses</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a href="{{ url('/addcourse') }}" class="btn btn-primary px-4"><i
                            class="bi bi-plus-lg me-2"></i>ADD COURSE</a>
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
                                <thead class="bg-danger">
                                    <tr class="text-white">
                                        <th class="text-white">Sl No</th>
                                        <th class="text-white">Course Name</th>
                                        <th class="text-white">Image</th>
                                        <th class="text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-dark">
                                    @foreach ($viewcourse as $key => $p)
                                        <tr class="text-white">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $p->name }}</td>
                                            <td><img src="/upload/course_image/{{ $p->ser_image }}" class="rounded-circle"
                                                width="40" height="40" alt=""></td>
                                            <td> <a class="btn btn-sm btn-danger text-white"><i
                                                        class='bx bx-btn'></i>{{ $p->status }}</a>
                                                <button
                                                    onclick="edit_course('{{ $p->id }}','{{ $p->name }}','{{ $p->amount }}')"
                                                    type="button" style="font-size: small"
                                                    class="btn btn-grd btn-grd-primary px-1">Edit</button>
{{--
                                                <button
                                                    onclick="editstatus('{{ $p->id }}','{{ $p->status }}')"
                                                    type="button" style="font-size: small"
                                                    class="btn btn-grd btn-grd-success px-1">Status</button> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="">
                                    <div class="modal fade" id="editcor">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                                    <h5 class="modal-title">Update Course</h5>
                                                    <a href="javascript:;" class="primaery-menu-close"
                                                        data-bs-dismiss="modal">
                                                        <i class="material-icons-outlined">close</i>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <form class="modal-content" action="{{ url('/updatecourse') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <input type="hidden" name="corid" id="corid">
                                                                    <div class="col mb-3">
                                                                        <label for="name" class="form-label">Course
                                                                            Name</label>
                                                                        <input type="text" id="editservice"
                                                                            name="name" class="form-control"
                                                                            placeholder="Name" />
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label for="amount" class="form-label">Amount</label>
                                                                        <input type="text" id="editamount"
                                                                            name="amount" class="form-control number"
                                                                            placeholder="Amount" />
                                                                    </div>
                                                                    <div class="col mb-3">
                                                                        <label for="ser_image" class="form-label">
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
    </main>
@endsection
@push('page_scripts')
    <script>
        function edit_course(id, name, amount ) {
            $("#editservice").val(name);
            $("#editamount").val(amount);
            $("#corid").val(id);
            $("#editcor").modal("show");
        }

        function editstatus(id, status ) {
            $("#editsta").val(status);
            $("#pan_id").val(id);
            $("#editsta").modal("show");
        }
    </script>
@endpush

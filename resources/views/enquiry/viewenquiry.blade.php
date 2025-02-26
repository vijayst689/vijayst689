@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Enquiry Form</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
                                        <th class="text-white">Name</th>
                                        <th class="text-white">Email</th>
                                        <th class="text-white">Phone</th>
                                        <th class="text-white">Requirement</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-dark">
                                    @foreach ($enquiry as $key => $enq)
                                        <tr class="text-white">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $enq->name }}</td>
                                            <td>{{ $enq->email }}</td>
                                            <td>{{ $enq->mobile }}</td>
                                            <td>{{ $enq->requirement }}</td>
                                            

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        function edit_course(id, name ) {
            $("#editservice").val(name);
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

@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Customer Documents</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    {{-- <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <a href="{{ url('customers') }}" class="btn btn-grd btn-grd-info px-3"><i class="bi bi-chat me-2"></i>View Customers</a>
                    </div>
                </div> --}}
                </div>
            </div>
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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Documents</h5>
                                </div>
                            </div>
                            <form class="row g-4" action="{{ url('/adddocument') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <input type="hidden" name="customer_id" value="{{ $id }}">
                                    <label for="input1" class="form-label">File Name</label>
                                    <input type="text" name="file_name" maxlength="20" class="form-control"
                                        id="input1" placeholder="File Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="input6" class="form-label">Document</label>
                                    <input name="cus_docx" type="file" class="form-control" id="input6">
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
                                    </div>
                                </div>
                            </form>
                              <div class="customer-table">
                            <div class="table-responsive white-space-nowrap">
                                <table class="table align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Sl No</th>
                                            <th>File Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $key => $doc)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $doc->file_name }}</td>
                                                <td><img src="/upload/document/{{ $doc->cus_docx }}" width="100"
                                                        height="100"></td>
                                                <td style="white-space: nowrap">
                                                    <a href="/upload/document/{{ $doc->cus_docx }}" download
                                                        style="font-size: small"
                                                        class="btn btn-grd btn-grd-success px-2">Download</a>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div><!--end row-->
        </div>
    </main>
@endsection
@push('page_scripts')
   
@endpush

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
                <h5 class="card-title mb-4">Bulk Orders</h5>

                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>District</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bulkorders as $key => $bulkorderslist)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $bulkorderslist->district_name }}</td>
                                <td>{{ $bulkorderslist->name }}</td>
                                <td>{{ $bulkorderslist->email }}</td>
                                <td>{{ $bulkorderslist->phone }}</td>
                                <td class="text-center">
                                    @if ($bulkorderslist->status === 'Paid')
                                    <a href="{{ url('viewbulkorder', $bulkorderslist->user_id) }}"
                                        class="btn btn-sm btn-info rounded-pill px-3">
                                        <i class="fa fa-eye me-1"></i> View
                                    </a>
                                    @elseif ($bulkorderslist->status === 'Delivered')
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        Delivered
                                    </span>
                                    @endif

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>

</script>
@endpush
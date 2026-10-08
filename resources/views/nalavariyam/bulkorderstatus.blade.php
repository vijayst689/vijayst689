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
                <h5 class="card-title mb-4">Bulk Orders</h5>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
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
</div>

@endsection
@push('page_scripts')
<script>
   
</script>
@endpush
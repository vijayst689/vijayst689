@extends('layouts.app')
@section('content')
<style>
    .dataTables_filter {
        float: right !important;
        margin-bottom: 10px;
    }

    /* Highlight spam users */
    .spam-user {
        background-color: #ffe0e0 !important; /* light red */
        font-weight: bold;
    }
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <div class="row">
                            <table id="example2" class="table table-striped table-bordered">
                        <thead class="table">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Wallet</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spamusers as $dis)
                                <tr class="{{ ($dis->wallet > 0 && $dis->status == 'inactive') ? 'spam-user' : '' }}">
                                    <td>D{{ $dis->id }}</td>
                                    <td>{{ $dis->name }}</td>
                                    <td>{{ $dis->email }}</td>
                                    <td><h6 class="text-primary">{{ $dis->wallet }}</h6></td>
                                    <td>{{ $dis->status }}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "ordering": true,
            "paging": true
        });
    });
</script>
@endpush
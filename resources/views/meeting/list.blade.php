@extends('layouts.app')
@section('content')
<style>
.modal {
    z-index: 1055;
}

.modal-dialog.modal-fullscreen {
    width: 100vw !important;
    max-width: 100vw !important;
    height: 100vh;
    margin: 0;
}
</style>

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
                    <h5 class="card-title mb-3">View Meeting List</h5>


<div class="container mt-4">

    <h4 class="mb-3">Meeting Users</h4>

    {{-- Summary --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card p-2 text-center">
                <strong>Total Users</strong>
                <div>{{ $count }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-2 text-center text-success">
                <strong>Paid Amount</strong>
                <div>₹ {{ $paid_amount }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-2 text-center text-danger">
                <strong>Unpaid Amount</strong>
                <div>₹ {{ $unpaid_amount }}</div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>

                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" width="40" height="40" style="border-radius:50%;">
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>₹ {{ $user->amount }}</td>

                    <td>
                        @if($user->paymentstatus == 'SUCCESS')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>

                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
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
   
@endpush

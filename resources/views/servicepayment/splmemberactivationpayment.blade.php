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
                <h5 class="card-title">Service Payment</h5>
                <form class="row g-4" action="{{ url('/savesplmemberactivation') }}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }}
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Distributor</th>
                                    <th>Retailer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($payment) > 0)
                                @foreach ($payment as $key => $p)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <input class="form-control decimal" name="distributor_amount"
                                            type="text" maxlength="6"
                                            value="{{ $p->distributor_amount }}">
                                    </td>
                                    <td>
                                        <input class="form-control decimal" name="retailer_amount"
                                            type="text" maxlength="6"
                                            value="{{ $p->retailer_amount }}">
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input class="form-control decimal" name="distributor_amount"
                                            type="text" maxlength="6" value=""
                                            placeholder="Enter Distributor Amount">
                                    </td>
                                    <td>
                                        <input class="form-control decimal" name="retailer_amount"
                                            type="text" maxlength="6" value=""
                                            placeholder="Enter Retailer Amount">
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <div class="col-12">
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
@endpush
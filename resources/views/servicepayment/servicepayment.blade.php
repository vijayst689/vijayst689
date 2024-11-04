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
                 <form class="row g-4" action="{{ url('/addservice_payment') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                <div class="table-responsive">
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Service Name</th>
                                <th>Distributor</th>
                                <th>Retailer</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $key => $ser)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ser->service_name }}</td>
                                <input name="parent_id[]" type="hidden"  value="{{ $serviceid }}" />
                                <input name="service_id[]" type="hidden"  value="{{ $ser->id }}" />
                                 @if(count($ser->payment) > 0)
                                 @foreach ($ser->payment as $key1 => $payment)
                                
                                  <td><input class="form-control number" name="distributor_amount[]" type="text" maxlength="6" value="{{ $payment->distributor_amount }}" /></td>
                                <td><input class="form-control number" name="retailer_amount[]" type="text" maxlength="6" value="{{ $payment->retailer_amount }}" /></td>
                                <td><input class="form-control number" name="customer_amount[]" type="text" maxlength="6" value="{{ $payment->customer_amount }}" /></td>
                                
                               
                                @endforeach
                                 @else
                                  <td><input class="form-control number" name="distributor_amount[]" type="text" maxlength="6" value="" /></td>
                                <td><input class="form-control number" name="retailer_amount[]" type="text" maxlength="6" value="" /></td>
                                <td><input class="form-control number" name="customer_amount[]" type="text" maxlength="6" value="" /></td>
                                 @endif
                            </tr>
                        </tbody>
                        @endforeach
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

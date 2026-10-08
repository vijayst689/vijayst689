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
                                        <th>Admin</th>
                                        <th>Other site admin</th>
                                        <th>Distributor</th>
                                        <th>Retailer</th>
                                        <th>Need Coordinator</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($services as $key => $ser)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ser->service_name }}</td>
                                <input name="parent_id[]" type="hidden"  value="{{ $serviceid }}" />
                                <input name="service_id[]" type="hidden"  value="{{ $ser->id }}" />
                                <input name="ramjiservice_id[]" type="hidden" value="{{ $ser->ramjiservice_id }}" />
                                 @if(count($ser->payment) > 0)
                                 @foreach ($ser->payment as $key1 => $payment)

                                 <td><input class="form-control number" name="admin_amount[]" type="text" maxlength="6" value="{{ $payment->admin_amount }}" @if(Auth::user()->user_type_id == 2) readonly @endif/></td>
                                  <td><input class="form-control number" name="othersite_amount[]"
                                                            type="text" maxlength="6"
                                                            value="{{ $payment->othersite_amount }}" /></td>
                                <td><input class="form-control number" name="distributor_amount[]" type="text" maxlength="6" value="{{ $payment->distributor_amount }}" /></td>
                                <td><input class="form-control number" name="retailer_amount[]" type="text" maxlength="6" value="{{ $payment->retailer_amount }}" /></td>
                                <td><div class="row row-padded">

                                    <div class="icheck-success d-inline col-sm-2">
                                        <input name="check_{{ $ser->id }}"
                                            @if ($payment->coordinator_permission == 1) checked @endif
                                            type="checkbox"  value="1">
                                    </div>
                                </div></td>


                                @endforeach
                                            @else
                                 <td><input class="form-control number" name="admin_amount[]" type="text" maxlength="6" value="{{ $ser->admin_amount }}" @if(Auth::user()->user_type_id == 2) readonly @endif /></td>
                                  <td><input class="form-control number" name="othersite_amount[]" type="text" maxlength="6" value="" /></td>
                                  <td><input class="form-control number" name="distributor_amount[]" type="text" maxlength="6" value="" /></td>
                                 
                                <td><input class="form-control number" name="retailer_amount[]" type="text" maxlength="6" value="" /></td>
                                <td><div class="row row-padded">

                                    <div class="icheck-success d-inline col-sm-2">
                                        <input name="check_{{ $ser->id }}"
                                            type="checkbox" value="1">
                                    </div>
                                </div></td>
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

@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
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
                    <form class="row g-4" action="{{ url('/savenalavariyam_payment') }}" enctype="multipart/form-data"
                        method="post">
                        {{ csrf_field() }}
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Service Name</th>
                                        <th>Admin</th>
                                        <th>Nalavariyam Distributor</th>
                                        <th>Nalavariyam Retailer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($services as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->service_name }}</td>
                                            <input name="parent_id[]" type="hidden" value="{{ $service_id }}" />
                                            <input name="service_id[]" type="hidden" value="{{ $ser->id }}" />
                                            @if (count($ser->payment) > 0)
                                                @foreach ($ser->payment as $key1 => $payment)
                                                    <td><input class="form-control number" @if(Auth::user()->user_type_id == 2) readonly @endif name="admin_amount[]"
                                                            type="text" maxlength="6"
                                                            value="{{ $payment->admin_amount }}" /></td>
                                                    <td><input class="form-control number"  @if(Auth::user()->user_type_id == 2) readonly @endif name="distributor_amount[]"
                                                            type="text" maxlength="6"
                                                            value="{{ $payment->distributor_amount }}" /></td>
                                                    <td><input class="form-control number"  @if(Auth::user()->user_type_id == 2) readonly @endif name="retailer_amount[]"
                                                            type="text" maxlength="6"
                                                            value="{{ $payment->retailer_amount }}" /></td>
                                                @endforeach
                                            @else
                                                <td><input class="form-control number"  @if(Auth::user()->user_type_id == 2) readonly @endif name="admin_amount[]"
                                                        type="text" maxlength="6" value="" /></td>
                                                <td><input class="form-control number"  @if(Auth::user()->user_type_id == 2) readonly @endif name="distributor_amount[]"
                                                        type="text" maxlength="6" value="" /></td>
                                                <td><input class="form-control number"  @if(Auth::user()->user_type_id == 2) readonly @endif name="retailer_amount[]"
                                                        type="text" maxlength="6" value="" /></td>
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
        </div>
@endsection
@push('page_scripts')
    <script>

    </script>
@endpush

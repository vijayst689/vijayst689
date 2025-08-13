@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
                            <h5 class="card-title">User Activation</h5>
                            <form class="row g-4" action="{{ url('/adduser_activation') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="customer-table">
                                    <div class="table-responsive white-space-nowrap">
                                        <table id="" class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Service Name</th>
                                                    <th>Admin</th>
                                                    <th>Distributor</th>
                                                    <th>Retailer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($services as $key => $ser)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $ser->name }}</td>

                                                        @if (count($ser->payment) > 0)
                                                            @foreach ($ser->payment as $key1 => $payment)
                                                                <input name="parent_id[]" type="hidden"
                                                                    value="{{ $ser->activation_id }}" />
                                                                <input name="user_id[]" type="hidden"
                                                                    value="{{ Auth::user()->id }}" />
                                                                <input name="service_id[]" type="hidden"
                                                                    value="{{ $ser->id }}" />
                                                                <td><input @if (Auth::user()->user_type_id == 2) readonly @endif
                                                                        class="form-control decimal" name="admin_amount[]"
                                                                        type="text" maxlength="6"
                                                                        value="{{ $payment->admin_amount }}" /></td>

                                                                <td><input class="form-control decimal"
                                                                        name="distributor_amount[]" type="text"
                                                                        maxlength="6"
                                                                        value="{{ $payment->distributor_amount }}" /></td>
                                                                <td><input class="form-control decimal"
                                                                        name="retailer_amount[]" type="text"
                                                                        maxlength="6"
                                                                        value="{{ $payment->retailer_amount }}" /></td>
                                                            @endforeach
                                                        @else
                                                            <input name="parent_id[]" type="hidden"
                                                                value="{{ $ser->activation_id }}" />
                                                            <input name="user_id[]" type="hidden"
                                                                value="{{ Auth::user()->id }}" />
                                                            <input name="service_id[]" type="hidden"
                                                                value="{{ $ser->id }}" />
                                                            <td><input @if (Auth::user()->user_type_id == 2) readonly @endif
                                                                    class="form-control decimal" name="admin_amount[]"
                                                                    type="text" maxlength="6" value="" /></td>
                                                            <td><input class="form-control decimal"
                                                                    name="distributor_amount[]" type="text"
                                                                    maxlength="6" value="" /></td>
                                                            <td><input class="form-control decimal" name="retailer_amount[]"
                                                                    type="text" maxlength="6" value="" /></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    </main>
@endsection
@push('page_scripts')
@endpush

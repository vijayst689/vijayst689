@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">CoursePayment</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mt-4">
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
                    <form class="row g-4" action="{{ url('/addcourse_payment') }}" enctype="multipart/form-data"
                    method="post">
                    {{ csrf_field() }}
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Course Name</th>
                                    <th>Admin</th>
                                    <th>Distributor</th>
                                    <th>Retailer</th>
                                    <th>Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key => $ser)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $ser->name }}</td>
                                        <input name="parent_id[]" type="hidden" value="1" />
                                        <input name="service_id[]" type="hidden" value="{{ $ser->id }}" />
                                        @if (count($ser->payment) > 0)
                                            @foreach ($ser->payment as $key1 => $payment)
                                                <td><input class="form-control decimal"
                                                        name="admin_amount[]" type="text"
                                                        maxlength="6"
                                                        value="{{ $payment->admin_amount }}" readonly /></td>
                                                <td><input class="form-control decimal"
                                                        name="distributor_amount[]" type="text"
                                                        maxlength="6"
                                                        value="{{ $payment->distributor_amount }}" /></td>
                                                <td><input class="form-control decimal" name="retailer_amount[]"
                                                        type="text" maxlength="6"
                                                        value="{{ $payment->retailer_amount }}" /></td>
                                                <td><input class="form-control decimal" name="customer_amount[]"
                                                        type="text" maxlength="6"
                                                        value="{{ $payment->customer_amount }}" /></td>
                                            @endforeach
                                        @else
                                            <td><input class="form-control decimal" name="admin_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                            <td><input class="form-control decimal" name="distributor_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                            <td><input class="form-control decimal" name="retailer_amount[]"
                                                    type="text" maxlength="6" value="" /></td>
                                            <td><input class="form-control decimal" name="customer_amount[]"
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
    <script>

    </script>
@endpush

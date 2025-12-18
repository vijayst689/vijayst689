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
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                            <div class="card-body p-4">
                                <h5 class="card-title">Service Payment</h5>
                                <form class="row g-4" action="{{ url('/savesplmemberactivation') }}"
                                    enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        <table id="" class="table table-striped table-bordered">
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
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
            @push('page_scripts')
            @endpush
@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
               <div class="breadcrumb-title pe-3">pkrmsolutions.com
            </div>
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
                                    <h5 class="card-title">User Activation</h5>
                                    <form class="row g-4" action="{{ url('/adduser_activation') }}"
                                        enctype="multipart/form-data" method="post">
                                        {{ csrf_field() }}

                                        @if ($activation_id == 3)
                                            <div class="accordion mt-4" id="serviceAccordion">

                                                @foreach ($services as $index => $ser)
                                                    @if (!empty($ser->children) && count($ser->children) > 0)
                                                        <div class="accordion-item mb-2">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed fw-bold"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#service{{ $index }}">
                                                                    {{ $ser->name }}
                                                                </button>
                                                            </h2>

                                                            <div id="service{{ $index }}"
                                                                class="accordion-collapse collapse">
                                                                <div class="accordion-body">

                                                                    {{-- HEADER --}}
                                                                    <div class="row mb-2 fw-bold border-bottom pb-1">
                                                                        <div class="col-md-3">Sub Service</div>
                                                                        <div class="col-md-3">Admin</div>
                                                                        <div class="col-md-3">Distributor</div>
                                                                        <div class="col-md-3">Retailer</div>
                                                                    </div>

                                                                    {{-- SUB SERVICES --}}
                                                                    @foreach ($ser->children as $child)
                                                                        <div
                                                                            class="row ps-3 py-2 bg-light rounded mb-1 align-items-center">
                                                                            <div class="col-md-3">{{ $child->service_name }}
                                                                            </div>

                                                                            <input name="parent_id[]" type="hidden"
                                                                                value="{{ $ser->activation_id }}" />
                                                                            <input name="user_id[]" type="hidden"
                                                                                value="{{ Auth::user()->id }}" />
                                                                            <input name="service_id[]" type="hidden"
                                                                                value="{{ $child->id }}" />

                                                                            <div class="col-md-3">
                                                                                <input class="form-control number"
                                                                                    name="admin_amount[]" type="text"
                                                                                    value="{{ $child->payment->admin_amount ?? '' }}"
                                                                                    maxlength="6"
                                                                                    @if (Auth::user()->user_type_id == 2) readonly @endif>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <input class="form-control number"
                                                                                    name="distributor_amount[]"
                                                                                    type="text"
                                                                                    value="{{ $child->payment->distributor_amount ?? '' }}"
                                                                                    maxlength="6">
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <input class="form-control number"
                                                                                    name="retailer_amount[]" type="text"
                                                                                    value="{{ $child->payment->retailer_amount ?? '' }}"
                                                                                    maxlength="6">
                                                                            </div>
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        @else
                                            {{-- DEFAULT TABLE LAYOUT --}}
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
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

                                                                <input name="parent_id[]" type="hidden"
                                                                    value="{{ $ser->activation_id }}" />
                                                                <input name="user_id[]" type="hidden"
                                                                    value="{{ Auth::user()->id }}" />
                                                                <input name="service_id[]" type="hidden"
                                                                    value="{{ $ser->id }}" />

                                                                <td><input @if (Auth::user()->user_type_id == 2) readonly @endif
                                                                        class="form-control number" name="admin_amount[]"
                                                                        type="text"
                                                                        value="{{ $ser->payment->admin_amount ?? '' }}"
                                                                        maxlength="6"></td>

                                                                <td><input class="form-control number"
                                                                        name="distributor_amount[]" type="text"
                                                                        value="{{ $ser->payment->distributor_amount ?? '' }}"
                                                                        maxlength="6"></td>

                                                                <td><input class="form-control number"
                                                                        name="retailer_amount[]" type="text"
                                                                        value="{{ $ser->payment->retailer_amount ?? '' }}"
                                                                        maxlength="6"></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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

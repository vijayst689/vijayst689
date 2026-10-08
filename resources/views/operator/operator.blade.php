@extends('layouts.app')
@section('content')
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
                            <form action="{{ url('/addoperator') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="code" class="form-label">Operator Code</label>
                                    <input required class="form-control" type="text" name="code" maxlength="10" placeholder="Code" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="service_type" class="form-label">Service Type</label>
                                    <select required class="form-control" maxlength="10" type="file"
                                        name="service_type">
                                        <option value="">Select Service Type</option>
                                        <option value="1">Mobile Prepaid</option>
                                        <option value="2">DTH</option>
                                        <option value="3">Fastag</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Operator Name</label>
                                    <input required class="form-control" type="text" name="name" maxlength="50" placeholder="Operator Name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="commission" class="form-label">Commision</label>
                                    <input required class="form-control number" type="text" name="commission" maxlength="5" placeholder="Commision"/>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="admin_commission" class="form-label">Admin Commision</label>
                                    <input required class="form-control" type="text" name="admin_commission" maxlength="5" placeholder="Admin Commision"/>
                                </div>
                            <div class="mt-2 text-center">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

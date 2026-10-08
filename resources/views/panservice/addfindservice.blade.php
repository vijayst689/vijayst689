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
                        <h5 class="card-title">Add Find Services</h5>
                        <div class="row">
                            <form action="{{ url('/savefind') }}" id="formAccountSettings" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">FindService Name</label>
                                        <input required class="form-control" type="text" name="name" maxlength="30"
                                            autofocus placeholder="FindService Name" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input required class="form-control number" maxlength="5" type="text"
                                            name="amount" placeholder="Amount" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="ser_image" class="form-label">Service Image</label>
                                        <input required class="form-control" maxlength="10" type="file"
                                            name="ser_image" />
                                    </div>
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

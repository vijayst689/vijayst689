@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <h5> Service {{ $status }}</h5>
            <div class="row g-3">
                <div class="col-auto flex-grow-1 overflow-auto">
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    </div>
                </div>
            </div><!--end row-->

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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th width="6%">Sl No</th>
                                        <th>Service Name</th>
                                        @if (Auth::user()->user_type_id == 1)
                                            <th>Customer Name</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Applied Date</th>
                                        @if ($status == 'Processing')
                                            <th>Application No</th>
                                            <th>Acknowledgement</th>
                                        @elseif($status == 'Approved')
                                            <th>Certificate</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->service_name }}</td>
                                            @if (Auth::user()->user_type_id == 1)
                                                <td>{{ $ser->name }}</td>
                                            @endif
                                            <td>{{ $ser->status }}</td>
                                            <td>{{ date('d-m-Y', strtotime($ser->applied_date)) }}</td>
                                            @if ($status == 'Processing')
                                                <td>{{ $ser->application_no }}</td>
                                                <td><a download
                                                        href="{{ URL::to('/') }}/upload/services/acknowledgement/{{ $ser->acknowledgement }}" style="font-size: small" class="btn btn-grd btn-grd-primary px-1">Download</a></td>
                                            @elseif($status == 'Approved')
                                                <td><a download
                                                        href="{{ URL::to('/') }}/upload/services/certificate/{{ $ser->certificate }}" style="font-size: small" class="btn btn-grd btn-grd-branding px-1">Download</a></td>
                                            @endif
                                            <td style="white-space:nowrap;">

                                                @if (Auth::user()->id == $ser->user_id && $ser->retailer_id == 0)
                                                    @if ($ser->status == 'Resubmit')

                                                    <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}" style="font-size: small"
                                                        class="btn btn-grd btn-grd-info px-1">Resubmit</a>

                                                    @else
                                                        <button type="button" style="font-size: small" class="btn btn-grd btn-grd-branding px-1" disabled></button>
                                                    @endif
                                                @elseif(Auth::user()->id == $ser->retailer_id)
                                                    @if ($ser->status == 'Resubmit')

                                                    <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}" style="font-size: small"
                                                        class="btn btn-grd btn-grd-info px-1">Resubmit</a>

                                                    @else
                                                        <button type="button"  style="font-size: small"
                                                        class="btn btn-grd btn-grd-primary" disabled>Pending</button>
                                                    @endif
                                                @else
                                                    @if (Auth::user()->id == $ser->user_id)
                                                        <button type="button" style="font-size: small" class="btn btn-grd btn-grd-branding px-1" disabled></button>
                                                    @else
                                                    <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}" style="font-size: small"
                                                        class="btn btn-grd btn-grd-info px-1">{{ $ser->status }}</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')

@endpush

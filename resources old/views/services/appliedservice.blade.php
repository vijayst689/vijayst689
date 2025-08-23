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
                            <table id="example2" class="table align-middle">
                                <thead>
                                    <tr>
                                        <th width="6%">Sl No</th>
                                        <th>Service Name</th>
                                        @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
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
                                            @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                                                <td>{{ $ser->context }}({{ $ser->applyuserid }})</td>
                                                <td>{{ $ser->applyname }}</td>
                                                <td>{{ $ser->applymobile }}</td>
                                            @endif
                                            <td>{{ $ser->status }}</td>
                                            <td>{{ date('d-m-Y', strtotime($ser->applied_date)) }}</td>
                                              @if ($status == 'Processing')
                                                    <td>{{ $ser->application_no }}</td>
                                                    <td>
                                                        @if ($ser->api_processing != '' && $ser->application_no == '')
                                                            <a download href="{{ $ser->api_processing }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif ($ser->api_processing != '' && $ser->application_no != '')
                                                            <a download href="{{ $ser->api_processing }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif ($ser->selects == 'File')
                                                            <a download
                                                                href="{{ URL::to('/') }}/upload/services/acknowledgement/{{ $ser->acknowledgement }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif($ser->acknowledgement != '')
                                                            <a download
                                                                href="{{ URL::to('/') }}/upload/services/acknowledgement/{{ $ser->acknowledgement }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @endif
                                                    </td>
                                                @elseif($status == 'Approved')
                                                    <td>{{ $ser->application }}</td>
                                                    <td>
                                                        @if ($ser->api_approved != '' && $ser->application == '')
                                                            <a download href="{{ $ser->api_approved }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif ($ser->api_approved != '' && $ser->application != '')
                                                            <a download href="{{ $ser->api_approved }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif ($ser->lects == 'File')
                                                            <a download
                                                                href="{{ URL::to('/') }}/upload/services/certificate/{{ $ser->certificate }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @elseif($ser->certificate != '')
                                                            <a download
                                                                href="{{ URL::to('/') }}/upload/services/certificate/{{ $ser->certificate }}"
                                                                class="btn btn-success me-2 btn-sm">Download</a>
                                                        @endif
                                                    </td>
                                                @endif
                                                @php
                                                $apply_user_id = 0;
                                                if ($ser->distributor_id == 0 && $ser->retailer_id == 0) {
                                                    $apply_user_id = $ser->user_id;
                                                } elseif ($ser->retailer_id == 0) {
                                                    $apply_user_id = $ser->distributor_id;
                                                } elseif ($ser->distributor_id == 0) {
                                                    $apply_user_id = $ser->retailer_id;
                                                }
                                            @endphp
                                            <td style="white-space:nowrap;">
                                                @if (Auth::user()->id == $apply_user_id)
                                                    @if ($ser->status == 'Resubmit')
                                                        <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}"
                                                            class="btn btn-sm btn-warning">{{ $ser->status }}</a>
                                                    @elseif($ser->status == 'Approved')
                                                        <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}"
                                                            class="btn btn-sm btn-warning">{{ $ser->status }}</a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            disabled>{{ $ser->status }}</button>
                                                    @endif
                                                @else
                                                    @if (Auth::user()->user_type_id == 2 && $ser->status == 'Resubmit')
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            disabled>{{ $ser->status }}</button>
                                                    @else
                                                        <a href="{{ url('/servicestatus') }}/{{ $ser->status }}/{{ $ser->id }}/{{ $ser->service_id }}"
                                                            class="btn btn-sm btn-warning">{{ $ser->status }}</a>
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

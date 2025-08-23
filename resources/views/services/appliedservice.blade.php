@extends('layouts.app')
@section('content')
    <!--start page wrapper -->
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
            <button type="button" class="btn btn-primary">Service {{ $status }}</button>
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
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">Sl No</th>
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
                                        @php
                                            // Allowed file extensions
                                            $allowedExts = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
                                            // Extract extensions
                                            $apiApprovedExt = !empty($ser->api_approved)
                                                ? pathinfo($ser->api_approved, PATHINFO_EXTENSION): '';
                                            $ackExt = !empty($ser->acknowledgement)
                                                ? pathinfo($ser->acknowledgement, PATHINFO_EXTENSION): '';
                                            $apiProcExt = !empty($ser->api_processing)
                                                ? pathinfo($ser->api_processing, PATHINFO_EXTENSION): '';
                                        @endphp
                                        @if ($status == 'Processing')
                                            <td>{{ $ser->application_no ?? '' }}</td>
                                            <td>
                                                @if (!empty($ser->application_no))
                                                    {{-- Acknowledgement --}}
                                                    @if (!empty($ser->acknowledgement) && in_array(strtolower($ackExt), $allowedExts))
                                                        <a download
                                                            href="{{ url('upload/services/acknowledgement/' . $ser->acknowledgement) }}"
                                                            class="btn btn-primary btn-sm me-2">Download
                                                        </a>
                                                    @endif
                                                @else
                                                    {{-- API Processing --}}
                                                    @if (!empty($ser->api_processing) && in_array(strtolower($apiProcExt), $allowedExts))
                                                        <a download href="{{ $ser->api_processing }}"
                                                            class="btn btn-success btn-sm me-2">Download
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                        @elseif ($status == 'Approved')
                                            <td>{{ $ser->application ?? '' }}</td>
                                            <td>
                                                {{-- API Approved --}}
                                                @if (
                                                    (empty($ser->application) || empty($ser->certificate)) &&
                                                        !empty($ser->api_approved) &&
                                                        !empty($apiApprovedExt) &&
                                                        in_array(strtolower($apiApprovedExt), $allowedExts))
                                                    <a download href="{{ $ser->api_approved }}"
                                                        class="btn btn-success me-2 btn-sm">Download
                                                    </a>
                                                @endif
                                                {{-- Certificate --}}
                                                @if (!empty($ser->certificate) && $ser->lects == 'File')
                                                    <a download
                                                        href="{{ url('upload/services/certificate/' . $ser->certificate) }}"
                                                        class="btn btn-primary me-2 btn-sm">Download
                                                    </a>
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
                                                @else
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        disabled>{{ $ser->status }}</button>
                                                    @if ($ser->service_id == '69' || $ser->service_id == '70')
                                                        <a href="{{ url('/pancard_reapply') }}/{{ $ser->api_txid }}"
                                                            class="btn btn-sm btn-warning">Apply</a>
                                                    @endif
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
    <!--end page wrapper -->
@endsection
@push('page_scripts')
@endpush

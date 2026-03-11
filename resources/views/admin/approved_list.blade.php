@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
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
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">Sl No</th>
                                    <th>Service Name</th>
                                    @if (Auth::user()->user_type_id == 1)
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>District Name</th>
                                    @elseif(Auth::user()->user_type_id == 2)
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Completed Date</th>
                                    <th>Application</th>
                                    <th>Certificate</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key => $ser)
                                    @php
                                        // Allowed file extensions
                                        $allowedExts = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
                                        // Extract extensions
                                        $certExt = !empty($ser->certificate)
                                            ? pathinfo($ser->certificate, PATHINFO_EXTENSION)
                                            : '';
                                        $apiApprovedExt = !empty($ser->api_approved)
                                            ? pathinfo($ser->api_approved, PATHINFO_EXTENSION)
                                            : '';

                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $ser->service_name }}</td>

                                        @if (Auth::user()->user_type_id == 1)
                                            <td>{{ $ser->context }} ({{ $ser->applyuserid }})</td>
                                            <td>{{ $ser->applyname }}</td>
                                            <td>{{ $ser->applymobile }}</td>
                                            <td>{{ $ser->district_name }}</td>
                                        @elseif(Auth::user()->user_type_id == 2 && Auth::user()->id == $ser->refferal_id)
                                            <td>{{ $ser->context }} ({{ $ser->applyuserid }})</td>
                                            <td>{{ $ser->applyname }}</td>
                                            <td>{{ $ser->applymobile }}</td>
                                        @elseif(Auth::user()->user_type_id == 2)
                                            <td></td>
                                            <td></td>
                                            <td>{{ $ser->applymobile }}</td>
                                        @endif

                                        <td>{{ $ser->status }}</td>
                                        <td>{{ date('d-m-Y', strtotime($ser->completed_date)) }}</td>
                                        <td>{{ $ser->application ?? '' }}</td>
                                        <td>
                                            @if (!empty($ser->certificate) && in_array(strtolower($certExt), $allowedExts))
                                                <a download
                                                    href="{{ url('upload/services/certificate/' . $ser->certificate) }}"
                                                    class="btn btn-primary btn-sm me-2">
                                                    Download
                                                </a>

                                                {{-- ✅ Second priority: API Processing --}}
                                            @elseif (!empty($ser->api_approved) && in_array(strtolower($apiApprovedExt), $allowedExts))
                                                <a download href="{{ $ser->api_approved }}"
                                                    class="btn btn-success btn-sm me-2">
                                                    Download
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/servicestatus') }}/Approved/{{ $ser->id }}/{{ $ser->service_id }}"
                                                class="btn btn-info btn-sm">View</a>
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

    </div>
    </div>
@endsection
@push('page_scripts')
    <script></script>
@endpush

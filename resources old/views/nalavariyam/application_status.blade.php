@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                </div>
            </nav>
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
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                            tabindex="0">
                            <h5 class="card-title">Tap1</h5>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- @foreach ($viewretailers as $key => $cus)
                                    <tr>
                                        <td>R{{ $cus->id }}</td>
                                        <td>{{ $cus->name }}</td>
                                        <td>{{ $cus->phone }}</td>
                                        <td>{{ $cus->status }}</td>
                                        <td>{{ $cus->username }}</td>
                                        <td>{{ $cus->cpassword }}</td>
                                        <td style="white-space: nowrap">
                                            @php
                                                $address1 = $cus->address;
                                                $address1 = str_replace(PHP_EOL, ' ', $address1);
                                                $address1 = str_replace("\r\n", ' ', $address1);
                                                $address1 = str_replace("\n", ' ', $address1);
                                                $NEWLINE_RE = '/(\r\n)|\r|\n/';
                                                $address1 = preg_replace($NEWLINE_RE, ' ', $address1);
                                            @endphp
                                            <button
                                                onclick="edit_retailer('{{ $cus->id }}','{{ $cus->name }}','{{ $cus->username }}','{{ $cus->phone }}','{{ $cus->aadhaar_no }}','{{ $cus->gender }}','{{ $cus->email }}','{{ $cus->date_of_birth }}','{{ $address1 }}','{{ $cus->status }}','{{ $cus->dist_id }}','{{ $cus->taluk_id }}','{{ $cus->panchayath_id }}')"
                                                type="button" class="btn-sm btn btn-primary">Edit</button>

                                            @if (Auth::user()->user_type_id == 1)
                                                <button
                                                    onclick="statusupdates('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->user_type_id }}')"
                                                    type="button" class="btn-sm btn btn-success">Update
                                                </button>
                                            @endif

                                            @if (Auth::user()->user_type_id == 3)
                                                <button
                                                    onclick="edit_status('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->status }}')"
                                                    type="button" class="btn-sm btn btn-success">Status Update
                                                </button>
                                            @endif
                                            @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                            <a href="{{ url('/userpermission', $cus->id) }}" type="button"
                                                style="font-size: small" class="btn-sm btn btn-info">Permission
                                            </a>
                                            @endif

                                           @if ($cus->verified == '' && Auth::user()->user_type_id == 1)
                                            <a href="{{ url('/nalavariyam_permission', $cus->id) }}" type="button"
                                                style="font-size: small" class="btn-sm btn btn-info">Ramji</a>
                                            @else
                                              <a type="button" style="font-size: small" class="btn-sm btn btn-success">Verified</a>
                                            @endif

                                            <a onclick="return confirm('Do you want to confirm delete retailer?')"
                                                href="{{ url('/dropretailer', $cus->id) }}" type="button"
                                                class="btn-sm btn btn-danger">Drop</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <h5 class="card-title">Tab2</h5>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- @foreach ($viewretailers as $key => $cus)
                                    <tr>
                                        <td>R{{ $cus->id }}</td>
                                        <td>{{ $cus->name }}</td>
                                        <td>{{ $cus->phone }}</td>
                                        <td>{{ $cus->status }}</td>
                                        <td>{{ $cus->username }}</td>
                                        <td>{{ $cus->cpassword }}</td>
                                        <td style="white-space: nowrap">
                                            @php
                                                $address1 = $cus->address;
                                                $address1 = str_replace(PHP_EOL, ' ', $address1);
                                                $address1 = str_replace("\r\n", ' ', $address1);
                                                $address1 = str_replace("\n", ' ', $address1);
                                                $NEWLINE_RE = '/(\r\n)|\r|\n/';
                                                $address1 = preg_replace($NEWLINE_RE, ' ', $address1);
                                            @endphp
                                            <button
                                                onclick="edit_retailer('{{ $cus->id }}','{{ $cus->name }}','{{ $cus->username }}','{{ $cus->phone }}','{{ $cus->aadhaar_no }}','{{ $cus->gender }}','{{ $cus->email }}','{{ $cus->date_of_birth }}','{{ $address1 }}','{{ $cus->status }}','{{ $cus->dist_id }}','{{ $cus->taluk_id }}','{{ $cus->panchayath_id }}')"
                                                type="button" class="btn-sm btn btn-primary">Edit</button>

                                            @if (Auth::user()->user_type_id == 1)
                                                <button
                                                    onclick="statusupdates('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->user_type_id }}')"
                                                    type="button" class="btn-sm btn btn-success">Update
                                                </button>
                                            @endif

                                            @if (Auth::user()->user_type_id == 3)
                                                <button
                                                    onclick="edit_status('{{ $cus->id }}','{{ $cus->status }}','{{ $cus->status }}')"
                                                    type="button" class="btn-sm btn btn-success">Status Update
                                                </button>
                                            @endif
                                            @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                            <a href="{{ url('/userpermission', $cus->id) }}" type="button"
                                                style="font-size: small" class="btn-sm btn btn-info">Permission
                                            </a>
                                            @endif

                                           @if ($cus->verified == '' && Auth::user()->user_type_id == 1)
                                            <a href="{{ url('/nalavariyam_permission', $cus->id) }}" type="button"
                                                style="font-size: small" class="btn-sm btn btn-info">Ramji</a>
                                            @else
                                              <a type="button" style="font-size: small" class="btn-sm btn btn-success">Verified</a>
                                            @endif

                                            <a onclick="return confirm('Do you want to confirm delete retailer?')"
                                                href="{{ url('/dropretailer', $cus->id) }}" type="button"
                                                class="btn-sm btn btn-danger">Drop</a>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                        tabindex="0">3
                    </div>
                </div>
    </main>
@endsection
@push('page_scripts')
    <script></script>
@endpush

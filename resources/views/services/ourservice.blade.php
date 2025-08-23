@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="container-xxl flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0">
                            Our Service
                        </h4>
                    </div>
                    <div id="category_div" class="row">
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('addcustomer') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/tnega.jpg"
                                            width="100%" />
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>TNEGA</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('/panservices') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/nsdl.jpg"
                                            width="100%" />
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>NSDL PAN</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('/utility') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/uti.jpg"
                                            width="100%" height="100%" />
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>UTILITY</div>
                                </a>
                            </div>
                        </div>
                            <div class="col-4 col-md-2 mb-3 category_data">
                                <div class="card p-2 h-100">
                                    <a href="{{ url('/viewcanservice') }}">
                                        <div class="mb-1">
                                            <img src="/upload/mylogo/can.jpg"
                                                width="100%" />
                                        </div>
                                        <div class="text-nowrap overflow-hidden"></br>CAN</div>
                                    </a>
                                </div>
                            </div>
                        {{-- @foreach ($pat as $p) --}}
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('viewpattaservice') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/patta.jpg"  width="100%"/>
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>PATTA</div>
                                </a>
                            </div>
                        </div>
                       {{-- @endforeach --}}

                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('pdfservices') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/pdf.jpg"  width="100%"/>
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>PDF</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('viewcourseservice') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/course.jpg"  width="100%"/>
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>Course Certificate</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 mb-3 category_data">
                            <div class="card p-2 h-100">
                                <a href="{{ url('viewsoftware') }}">
                                    <div class="mb-1">
                                        <img src="/upload/mylogo/soft.jpg"  width="100%"/>
                                    </div>
                                    <div class="text-nowrap overflow-hidden"></br>Software Key</div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
@endsection
@push('page_scripts')
    <script></script>
@endpush
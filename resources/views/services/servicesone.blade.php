@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                        {{-- <h5 class="card-title mt-2">{{ $servicename }}</h5>
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6> --}}
                        <div class="card-body p-4">
                            <form class="row g-4" action="#" enctype="multipart/form-data"
                                method="post">
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        {{-- <input type="hidden" id="customerid" name="customerid" value="{{ $customerid }}"> --}}
                                        @if($serviceid == 119)
                                        @foreach ($services as $service)
                                        <div class="col-sm-4 col-md-6 col-xl-2 mb-2">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="bg-label">
                                                    <a href="{{ url('/applyservices', $service->id) }}"><img
                                                            src="/upload/service/{{ $service->service_image }}" alt="user-avatar" style="width: 160px; height: 180px;"
                                                         id="uploadedAvatar">
                                                </span></a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @elseif($serviceid == 10 )
                                        @foreach ($services as $service)
                                        <div class="col-sm-4 col-md-6 col-xl-4 mb-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="bg-label">
                                                    <a href="{{ url('/utilityservices', $service->id) }}">
                                                        <div class="icon-box bg_color_1">
                                                            <svg width="50" height="40" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_4355_17017)">
                                                                <rect x="6.375" y="2" width="12" height="19" fill="white"/>
                                                                <path d="M17.7247 0H7.02484C6.13341 0 5.40381 0.728914 5.40381 1.62103V22.3783C5.40381 23.2704 6.13341 24 7.02484 24H17.7247C18.6161 24 19.3457 23.2718 19.3457 22.379V1.62103C19.3457 0.728914 18.6161 0 17.7247 0ZM10.6632 1.16846H14.0863C14.1947 1.16846 14.2824 1.25623 14.2824 1.36526C14.2824 1.4736 14.1947 1.56137 14.0863 1.56137H10.6632C10.5549 1.56137 10.4671 1.4736 10.4671 1.36526C10.4671 1.25623 10.5549 1.16846 10.6632 1.16846ZM12.3748 23.1895C11.927 23.1895 11.5643 22.8267 11.5643 22.3783C11.5643 21.9298 11.927 21.5678 12.3748 21.5678C12.8226 21.5678 13.1853 21.9298 13.1853 22.3783C13.1853 22.8267 12.8226 23.1895 12.3748 23.1895ZM18.2177 21H6.53181V2.57074H18.2177V21Z" fill="#283EB4"/>
                                                                <path d="M12.3749 6C13.9704 6 15.4719 6.6175 16.6019 7.7385C16.7979 7.9325 16.7994 8.2495 16.6049 8.445C16.5074 8.5435 16.3784 8.593 16.2499 8.593C16.1229 8.593 15.9954 8.5445 15.8979 8.448C14.9564 7.5145 13.7049 7 12.3749 7C11.0449 7 9.79344 7.5145 8.85194 8.4485C8.65644 8.643 8.33944 8.642 8.14494 8.4455C7.95044 8.2495 7.95194 7.9325 8.14794 7.7385C9.27794 6.6175 10.7794 6 12.3749 6Z" fill="#39A3F8"/>
                                                                <path d="M11.25 12.75H10C9.793 12.75 9.625 12.918 9.625 13.125C9.625 13.332 9.793 13.5 10 13.5H11.25C11.319 13.5 11.375 13.556 11.375 13.625V14.375H10C9.793 14.375 9.625 14.543 9.625 14.75C9.625 14.957 9.793 15.125 10 15.125H11.375V15.875C11.375 15.944 11.319 16 11.25 16H10C9.793 16 9.625 16.168 9.625 16.375C9.625 16.582 9.793 16.75 10 16.75H11.25C11.7325 16.75 12.125 16.3575 12.125 15.875V13.625C12.125 13.1425 11.7325 12.75 11.25 12.75Z" fill="#39A3F8"/>
                                                                <path d="M14.75 14.5H14C13.793 14.5 13.625 14.668 13.625 14.875C13.625 15.082 13.793 15.25 14 15.25H14.375V16H13.5C13.431 16 13.375 15.944 13.375 15.875V13.625C13.375 13.556 13.431 13.5 13.5 13.5H14.75C14.957 13.5 15.125 13.332 15.125 13.125C15.125 12.918 14.957 12.75 14.75 12.75H13.5C13.0175 12.75 12.625 13.1425 12.625 13.625V15.875C12.625 16.3575 13.0175 16.75 13.5 16.75H14.75C14.957 16.75 15.125 16.582 15.125 16.375V14.875C15.125 14.668 14.957 14.5 14.75 14.5Z" fill="#39A3F8"/>
                                                                <path d="M12.3751 7.89099C11.2896 7.89099 10.2671 8.31199 9.49706 9.07649C9.30106 9.27099 9.29956 9.58699 9.49406 9.78299C9.68906 9.97949 10.0051 9.98049 10.2011 9.78599C10.7831 9.20849 11.5551 8.89099 12.3751 8.89099C13.1951 8.89099 13.9671 9.20899 14.5491 9.78649C14.6466 9.88299 14.7736 9.93149 14.9011 9.93149C15.0296 9.93149 15.1586 9.88199 15.2561 9.78349C15.4506 9.58749 15.4491 9.27099 15.2531 9.07649C14.4831 8.31199 13.4606 7.89099 12.3751 7.89099Z" fill="#39A3F8"/>
                                                                <path d="M10.8429 10.4165C11.2489 10.0075 11.7929 9.78198 12.3749 9.78198C12.9569 9.78198 13.5009 10.0075 13.9069 10.416C14.1014 10.612 14.1004 10.9285 13.9044 11.123C13.8064 11.22 13.6794 11.2685 13.5519 11.2685C13.4234 11.2685 13.2949 11.2195 13.1974 11.121C12.7629 10.6835 11.9869 10.6835 11.5524 11.121C11.3579 11.3165 11.0414 11.318 10.8454 11.1235C10.6494 10.929 10.6484 10.6125 10.8429 10.4165Z" fill="#39A3F8"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_4355_17017">
                                                                <rect width="40" height="40" fill="white" transform="translate(0.375)"/>
                                                                </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </div>
                                                        {{ $service->service_name }}
                                                    </a>
                                                </span>

                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <label for="input1" class="form-label">Service</label>
                                        <div class="col-sm-10">
                                            <select id="serviceid" class="form-select">
                                                <option value="">Select</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->service_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>

        $('#serviceid').on('change', function() {
            var serviceid = this.value;
            // var customerid =  $("#customerid").val();
                window.location.href = "{{ url('applyservices') }}/"+serviceid;

        });
    </script>
@endpush

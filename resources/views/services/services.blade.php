@extends('layouts.app')
@section('content')
<style>
        /* Smooth animation for cards */
        .service-card {
            border-radius: 12px;
            padding: 8px 6px;
            border: 1px solid #e5e7eb;
            text-align: center;
            transition: all 0.25s ease;
            cursor: pointer;
            background: #fff;
        }

        /* Hover effect */
        .service-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            border-color: #2563eb;
        }

        /* Image zoom on hover */
        .service-card:hover .service-img {
            transform: scale(1.08);
        }

        /* Active (selected) service look */
        .service-card.active {
            border: 2px solid #2563eb;
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.2);
        }

        /* Title on hover */
        .service-card:hover .service-title {
            color: #1d4ed8;
        }

        /* Image smooth effect */
        .service-img {
            width: 95px;
            height: 95px;
            object-fit: contain;
            margin-bottom: 6px;
            transition: transform 0.25s ease;
        }

        .service-title {
            font-size: 14px;
            font-weight: 600;
            color: #1a3b6e;
            margin-bottom: 0;
            line-height: 1.2;
        }

        /* Mobile size fix */
        @media (max-width: 576px) {
            .service-img {
                width: 75px;
                height: 75px;
            }
        }
    </style>
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
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Apply Service</h5>
                                </div>
                            </div>
                            <form class="row g-4" method="post">

                                {{-- <div class="col-md-6">
                                    <input type="hidden" id="customerid" name="customerid" value="{{ $customerid }}">
                                    <label for="input7" class="form-label">Service</label>
                                    <select id="serviceid" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                @foreach ($services as $ser)
                                            <div class="col-6 col-md-3 col-lg-2 mb-4 category_data">
                                                <div class="card service-card h-100">


                                                    <a href="{{ url('/applyservice/' . $ser->id . '/' . $customerid) }}"
                                                        class="service-link">

                                                        <div class="service-content">
                                                            <img src="/upload/service/{{ $ser->service_image }}"
                                                                class="service-img" />

                                                            <p class="service-title">
                                                                {{ $ser->service_name }}
                                                            </p>
                                                        </div>

                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
@endsection
@push('page_scripts')
    <script>

        // $('#serviceid').on('change', function() {
        //     var serviceid = this.value;
        //     var customerid =  $("#customerid").val();
        //         window.location.href = "{{ url('applyservice') }}/"+serviceid+"/"+customerid;

        // });
    </script>
@endpush

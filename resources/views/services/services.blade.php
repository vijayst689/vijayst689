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
                        <h5 class="card-title">Apply Service</h5>
                        <div class="row">
                            <form class="row g-4" method="post">
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
            </div>
        </div>
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

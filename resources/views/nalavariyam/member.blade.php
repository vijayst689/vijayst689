@extends('layouts.app')
@section('content')
    <style>
        /* Compact Premium District Cards */
        .page-content {
            background: #f4f7fc;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
        }

        .district-header {
            background: linear-gradient(135deg, #0d6efd, #00bcd4);
            border-radius: 20px 20px 0 0;
        }

        .district-header-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .district-card {
            background: #fff;
            border: none;
            border-radius: 18px;
            padding: 16px;
            min-height: 90px;
            transition: .3s;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
        }

        .district-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(13, 110, 253, .15);
        }

        .district-card.active {
            background: linear-gradient(135deg, #0d6efd, #00bcd4);
            color: #fff;
        }

        .district-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #eef5ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .district-card.active .district-icon {
            background: rgba(255, 255, 255, .2);
            color: #fff;
        }

        .district-title {
            font-size: 15px;
            font-weight: 700;
        }

        .district-subtitle {
            font-size: 12px;
            color: #6c757d;
        }

        .district-card.active .district-subtitle {
            color: #fff;
        }

        .selectedDistrictBox {
            background: #eef8ff;
            border-left: 5px solid #0d6efd;
            border-radius: 12px;
        }

        .btn-primary {
            border: none;
            background: linear-gradient(135deg, #0d6efd, #00bcd4);
        }

        .btn-success {
            border: none;
        }

        #example2 {
            border-radius: 15px;
            overflow: hidden;
        }

        #example2 thead th {
            background: linear-gradient(135deg, #0d6efd, #00bcd4);
            color: #fff;
            border: none !important;
            padding: 14px;
            font-weight: 600;
        }

        #example2 tbody tr:hover {
            background: #f8fbff;
        }

        .modal-content {
            border: none;
            border-radius: 18px;
        }

        .modal-header {
            background: linear-gradient(135deg, #0d6efd, #00bcd4);
            color: #fff;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }
        /* Force search to stay right */
        .dataTables_wrapper .dataTables_filter {
            float: right !important;
            text-align: right;
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
                {{-- <div class="ms-auto">
                    <button type="button" class="btn-sm btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addcustomer">Add</button>
                </div> --}}
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
                    @php
                        use Illuminate\Support\Facades\DB;

                        $districtIds = [];

                        if (!empty(Auth::user()->nalavariyam_dist_id)) {
                            $districtIds = array_filter(
                                array_map('intval', explode(',', Auth::user()->nalavariyam_dist_id)),
                            );
                        }

                        $districts = DB::table('nalavariyam_district')
                            ->whereIn('id', $districtIds)
                            ->where('status', 'Active')
                            ->orderBy('district_name', 'ASC')
                            ->get();
                    @endphp

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row justify-content-center">
                            <div class="col-12">

                                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                                    <!-- Header -->
                                    <div class="district-header text-white p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="district-header-icon me-3">
                                                <i class="bx bx-map"></i>
                                            </div>
                                            <div>
                                                <h3 class="mb-1 fw-bold text-white fs-4">
                                                    தொழிற்சங்க விபரம்
                                                </h3>
                                                <p class="mb-0 opacity-75 small">
                                                    மாவட்டத்தை தேர்வு செய்து விவரங்களைப் பார்க்கவும்
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Body -->
                                    <div class="card-body p-4 bg-light">

                                        @if ($districts->count() > 0)
                                            <!-- Selected District -->
                                            <div class="mb-3">
                                                <div id="selectedDistrictBox"
                                                    class="selectedDistrictBox alert border-0 shadow-sm rounded-4 py-2 px-3 d-none">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bx bx-check-circle fs-4 text-primary me-2"></i>
                                                        <div class="small">
                                                            <strong>Selected District:</strong>
                                                            <span id="selectedDistrictName"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Compact District Grid -->
                                            <div class="row g-3">
                                                @foreach ($districts as $di)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                                        <button type="button" class="district-card district-select-btn"
                                                            onclick="NalavariyamData(
                                                {{ $di->id }},
                                                '{{ addslashes($di->district_name) }}',
                                                this
                                            )">

                                                            <span class="selected-badge">
                                                                <i class="bx bx-check"></i>
                                                            </span>

                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="district-icon">
                                                                    <i class="bx bx-map-pin"></i>
                                                                </div>

                                                                <div class="flex-grow-1">
                                                                    <div class="district-title">
                                                                        {{ $di->district_name }}
                                                                    </div>
                                                                    <div class="district-subtitle">
                                                                        Click to view
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <!-- Empty State -->
                                            <div class="text-center py-5">
                                                <i class="bx bx-map-alt text-muted mb-3" style="font-size: 70px;"></i>
                                                <h5 class="text-muted mb-2">
                                                    No Active Districts Found
                                                </h5>
                                                <p class="text-muted small mb-0">
                                                    Please contact administrator to activate districts.
                                                </p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="d-flex flex-wrap align-items-center justify-content-lg-end gap-2">

                            <!-- Add Customer Button -->
                            <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#addcustomer">
                                <i class="fas fa-user-plus me-1"></i> Add Customer
                            </button>
                            @if (Auth::user()->user_type_id !=2)
                            <a href="{{ url('additionaldistrict') }}"
                                class="btn btn-success btn-sm px-3 shadow-sm rounded-pill">
                                <i class="fas fa-map-marker-alt me-1"></i> Add District
                            </a>
                            @endif

                        </div>
                        <h5 class="card-title">Member</h5>
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> ID</th>
                                        <th> Full Name</th>
                                        <th> District</th>
                                        <th> Mobile Number</th>
                                        <th> Aadhar Number</th>
                                        <th> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $key => $m)
                                        <tr>
                                            <td>{{ $m->id }}</td>
                                            <td>{{ $m->name }}</td>
                                            <td>{{ $m->district_name }}</td>
                                            <td>{{ $m->phone }}</td>
                                            <td>{{ $m->aadhaar_no }}</td>
                                            <td>{{ $m->status }}</td>
                                            <td>
                                                {{-- <button
                                            onclick="edit_retailer('{{ $m->id }}','{{ $m->name }}','{{ $m->phone }}','{{ $m->aadhaar_no }}','{{ $m->status }}')"
                                            type="button" class="btn-sm btn btn-primary">Edit</button> --}}

                                                <a class="btn btn-sm btn-primary"
                                                    href="{{ url('/online_services', $m->id) }}"><i
                                                        class="fas fa-arrow-circle-right"></i>Services</a>
                                                <!-- <a href="{{ url('/uploads', $m->id) }}" style="font-size: small"
                                                    class="btn-sm btn btn-success">Document</a> -->
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="edit_customer(
                '{{ $m->id }}',
                '{{ $m->name }}',
                '{{ $m->phone }}',
                '{{ $m->aadhaar_no }}',
                '{{ $m->dob }}',
                '{{ $m->status }}',
                '{{ $m->district }}',
                '{{ $m->taluk }}',
                '{{ $m->work_type }}',
                '{{ $m->photo }}',
                '{{ $m->signature }}'
            )">

                                                    UPdate

                                                </button>
                                                <a href="{{ url('/idcard-pdf', $m->id) }}" style="font-size: small"
                                                    class="btn-sm btn btn-info">ID Card</a>
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

        <div class="col-md-6">
            <div class="card-body">
                <div class="modal fade" id="dataaa" tabindex="-1" aria-labelledby="staticBackdropLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">தொழிற்சங்க விபரம்</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <center>
                                    <p><b>தமிழ்நாடு ராம்ஜி கட்டுமானம் மற்றும் அமைப்புசார்ந்த அமைப்புசாரா பொது தொழிலாளர்கள்
                                            நலசங்கம்<br>
                                            பதிவு எண் : 713/KKM </b></p>
                                    <div class="form-group row">
                                        <span><b> இபடிவம் தேதி : <span id="edate" class="text-danger"></span>
                                            </b></span>
                                        <span id="ename"><b> </b></span>
                                        <span id="ephone"><b> </b></span>
                                    </div>

                                </center>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addcustomer" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ url('/addnalavariyam_member') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select required name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($district as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select required name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input required type="text" maxlength="50" class="form-control"
                                                        name="name" placeholder="Full Name" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                    <input required onkeyup="nalavariyam_duplicateaadhar(0)"
                                                        type="text" class="form-control number" name="aadhaar_no"
                                                        id="aadhaar_no" maxlength="12" placeholder="Aadhaar Number" />
                                                    <span id="dupaadhar" style="color:red"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input required onkeyup="nalavariyam_duplicatephone(0)" type="text"
                                                        class="form-control number" name="phone" id="phone"
                                                        maxlength="10" placeholder="Phone" />
                                                    <span id="dupphone" style="color:red"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="phone" class="form-label">
                                                        Date of Birth
                                                    </label>
                                                    <input required type="date" class="form-control number"
                                                        name="dob" placeholder="Date of Birth" />
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="photo" class="form-label">
                                                        Photo
                                                    </label>
                                                    <input class="form-control required" type="file" name="photo">

                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="work_type" class="form-label">
                                                        Work
                                                    </label>
                                                    <select name="work_type" id="work_type" required
                                                        class="form-control">

                                                        <option value="MAFW_1">MAFW - பட்டாசு தொழில்</option>
                                                        <option value="MAFW_2">MAFW - தீப்பெட்டி தொழில்</option>

                                                        <option value="AUTO_1">AUTO - ஆட்டோ ஓட்டுனர்</option>
                                                        <option value="AUTO_2">AUTO - டாக்சி ஓட்டு்னர்</option>

                                                        <option value="AUWO_1">AUWO - ஆட்டோ மொபைல் ஒர்க் ஷாப்</option>

                                                        <option value="COOK_1">COOK - சமையல் வேலை</option>

                                                        <option value="SOES_1">SOES - கடைகளில் பணிபுரிதல்</option>
                                                        <option value="SOES_2">SOES - நிறுவனங்களில் பணிபுரிதல்</option>

                                                        <option value="CATR_1">CATR - உணவு நிறுவனங்கள்</option>

                                                        <option value="STVE_1">STVE - தெரு வியாபாரம்</option>

                                                        <option value="PRLI_1">PRLI - விசைத்தறி தொழில்</option>

                                                        <option value="DOME_1">DOME - வீட்டு வேலைகள்</option>

                                                        <option value="POWO_1">POWO - மண்பாண்ட தொழில்</option>

                                                        <option value="GSAM_1">GSAM - தங்க வௌ்ளி ஆபரணம் தயாரித்தல்</option>

                                                        <option value="ARTS_1">ARTS - ஓவியம் வரைதல்</option>

                                                        <option value="FLGM_1">FLGM - காலணி தயாரித்தல்</option>
                                                        <option value="FLGM_2">FLGM - தோல் பொருட்கள் தயாரித்தல்</option>

                                                        <option value="TALE_1">TALE - தோல் பதனிடுதல்</option>

                                                        <option value="HHSW_1">HHSW - கைத்தறி நெசவுத் தொழில்</option>
                                                        <option value="HHSW_2">HHSW - கைத்தறி பட்டு நெசவுத் தொழில்</option>

                                                        <option value="TREE_1">TREE - மரம் ஏறும் தொழில்</option>

                                                        <option value="NEET_1">NEET - பதனீர் தயாரித்தல்</option>

                                                        <option value="HAND_1">HAND - கைவினைத் தொழில்</option>

                                                        <option value="SCLP_1">SCLP - சிற்ப வேலை செய்தல்</option>

                                                        <option value="VEMA_1">VEMA - பாத்திரங்கள் தயாரித்தல்</option>

                                                        <option value="TAIL_1">TAIL - தையல் தொழில்</option>

                                                        <option value="LAWA_1">LAWA - சலவை துணி துவைத்தல்</option>

                                                        <option value="HRBP_1">HRBP - முடி திருத்துதல்</option>
                                                        <option value="HRBP_2">HRBP - அழகு நிலையங்களில் பணிபுரிதல்</option>

                                                        <option value="GIGW_1">GIGW - இணையம் சார்ந்த கிக் தொழில்கள்
                                                        </option>

                                                        <option value="MSTY_1">MSTY - மேஸ்திரி</option>

                                                        <option value="SAWR_1">SAWR - மரம் அறுப்பவர்</option>

                                                        <option value="CARP_1">CARP - தச்சர்</option>

                                                        <option value="PNTR_1">PNTR - பெயின்டர்</option>
                                                        <option value="PNTR_2">PNTR - வார்னீஷ் பூசுபவர்</option>

                                                        <option value="PNDL_1">PNDL - பந்தல் கட்டுமானம்</option>

                                                        <option value="MSON_1">MSON - கொத்தனார்</option>
                                                        <option value="MSON_2">MSON - செங்கல் அடுக்குபவர்</option>

                                                        <option value="STON_1">STON - கல் உடைப்பவர் </option>
                                                        <option value="STON_2">STON - கல் வெட்டுபவர்</option>
                                                        <option value="STON_3">STON - கல் பொடிப்பவர்</option>

                                                        <option value="ROCK_1">ROCK - quarry கல் உடைப்பவர்</option>

                                                        <option value="ERTH_1">ERTH - மண் வேலை செய்பவர்</option>

                                                        <option value="WATH_1">WATH - காவலாளி</option>

                                                        <option value="WELD_1">WELD - வெல்டர்</option>

                                                        <option value="MZDR_1">MZDR - கூலியாள்</option>

                                                        <option value="HDMZ_1">HDMZ - தலைமை கூலியாள்</option>

                                                        <option value="WELL_1">WELL - கிணறு தோண்டுபவர்</option>

                                                        <option value="MECH_1">MECH - மெக்கானிக்</option>

                                                        <option value="ELCT_1">ELCT - எலக்ட்ரிஷியன்</option>

                                                        <option value="PACK_1">PACK - மரம் வெட்டுபவர்</option>
                                                        <option value="PACK_2">PACK - கல் வெட்டுபவர்</option>

                                                        <option value="MXDR_1">MXDR - மிக்ஸர் டிரைவர்</option>

                                                        <option value="THAT_1">THAT - கூரை வேய்பவர்</option>

                                                        <option value="PUMP_1">PUMP - பம்ப் ஆபரேட்டர்</option>

                                                        <option value="ROLR_1">ROLR - ரோலர் டிரைவர்</option>

                                                        <option value="ENGR_1">ENGR - பொறியியல் தொழில்</option>

                                                        <option value="FOTG_1">FOTG - துணி மடித்தல்</option>

                                                        <option value="GUNI_1">GUNI - சாக்கு தைத்தல்</option>

                                                        <option value="NIBG_1">NIBG - பேனா எழுதுமுனை தயாரித்தல்</option>

                                                        <option value="INCS_1">INCS - அகர்பத்தி தயாரித்தல்</option>

                                                        <option value="PLID_1">PLID - பிளாஸ்டிக் தொழில்</option>

                                                        <option value="LULC_1">LULC - கடைகள் நிறுவனங்களில் சுமை ஏற்றுதல்
                                                        </option>

                                                        <option value="LULT_1">LULT - பொதுத்துறை வாகனத்தில் சுமை ஏற்றுதல்
                                                        </option>

                                                        <option value="SALT_1">SALT - உப்பளங்களில் வேலை செய்தல்</option>

                                                        <option value="BOAT_1">BOAT - படகு தயாரிக்கும் தொழில்</option>

                                                        <option value="TMBR_1">TMBR - மரம் அறுவை</option>

                                                        <option value="COIR_1">COIR - கயிறு தயாரித்தல்</option>

                                                        <option value="SAGO_1">SAGO - ஜவ்வரிசி தயாரித்தல்</option>

                                                        <option value="APLM_1">APLM - அப்பளம் தயாரி்த்தல்</option>

                                                        <option value="BLDY_1">BLDY - சாயப்பட்டறை தொழில்</option>

                                                        <option value="SRCE_1">SRCE - பட்டுப்புழு வளர்த்தல்</option>

                                                        <option value="COPL_1">COPL - தேங்காய் உரித்தல்</option>

                                                        <option value="TOUR_1">TOUR - சுற்றுலா சார்ந்த தொழில்</option>

                                                        <option value="TINC_1">TINC - தகர அமைப்பான்கள் தயாரித்தல்</option>

                                                        <option value="BKCD_1">BKCD - மாட்டு வண்டி</option>

                                                        <option value="SYGM_1">SYGM - சிந்தெடிக் ஜெம் கட்டிங் தொழில்
                                                        </option>

                                                        <option value="LULF_1">LULF - உணவு சேமிப்பு கிடங்கில் தானியங்களை
                                                            கையாளுதல் வகை பிரித்தல்</option>

                                                        <option value="RAPI_1">RAPI - குப்பைகள் கழிவு பொருள் சேகரித்தல்
                                                        </option>

                                                        <option value="PASS_1">PASS - தனியார் பாதுகாவல்</option>

                                                        <option value="PRPR_1">PRPR - அச்சு மற்றும் பிரிண்டிங்</option>

                                                        <option value="BEND_1">BEND - பிட்டர் உட்பட கம்பி வளைப்பவர்
                                                        </option>

                                                        <option value="PMBR_1">PMBR - சாலை குழுாய் பதிப்பு பணி</option>

                                                        <option value="SILT_1">SILT - கிணற்றில் தூர் எடுப்பவர்</option>

                                                        <option value="HAMR_1">HAMR - கருமான் (சம்மட்டி ஆள்)</option>

                                                        <option value="BLAK_1">BLAK - கருமான் கொள்ளன்</option>

                                                        <option value="LIES_1">LIES - மின் தூக்கி மற்றும் மின்படி
                                                            பொருத்துதல்</option>

                                                        <option value="MIXR_1">MIXR - கான்கிரீட் கலப்பவர்</option>

                                                        <option value="TUNL_1">TUNL - சுரங்க வழி தோண்டுபவர்</option>

                                                        <option value="MSIC_1">MSIC - மொசைக் பாலீஷ் செய்பவர்</option>

                                                        <option value="ROAD_1">ROAD - சாலை செப்பனிடுதல்</option>

                                                        <option value="CIGR_1">CIGR - சுருட்டுத் தயாரித்தல்</option>

                                                        <option value="CASH_1">CASH - முந்திரி தொழுிற்சாலைகளில் பணிபுரிதல்
                                                        </option>

                                                        <option value="VIPH_1">VIPH - வீடியோ மற்றும் புகைப்பட ஒளிப்பதிவு
                                                        </option>

                                                        <option value="CYCL_1">CYCL - சைக்கிள் ரிக்ஷா ஓட்டும் தொழில்
                                                        </option>

                                                        <option value="SDLT_1">SDLT - ஒலி ,ஒளிஅமைப்புத் தொழில்</option>

                                                        <option value="CYRE_1">CYRE - சைக்கிள் ரிப்போ்</option>

                                                        <option value="WASI_1">WASI - வார்த்து வடித்தல்</option>

                                                        <option value="LPGC_1">LPGC - சமையல் வாயு சிலிண்டர்கள்
                                                            விநியோகித்தல்</option>

                                                        <option value="ELSR_1">ELSR - எலக்ட்ரானிக் பழுதுபார்த்தல்</option>

                                                        <option value="FOPR_1">FOPR - வனப்பொருள் சேகரித்தல்</option>

                                                        <option value="FORD_1">FORD - மாவுமில்களில் பணிபுரிதல்</option>
                                                        <option value="FORD_2">FORD - ஆயில் மில்களில் பணிபுரிதல்</option>
                                                        <option value="FORD_3">FORD - அரிசி மில்களில் பணிபுரிதல்</option>

                                                        <option value="WOWO_1">WOWO - மர வேலைகள்</option>

                                                        <option value="PWTL_1">PWTL - பொது பூங்கா அமைத்தல்</option>
                                                        <option value="PWTL_2">PWTL - நடைபாதை போன்ற கட்டுமானம் காட்சி
                                                            அமைத்தல்</option>
                                                        <option value="PWTL_3">PWTL - பொது பூங்கா, நடைபாதை போன்ற கட்டுமானம்
                                                            மற்றும் இயற்கை நிலை காட்சி அமைத்தல்</option>

                                                        <option value="SPRY_1">SPRY - தௌிப்பவர் (தார் ஜல்லி)</option>
                                                        <option value="SPRY_2">SPRY - கலப்பவர் (தார் ஜல்லி)</option>

                                                        <option value="LIME_1">LIME - சுண்ணாம்பு பதப்படுத்துவோர்</option>

                                                        <option value="SEAE_1">SEAE - கடல் அரிப்பு தடுப்பு பணியில் ஈடுபடும்
                                                            வேலையாள்</option>

                                                        <option value="ROFN_1">ROFN - ரோட்டரி மற்றும் செயற்கை நீரூற்று
                                                            போன்ற கட்டுமானம்</option>

                                                        <option value="FFSM_1">FFSM - தீயணைப்பு கருவிகளை பொரூத்துதல்
                                                        </option>
                                                        <option value="FFSM_2">FFSM - தீயணைப்பு கருவிகளை பழுதுபார்த்தல்
                                                        </option>

                                                        <option value="COHE_1">COHE - குளிரூட்டுதல் கருவிகளை பழுதுபார்த்தல்
                                                        </option>
                                                        <option value="COHE_2">COHE - குளிரூட்டுதல் கருவிகளை பொருத்துதல்
                                                        </option>
                                                        <option value="COHE_3">COHE - சூடுபடுத்துதல் கருவிகளை
                                                            பழுதுபார்த்தல்</option>
                                                        <option value="COHE_4">COHE - சூடுபடுத்துதல் கருவிகளை பொருத்துதல்
                                                        </option>

                                                        <option value="SGDS_1">SGDS - பாதுகாப்பு கதவுகள் பொருத்துதல்
                                                        </option>
                                                        <option value="SGDS_2">SGDS - பாதுகாப்பு கருவிகள் பொருத்துதல்
                                                        </option>

                                                        <option value="CAUK_1">CAUK - சந்துகள் அடைத்து நீர் உட்புகாமல்
                                                            செய்பவர்</option>

                                                        <option value="WHVS_1">WHVS - நீர் எடுக்கும் கட்டமைப்பு தொடர்பான
                                                            கட்டுமானம்</option>

                                                        <option value="KALS_1">KALS - கலாசிஸ்</option>

                                                        <option value="MRBL_1">MRBL - சலவைக்கல் தொழில் செய்பவர்</option>

                                                        <option value="DEMN_1">DEMN - Demolition worker engaged in dams
                                                        </option>
                                                        <option value="DEMN_2">DEMN - Demolition worker engaged in bridges
                                                        </option>
                                                        <option value="DEMN_3">DEMN - Demolition worker engaged in roads
                                                        </option>
                                                        <option value="DEMN_4">DEMN - Demolition worker engaged in any
                                                            other building</option>

                                                        <option value="BRIK_1">BRIK - தொழிற்சாலைசட்டதின்கீழ் வராத செங்கல்
                                                            சூளை தொழிலாளர்கள்</option>

                                                        <option value="IGWD_1">IGWD - இரும்பு மற்றும் உ‌‌லோக கிராதி,
                                                            ஜன்னல், கதவுகள் புனைத்து கட்டுதல் மற்றும் பொருத்துதல்</option>

                                                        <option value="CGGP_1">CGGP - கண்ணா‌‌டி வெட்டுதல்</option>
                                                        <option value="CGGP_2">CGGP - கண்ணா‌‌டி இழைத்தல்</option>
                                                        <option value="CGGP_3">CGGP - கண்ணா‌டி பேனல்கள் பொருத்துதல்
                                                        </option>

                                                        <option value="EESP_1">EESP - சோலார் பேனல் போன்ற மின் மிகை
                                                            சாதனங்கள் பொருத்துதல்</option>

                                                        <option value="ESRS_1">ESRS - கல் பெயர் பலகை அமைத்தல்</option>
                                                        <option value="ESRS_2">ESRS - தெரு அரைகலன்கள் அமைத்தல்</option>
                                                        <option value="ESRS_3">ESRS - பேருந்து நிழற்கூரை அமைத்தல்</option>
                                                        <option value="ESRS_4">ESRS - பேருந்து பணிமனைகள் அமைத்தல்</option>
                                                        <option value="ESRS_5">ESRS - பேருந்து நிறுத்தங்கள் அமைத்தல்
                                                            மற்றும் அறிவிப்பு போன்ற கட்டுமானம் மற்றும் நிறுத்துதல்</option>
                                                        <option value="ESRS_6">ESRS - பேருந்து அறிவிப்பு போன்ற கட்டுமானம்
                                                            மற்றும் நிறுத்துதல்</option>

                                                        <option value="OTHR_1">OTHR - எல்லாவிதமான கட்டுமானப் பணிகளையும்
                                                            செய்யும் தொழுிலாளர்கள்</option>
                                                        <option value="OTHR_2">OTHR - அணை, பாலம், சாலை போன்றவற்றின
                                                            பராமரிப்பு பணிகளை செய்யும் தொழுிலாளர்கள்</option>

                                                        <option value="PFCM_1">PFCM - முன் புனைத்து அமைக்கப்பட்ட கான்கிரீட்
                                                            பொருட்கள் பொருத்தல்</option>

                                                        <option value="SPGC_1">SPGC - கோல்ப் மைதானம் அமைத்தல்</option>
                                                        <option value="SPGC_2">SPGC - நீச்சல் குளம் உட்பட்ட விளையாட்டு
                                                            மற்றும் பொழுதுபோக்கு அரங்குகளை கட்டுதல்</option>

                                                        <option value="CFCP_1">CFCP - கார்பெட்‌‌டிங்</option>
                                                        <option value="CFCP_2">CFCP - பொய்கூரை அமைத்தல்</option>
                                                        <option value="CFCP_3">CFCP - மேற்பூச்சுதல் தொடர்பான உள்ளலங்காரம்.
                                                        </option>
                                                        <option value="CFCP_4">CFCP - விளக்கு அமைத்தல்</option>

                                                        <option value="MOKN_1">MOKN - சமையல் கூடம் போன்ற இடங்களில் நவீன
                                                            அறைகலன் அமைத்தல்</option>

                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="signature" class="form-label">
                                                        Signature
                                                    </label>
                                                    <input class="form-control required" type="file" name="signature">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button id="save" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">

                            <form action="{{ url('/updatenalavariyam_member') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" id="cusid">

                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Edit Customer
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <!-- LEFT -->
                                        <div class="col-md-6">

                                            <!-- DISTRICT -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    District
                                                </label>

                                                <select required name="dist_id" id="editdist_id" class="form-control">

                                                    <option value="">
                                                        Select District
                                                    </option>

                                                    @foreach ($district as $d)
                                                        <option value="{{ $d->id }}">
                                                            {{ $d->district_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!-- TALUK -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Taluk
                                                </label>

                                                <select required name="taluk_id" id="edittaluk" class="form-control">
                                                </select>
                                            </div>

                                            <!-- NAME -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Full Name
                                                </label>

                                                <input required type="text" maxlength="50" class="form-control"
                                                    name="name" id="editname">
                                            </div>

                                            <!-- AADHAR -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Aadhaar Number
                                                </label>

                                                <input required type="text" class="form-control number"
                                                    name="aadhaar_no" id="editadhar" maxlength="12">
                                            </div>

                                            <!-- PHONE -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Phone
                                                </label>

                                                <input required type="text" class="form-control number" name="phone"
                                                    id="editphone" maxlength="10">
                                            </div>

                                        </div>

                                        <!-- RIGHT -->
                                        <div class="col-md-6">

                                            <!-- DOB -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">
                                                    Date of Birth
                                                </label>

                                                <input required type="date" class="form-control" name="dob"
                                                    id="editdob">
                                            </div>

                                            <!-- PHOTO -->
                                            <div class="form-group mb-3">

                                                <label class="form-label">
                                                    Photo
                                                </label>

                                                <input type="file" class="form-control" name="photo">

                                                <div class="mt-2" id="editPhotoPreview"></div>

                                            </div>

                                            <!-- WORK -->
                                            <div class="form-group mb-3">

                                                <label class="form-label">
                                                    Work
                                                </label>

                                                <select required name="work_type" id="editworktype" class="form-control">

                                                    <option value="">-- தொழிலை தேர்வு செய்யவும் --</option>


                                                    <option value="MAFW_1">MAFW - பட்டாசு தொழில்</option>
                                                    <option value="MAFW_2">MAFW - தீப்பெட்டி தொழில்</option>

                                                    <option value="AUTO_1">AUTO - ஆட்டோ ஓட்டுனர்</option>
                                                    <option value="AUTO_2">AUTO - டாக்சி ஓட்டு்னர்</option>

                                                    <option value="AUWO_1">AUWO - ஆட்டோ மொபைல் ஒர்க் ஷாப்</option>

                                                    <option value="COOK_1">COOK - சமையல் வேலை</option>

                                                    <option value="SOES_1">SOES - கடைகளில் பணிபுரிதல்</option>
                                                    <option value="SOES_2">SOES - நிறுவனங்களில் பணிபுரிதல்</option>

                                                    <option value="CATR_1">CATR - உணவு நிறுவனங்கள்</option>

                                                    <option value="STVE_1">STVE - தெரு வியாபாரம்</option>

                                                    <option value="PRLI_1">PRLI - விசைத்தறி தொழில்</option>

                                                    <option value="DOME_1">DOME - வீட்டு வேலைகள்</option>

                                                    <option value="POWO_1">POWO - மண்பாண்ட தொழில்</option>

                                                    <option value="GSAM_1">GSAM - தங்க வௌ்ளி ஆபரணம் தயாரித்தல்</option>

                                                    <option value="ARTS_1">ARTS - ஓவியம் வரைதல்</option>

                                                    <option value="FLGM_1">FLGM - காலணி தயாரித்தல்</option>
                                                    <option value="FLGM_2">FLGM - தோல் பொருட்கள் தயாரித்தல்</option>

                                                    <option value="TALE_1">TALE - தோல் பதனிடுதல்</option>

                                                    <option value="HHSW_1">HHSW - கைத்தறி நெசவுத் தொழில்</option>
                                                    <option value="HHSW_2">HHSW - கைத்தறி பட்டு நெசவுத் தொழில்</option>

                                                    <option value="TREE_1">TREE - மரம் ஏறும் தொழில்</option>

                                                    <option value="NEET_1">NEET - பதனீர் தயாரித்தல்</option>

                                                    <option value="HAND_1">HAND - கைவினைத் தொழில்</option>

                                                    <option value="SCLP_1">SCLP - சிற்ப வேலை செய்தல்</option>

                                                    <option value="VEMA_1">VEMA - பாத்திரங்கள் தயாரித்தல்</option>

                                                    <option value="TAIL_1">TAIL - தையல் தொழில்</option>

                                                    <option value="LAWA_1">LAWA - சலவை துணி துவைத்தல்</option>

                                                    <option value="HRBP_1">HRBP - முடி திருத்துதல்</option>
                                                    <option value="HRBP_2">HRBP - அழகு நிலையங்களில் பணிபுரிதல்</option>

                                                    <option value="GIGW_1">GIGW - இணையம் சார்ந்த கிக் தொழில்கள்</option>

                                                    <option value="MSTY_1">MSTY - மேஸ்திரி</option>

                                                    <option value="SAWR_1">SAWR - மரம் அறுப்பவர்</option>

                                                    <option value="CARP_1">CARP - தச்சர்</option>

                                                    <option value="PNTR_1">PNTR - பெயின்டர்</option>
                                                    <option value="PNTR_2">PNTR - வார்னீஷ் பூசுபவர்</option>

                                                    <option value="PNDL_1">PNDL - பந்தல் கட்டுமானம்</option>

                                                    <option value="MSON_1">MSON - கொத்தனார்</option>
                                                    <option value="MSON_2">MSON - செங்கல் அடுக்குபவர்</option>

                                                    <option value="STON_1">STON - கல் உடைப்பவர் </option>
                                                    <option value="STON_2">STON - கல் வெட்டுபவர்</option>
                                                    <option value="STON_3">STON - கல் பொடிப்பவர்</option>

                                                    <option value="ROCK_1">ROCK - quarry கல் உடைப்பவர்</option>

                                                    <option value="ERTH_1">ERTH - மண் வேலை செய்பவர்</option>

                                                    <option value="WATH_1">WATH - காவலாளி</option>

                                                    <option value="WELD_1">WELD - வெல்டர்</option>

                                                    <option value="MZDR_1">MZDR - கூலியாள்</option>

                                                    <option value="HDMZ_1">HDMZ - தலைமை கூலியாள்</option>

                                                    <option value="WELL_1">WELL - கிணறு தோண்டுபவர்</option>

                                                    <option value="MECH_1">MECH - மெக்கானிக்</option>

                                                    <option value="ELCT_1">ELCT - எலக்ட்ரிஷியன்</option>

                                                    <option value="PACK_1">PACK - மரம் வெட்டுபவர்</option>
                                                    <option value="PACK_2">PACK - கல் வெட்டுபவர்</option>

                                                    <option value="MXDR_1">MXDR - மிக்ஸர் டிரைவர்</option>

                                                    <option value="THAT_1">THAT - கூரை வேய்பவர்</option>

                                                    <option value="PUMP_1">PUMP - பம்ப் ஆபரேட்டர்</option>

                                                    <option value="ROLR_1">ROLR - ரோலர் டிரைவர்</option>

                                                    <option value="ENGR_1">ENGR - பொறியியல் தொழில்</option>

                                                    <option value="FOTG_1">FOTG - துணி மடித்தல்</option>

                                                    <option value="GUNI_1">GUNI - சாக்கு தைத்தல்</option>

                                                    <option value="NIBG_1">NIBG - பேனா எழுதுமுனை தயாரித்தல்</option>

                                                    <option value="INCS_1">INCS - அகர்பத்தி தயாரித்தல்</option>

                                                    <option value="PLID_1">PLID - பிளாஸ்டிக் தொழில்</option>

                                                    <option value="LULC_1">LULC - கடைகள் நிறுவனங்களில் சுமை ஏற்றுதல்
                                                    </option>

                                                    <option value="LULT_1">LULT - பொதுத்துறை வாகனத்தில் சுமை ஏற்றுதல்
                                                    </option>

                                                    <option value="SALT_1">SALT - உப்பளங்களில் வேலை செய்தல்</option>

                                                    <option value="BOAT_1">BOAT - படகு தயாரிக்கும் தொழில்</option>

                                                    <option value="TMBR_1">TMBR - மரம் அறுவை</option>

                                                    <option value="COIR_1">COIR - கயிறு தயாரித்தல்</option>

                                                    <option value="SAGO_1">SAGO - ஜவ்வரிசி தயாரித்தல்</option>

                                                    <option value="APLM_1">APLM - அப்பளம் தயாரி்த்தல்</option>

                                                    <option value="BLDY_1">BLDY - சாயப்பட்டறை தொழில்</option>

                                                    <option value="SRCE_1">SRCE - பட்டுப்புழு வளர்த்தல்</option>

                                                    <option value="COPL_1">COPL - தேங்காய் உரித்தல்</option>

                                                    <option value="TOUR_1">TOUR - சுற்றுலா சார்ந்த தொழில்</option>

                                                    <option value="TINC_1">TINC - தகர அமைப்பான்கள் தயாரித்தல்</option>

                                                    <option value="BKCD_1">BKCD - மாட்டு வண்டி</option>

                                                    <option value="SYGM_1">SYGM - சிந்தெடிக் ஜெம் கட்டிங் தொழில்</option>

                                                    <option value="LULF_1">LULF - உணவு சேமிப்பு கிடங்கில் தானியங்களை
                                                        கையாளுதல் வகை பிரித்தல்</option>

                                                    <option value="RAPI_1">RAPI - குப்பைகள் கழிவு பொருள் சேகரித்தல்
                                                    </option>

                                                    <option value="PASS_1">PASS - தனியார் பாதுகாவல்</option>

                                                    <option value="PRPR_1">PRPR - அச்சு மற்றும் பிரிண்டிங்</option>

                                                    <option value="BEND_1">BEND - பிட்டர் உட்பட கம்பி வளைப்பவர்</option>

                                                    <option value="PMBR_1">PMBR - சாலை குழுாய் பதிப்பு பணி</option>

                                                    <option value="SILT_1">SILT - கிணற்றில் தூர் எடுப்பவர்</option>

                                                    <option value="HAMR_1">HAMR - கருமான் (சம்மட்டி ஆள்)</option>

                                                    <option value="BLAK_1">BLAK - கருமான் கொள்ளன்</option>

                                                    <option value="LIES_1">LIES - மின் தூக்கி மற்றும் மின்படி பொருத்துதல்
                                                    </option>

                                                    <option value="MIXR_1">MIXR - கான்கிரீட் கலப்பவர்</option>

                                                    <option value="TUNL_1">TUNL - சுரங்க வழி தோண்டுபவர்</option>

                                                    <option value="MSIC_1">MSIC - மொசைக் பாலீஷ் செய்பவர்</option>

                                                    <option value="ROAD_1">ROAD - சாலை செப்பனிடுதல்</option>

                                                    <option value="CIGR_1">CIGR - சுருட்டுத் தயாரித்தல்</option>

                                                    <option value="CASH_1">CASH - முந்திரி தொழுிற்சாலைகளில் பணிபுரிதல்
                                                    </option>

                                                    <option value="VIPH_1">VIPH - வீடியோ மற்றும் புகைப்பட ஒளிப்பதிவு
                                                    </option>

                                                    <option value="CYCL_1">CYCL - சைக்கிள் ரிக்ஷா ஓட்டும் தொழில்</option>

                                                    <option value="SDLT_1">SDLT - ஒலி ,ஒளிஅமைப்புத் தொழில்</option>

                                                    <option value="CYRE_1">CYRE - சைக்கிள் ரிப்போ்</option>

                                                    <option value="WASI_1">WASI - வார்த்து வடித்தல்</option>

                                                    <option value="LPGC_1">LPGC - சமையல் வாயு சிலிண்டர்கள் விநியோகித்தல்
                                                    </option>

                                                    <option value="ELSR_1">ELSR - எலக்ட்ரானிக் பழுதுபார்த்தல்</option>

                                                    <option value="FOPR_1">FOPR - வனப்பொருள் சேகரித்தல்</option>

                                                    <option value="FORD_1">FORD - மாவுமில்களில் பணிபுரிதல்</option>
                                                    <option value="FORD_2">FORD - ஆயில் மில்களில் பணிபுரிதல்</option>
                                                    <option value="FORD_3">FORD - அரிசி மில்களில் பணிபுரிதல்</option>

                                                    <option value="WOWO_1">WOWO - மர வேலைகள்</option>

                                                    <option value="PWTL_1">PWTL - பொது பூங்கா அமைத்தல்</option>
                                                    <option value="PWTL_2">PWTL - நடைபாதை போன்ற கட்டுமானம் காட்சி அமைத்தல்
                                                    </option>
                                                    <option value="PWTL_3">PWTL - பொது பூங்கா, நடைபாதை போன்ற கட்டுமானம்
                                                        மற்றும் இயற்கை நிலை காட்சி அமைத்தல்</option>

                                                    <option value="SPRY_1">SPRY - தௌிப்பவர் (தார் ஜல்லி)</option>
                                                    <option value="SPRY_2">SPRY - கலப்பவர் (தார் ஜல்லி)</option>

                                                    <option value="LIME_1">LIME - சுண்ணாம்பு பதப்படுத்துவோர்</option>

                                                    <option value="SEAE_1">SEAE - கடல் அரிப்பு தடுப்பு பணியில் ஈடுபடும்
                                                        வேலையாள்</option>

                                                    <option value="ROFN_1">ROFN - ரோட்டரி மற்றும் செயற்கை நீரூற்று போன்ற
                                                        கட்டுமானம்</option>

                                                    <option value="FFSM_1">FFSM - தீயணைப்பு கருவிகளை பொரூத்துதல்</option>
                                                    <option value="FFSM_2">FFSM - தீயணைப்பு கருவிகளை பழுதுபார்த்தல்
                                                    </option>

                                                    <option value="COHE_1">COHE - குளிரூட்டுதல் கருவிகளை பழுதுபார்த்தல்
                                                    </option>
                                                    <option value="COHE_2">COHE - குளிரூட்டுதல் கருவிகளை பொருத்துதல்
                                                    </option>
                                                    <option value="COHE_3">COHE - சூடுபடுத்துதல் கருவிகளை பழுதுபார்த்தல்
                                                    </option>
                                                    <option value="COHE_4">COHE - சூடுபடுத்துதல் கருவிகளை பொருத்துதல்
                                                    </option>

                                                    <option value="SGDS_1">SGDS - பாதுகாப்பு கதவுகள் பொருத்துதல்</option>
                                                    <option value="SGDS_2">SGDS - பாதுகாப்பு கருவிகள் பொருத்துதல்</option>

                                                    <option value="CAUK_1">CAUK - சந்துகள் அடைத்து நீர் உட்புகாமல் செய்பவர்
                                                    </option>

                                                    <option value="WHVS_1">WHVS - நீர் எடுக்கும் கட்டமைப்பு தொடர்பான
                                                        கட்டுமானம்</option>

                                                    <option value="KALS_1">KALS - கலாசிஸ்</option>

                                                    <option value="MRBL_1">MRBL - சலவைக்கல் தொழில் செய்பவர்</option>

                                                    <option value="DEMN_1">DEMN - Demolition worker engaged in dams
                                                    </option>
                                                    <option value="DEMN_2">DEMN - Demolition worker engaged in bridges
                                                    </option>
                                                    <option value="DEMN_3">DEMN - Demolition worker engaged in roads
                                                    </option>
                                                    <option value="DEMN_4">DEMN - Demolition worker engaged in any other
                                                        building</option>

                                                    <option value="BRIK_1">BRIK - தொழிற்சாலைசட்டதின்கீழ் வராத செங்கல் சூளை
                                                        தொழிலாளர்கள்</option>

                                                    <option value="IGWD_1">IGWD - இரும்பு மற்றும் உ‌‌லோக கிராதி, ஜன்னல்,
                                                        கதவுகள் புனைத்து கட்டுதல் மற்றும் பொருத்துதல்</option>

                                                    <option value="CGGP_1">CGGP - கண்ணா‌‌டி வெட்டுதல்</option>
                                                    <option value="CGGP_2">CGGP - கண்ணா‌‌டி இழைத்தல்</option>
                                                    <option value="CGGP_3">CGGP - கண்ணா‌டி பேனல்கள் பொருத்துதல்</option>

                                                    <option value="EESP_1">EESP - சோலார் பேனல் போன்ற மின் மிகை சாதனங்கள்
                                                        பொருத்துதல்</option>

                                                    <option value="ESRS_1">ESRS - கல் பெயர் பலகை அமைத்தல்</option>
                                                    <option value="ESRS_2">ESRS - தெரு அரைகலன்கள் அமைத்தல்</option>
                                                    <option value="ESRS_3">ESRS - பேருந்து நிழற்கூரை அமைத்தல்</option>
                                                    <option value="ESRS_4">ESRS - பேருந்து பணிமனைகள் அமைத்தல்</option>
                                                    <option value="ESRS_5">ESRS - பேருந்து நிறுத்தங்கள் அமைத்தல் மற்றும்
                                                        அறிவிப்பு போன்ற கட்டுமானம் மற்றும் நிறுத்துதல்</option>
                                                    <option value="ESRS_6">ESRS - பேருந்து அறிவிப்பு போன்ற கட்டுமானம்
                                                        மற்றும் நிறுத்துதல்</option>

                                                    <option value="OTHR_1">OTHR - எல்லாவிதமான கட்டுமானப் பணிகளையும்
                                                        செய்யும் தொழுிலாளர்கள்</option>
                                                    <option value="OTHR_2">OTHR - அணை, பாலம், சாலை போன்றவற்றின பராமரிப்பு
                                                        பணிகளை செய்யும் தொழுிலாளர்கள்</option>

                                                    <option value="PFCM_1">PFCM - முன் புனைத்து அமைக்கப்பட்ட கான்கிரீட்
                                                        பொருட்கள் பொருத்தல்</option>

                                                    <option value="SPGC_1">SPGC - கோல்ப் மைதானம் அமைத்தல்</option>
                                                    <option value="SPGC_2">SPGC - நீச்சல் குளம் உட்பட்ட விளையாட்டு மற்றும்
                                                        பொழுதுபோக்கு அரங்குகளை கட்டுதல்</option>

                                                    <option value="CFCP_1">CFCP - கார்பெட்‌‌டிங்</option>
                                                    <option value="CFCP_2">CFCP - பொய்கூரை அமைத்தல்</option>
                                                    <option value="CFCP_3">CFCP - மேற்பூச்சுதல் தொடர்பான உள்ளலங்காரம்.
                                                    </option>
                                                    <option value="CFCP_4">CFCP - விளக்கு அமைத்தல்</option>

                                                    <option value="MOKN_1">MOKN - சமையல் கூடம் போன்ற இடங்களில் நவீன அறைகலன்
                                                        அமைத்தல்</option>

                                                </select>

                                            </div>

                                            <!-- SIGNATURE -->
                                            <div class="form-group mb-3">

                                                <label class="form-label">
                                                    Signature
                                                </label>

                                                <input type="file" class="form-control" name="signature">

                                                <div class="mt-2" id="editSignaturePreview"></div>

                                            </div>

                                            <!-- STATUS -->
                                            <div class="form-group mb-3">

                                                <label class="form-label">
                                                    Status
                                                </label>

                                                <select name="status" id="editstatus" class="form-control">

                                                    <option value="Active">
                                                        Active
                                                    </option>

                                                    <option value="Inactive">
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        Update Customer
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('page_scripts')
        <script>
            function edit_customer(
                id,
                name,
                phone,
                aadhaar_no,
                dob,
                status,
                dist_id,
                taluk_id,
                work_type,
                photo,
                signature
            ) {

                $("#cusid").val(id);
                $("#editname").val(name);
                $("#editphone").val(phone);
                $("#editadhar").val(aadhaar_no);
                $("#editdob").val(dob);
                $("#editstatus").val(status);
                $("#editdist_id").val(dist_id);
                $("#editworktype").val(work_type);

                // PHOTO PREVIEW
                if (photo != '') {

                    $("#editPhotoPreview").html(`
            <img src="/upload/nalavariyam_document/photo/${photo}"
                 width="80"
                 class="img-thumbnail">
        `);

                } else {

                    $("#editPhotoPreview").html('');

                }

                // SIGNATURE PREVIEW
                if (signature != '') {

                    $("#editSignaturePreview").html(`
            <img src="/upload/nalavariyam_document/signature/${signature}"
                 width="120"
                 class="img-thumbnail">
        `);

                } else {

                    $("#editSignaturePreview").html('');

                }

                // LOAD TALUK
                $.ajax({

                    url: "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id,
                    type: "GET",

                    success: function(result) {

                        $('#edittaluk').html('');

                        $.each(result, function(key, value) {

                            let selected = value.id == taluk_id ? 'selected' : '';

                            $("#edittaluk").append(`
                    <option value="${value.id}" ${selected}>
                        ${value.taluk_name}
                    </option>
                `);

                        });

                    }

                });

                $("#editcustomer").modal('show');

            }

            $('#editdist_id').on('change', function() {

                var dist_id = this.value;

                $.ajax({

                    url: "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id,
                    type: "GET",

                    success: function(result) {

                        $('#edittaluk').html('');

                        $.each(result, function(key, value) {

                            $("#edittaluk").append(
                                '<option value="' + value.id + '">' +
                                value.taluk_name +
                                '</option>'
                            );

                        });

                    }

                });

            });

            $('#dist_id').on('change', function() {
                var dist_id = this.value;
                $("#taluk").html('');
                var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                        $.each(result, function(key, value) {
                            $("#taluk").append('<option value="' + value
                                .id + '">' + value.taluk_name + '</option>');
                        });
                        $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                    }
                });
            });


            function nalavariyam_duplicateaadhar(id) {
                var aadhaar_no = $("#aadhaar_no").val().trim();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "post",
                    url: '{{ url('nalavariyam_checkaadhar') }}',
                    data: {
                        id: id,
                        aadhaar_no: aadhaar_no,
                        _token: _token
                    },

                    success: function(res) {
                        console.log(res);
                        if (res.exists) {
                            $("#save").prop('disabled', true);
                            $("#dupaadhar").html("aadhar no alredy exists!");
                        } else {
                            $("#dupaadhar").html("");
                        }
                        if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                            $("#save").prop('disabled', false);
                        } else {
                            $("#save").prop('disabled', true);
                        }
                    },
                    error: function(jqXHR, exception) {
                        console.log(exception);
                    }
                });
            }

            function nalavariyam_duplicatephone(id) {
                var phone = $("#phone").val().trim();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "post",
                    url: '{{ url('nalavariyam_checkphone') }}',
                    data: {
                        id: id,
                        phone: phone,
                        _token: _token
                    },

                    success: function(res) {
                        if (res.exists) {
                            $("#save").prop('disabled', true);
                            $("#dupphone").html("mobile no alredy exists!");
                        } else {
                            $("#dupphone").html("");
                        }
                        if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                            $("#save").prop('disabled', false);
                        } else {
                            $("#save").prop('disabled', true);
                        }
                    },

                    error: function(jqXHR, exception) {
                        console.log(exception);
                    }
                });
            }

            function NalavariyamData(dist_id, district_name, button) {

                // Remove active class from all buttons
                $('.district-select-btn').removeClass('active');

                // Add active class to selected button
                $(button).addClass('active');

                // Show selected district name
                $('#selectedDistrictName').text(district_name);
                $('#selectedDistrictBox').removeClass('d-none');

                // Save original content
                var originalHtml = $(button).html();

                // Loading state
                $(button)
                    .prop('disabled', true)
                    .html(`
            <div class="d-flex justify-content-center align-items-center py-3">
                <span class="spinner-border spinner-border-sm me-2"></span>
                Loading...
            </div>
        `);

                $.ajax({
                    url: "{{ url('/getnalavariyam_data') }}/" + dist_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        // Restore button and keep active state
                        $(button)
                            .prop('disabled', false)
                            .html(originalHtml)
                            .addClass('active');

                        if (data.message === "Success") {
                            $('#district_name').html(district_name);
                            $('#edate').html(data.e_form_date || '');
                            $('#ename').html(data.full_name || '');
                            $('#ephone').html(data.phone || '');
                            $('#dataaa').modal('show');
                        } else {
                            alert('No data found for selected district.');
                        }
                    },
                    error: function() {

                        // Restore button and keep active state
                        $(button)
                            .prop('disabled', false)
                            .html(originalHtml)
                            .addClass('active');

                        alert('Unable to fetch data. Please try again.');
                    }
                });
            }
        </script>
    @endpush

@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<style>
/* body{
    background:#eef3f8;
    font-family:'Inter',sans-serif;
} */

.form-control{
    height:58px;
    border-radius:16px !important;
}

#card-front-hd,
#card-back-hd{
    display:block !important;
    visibility:visible !important;
    opacity:1 !important;
    background:#ffffff;
}


.table td,
.table th{
    vertical-align:middle;
    padding:16px;
}

.table-hover tbody tr:hover{
    background:#f0fff4;
    transition:0.3s;
}

.card{
    border-radius:22px;
}

.btn{
    border-radius:14px !important;
}

.input-group{
    border-radius:16px;
    overflow:hidden;
    background:#fff;
}

.input-group-text{
    border:none;
}

    .form-label { font-weight: 600; color: #334155; margin-bottom: 4px; font-size: 13px; }

    /* --- CARD DESIGN CSS (Inside Modal) --- */
    .preview-container { display: flex; flex-direction: row; flex-wrap: wrap; gap: 20px; justify-content: center; align-items: center; padding: 20px; background: transparent; border-radius: 15px; }
    .card-box { width: 450px; min-width: 450px; height: 284px; position: relative; overflow: hidden; background-color: #ffffff; box-sizing: border-box; image-rendering: -webkit-optimize-contrast; background-size: 100% 100%; box-shadow: 0 4px 10px rgba(0,0,0,0.2); margin: 0 auto; }
    .bg-img { position: absolute; top: 0; left: 0; width: 450px; height: 284px; z-index: 1; }
    .content-layer { position: relative; z-index: 10; width: 450px; height: 284px; }
/* HEADER */

.f-gov { position: absolute; top: 30px; width: 100%; text-align: center; font-size: 15px; font-weight: 800; color: #0a6628; font-family: 'Poppins', sans-serif; letter-spacing: 0.5px; z-index: 15; }

    /* Front Side Elements */
    .f-photo { position: absolute; top: 82px; left: 35px; width: 98px; height: 122px; border: none; object-fit: cover; border-radius: 4px; background: transparent; z-index: 10; padding: 0; margin: 0; }
    .f-data { position: absolute; top: 70px; left: 160px; width: 220px; text-align: left; line-height: 1.35; color: #111; z-index: 10; }
    
    .f-row { font-size: 11px; display: flex; align-items: flex-start; margin-bottom: 3px; }
    .f-lbl { font-weight: 700; width: 68px; flex-shrink: 0; color: #000; }
    .f-val { font-weight: 600; color: #222; }
    .f-gj { font-family: 'Baloo 2', cursive; font-weight: 600; font-size: 13px; margin-bottom: 2px; }
    
    /* QR Code Box */
    .f-qr { position: absolute; top: 142px; right: 28px; width: 86px; height: 88px; border: none; background: transparent; padding: 0; margin: 0; z-index: 15; object-fit: contain; }
    .f-id { position: absolute; bottom: 43px; width: 92%; text-align: center; font-size: 18px; font-weight: 800; color: #0a6628; font-family: 'Poppins', sans-serif; letter-spacing: 0.5px; z-index: 15; }
    .f-registry { position: absolute; bottom: 11px; width: 100%; text-align: center; font-size: 14px; font-weight: 800; color: #000; font-family: 'Poppins', sans-serif; letter-spacing: 0.5px; z-index: 15; }
    
    /* Back Side Elements */
    .b-addr-lbl { position: absolute; top: 62px; left: 45px; font-weight: 700; font-size: 13px; color: #000; }
    .b-addr-val { position: absolute; top: 78px; left: 45px; width: 360px; font-size: 11px; color: #222; text-align: left; line-height: 1.2; font-weight: 500; }
    
    /* Table Details */
    .b-table { position: absolute; top: 110px; left: 38px; width: 375px; border-collapse: collapse; border: 2.5px solid #000; background: transparent; }
    .b-table th, .b-table td { border: 2px solid #000; padding: 4px 2px; font-size: 8.5px; text-align: center; color: #000; vertical-align: middle; line-height: 1.1; }
    .b-table th { font-family: 'Baloo 2', cursive; font-weight: 700; background: rgba(0,0,0,0.02); font-size: 9.5px; }
    .b-table td { font-family: 'Poppins', sans-serif; font-weight: 500; }

    .b-phone { position: absolute; bottom: 15px; left: 90px; font-size: 12px; font-weight: 700; color: #000; z-index: 15; font-family: 'Poppins', sans-serif; }
    .b-web { position: absolute; bottom: 16px; left: 240px; font-size: 12px; font-weight: 700; color: #000; z-index: 15; font-family: 'Poppins', sans-serif; }
    .b-round-logo { position: absolute; top: 12px; right: 22px; width: 42px; height: 46px; border-radius: 50%; object-fit: contain; z-index: 20; }

</style>

<div class="container py-4">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="bg-success bg-gradient text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-person-vcard-fill me-2"></i>
                        Farmer Card Generator
                    </h2>

                    <p class="mb-0 opacity-75">
                        Fetch Farmer Details & Generate Smart Agristack Card
                    </p>
                </div>

                <div class="text-end mt-3 mt-md-0">

                    <div class="badge bg-light text-success fs-6 px-3 py-2 rounded-pill shadow-sm">
                        Service Amount :
                        ₹ {{ $payment }}
                    </div>

                </div>

            </div>

        </div>

        <!-- BODY -->
        <div class="card-body p-4 bg-light">

            <form id="fetchForm">

                @csrf

                <input type="hidden" name="amount" id="amount">
                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                <input type="hidden" name="servicepayment" value="{{ $payment }}">

                <div class="row g-3 align-items-end">

                    <!-- Aadhaar -->
                    <div class="col-lg-7">

                        <label class="form-label fw-bold text-dark">
                            Aadhaar Number
                        </label>

                        <div class="input-group input-group-lg shadow-sm">

                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-credit-card-2-front text-success"></i>
                            </span>

                            <input type="text"
                                   maxlength="12"
                                   id="aadhaarInput"
                                   class="form-control border-0 shadow-none"
                                   placeholder="Enter 12 Digit Aadhaar Number"
                                   required>

                        </div>

                    </div>

                    <!-- Fetch Button -->
                    <div class="col-lg-3">

                        <button type="submit"
                                class="btn btn-success btn-lg w-100 shadow-sm fw-bold rounded-3"
                                id="fetchBtn">

                            <i class="bi bi-search me-2"></i>
                            Fetch Data

                        </button>

                    </div>

                    <!-- Refresh -->
                    <div class="col-lg-2">

                        <button type="button"
                                onclick="location.reload()"
                                class="btn btn-dark btn-lg w-100 rounded-3 shadow-sm">

                            <i class="bi bi-arrow-clockwise"></i>

                        </button>

                    </div>

                </div>

            </form>

            <!-- STATS -->
            <div class="row mt-4 g-3">

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 bg-success text-white">

                        <div class="card-body text-center">

                            <h6 class="fw-semibold mb-2">
                                Total Generated
                            </h6>

                            <h2 class="fw-bold mb-0">
                                {{ count($agristack) }}
                            </h2>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">

                        <div class="card-body text-center">

                            <h6 class="fw-semibold mb-2">
                                Today Generated
                            </h6>

                            <h2 class="fw-bold mb-0">
                                {{ $agristack->where('date', '>=', date('Y-m-d'))->count() }}
                            </h2>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 bg-dark text-white">

                        <div class="card-body text-center">

                            <h6 class="fw-semibold mb-2">
                                Service Charge
                            </h6>

                            <h2 class="fw-bold mb-0">
                                ₹ {{ $payment }}
                            </h2>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-header bg-white border-0 py-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <h5 class="fw-bold mb-0 text-success">
                            <i class="bi bi-clock-history me-2"></i>
                            Recent Generated Cards
                        </h5>

                        <div class="mt-2 mt-md-0">

                            <input type="text"
                                   id="searchInput"
                                   class="form-control rounded-pill"
                                   placeholder="Search Aadhaar / Name">

                        </div>

                    </div>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table id="datatable"
                               class="table align-middle table-hover mb-0">

                            <thead class="table-success">

                                <tr>

                                    <th class="text-center">#</th>

                                    <th>Aadhaar Number</th>

                                    <th>Name</th>

                                    <th>Date</th>

                                    <th class="text-center">PDF</th>

                                </tr>

                            </thead>

                            <tbody id="tableBody">

                                @forelse ($agristack as $key => $s)

                                    <tr>

                                        <td class="text-center fw-bold">
                                            {{ $key + 1 }}
                                        </td>

                                        <td>

                                            <div class="fw-semibold">
                                                {{ $s->aadhaar }}
                                            </div>

                                        </td>

                                        <td>

                                            <div class="fw-semibold text-dark">
                                                {{ $s->name }}
                                            </div>

                                        </td>

                                        <td>

                                            <span class="badge bg-light text-dark border px-3 py-2">
                                                {{ date('d-m-Y h:i A', strtotime($s->date)) }}
                                            </span>

                                        </td>

                                        <td class="text-center">

                                            <a href="{{ url('/') }}/upload/agristack/{{ $s->pdf }}"
                                               download
                                               class="btn btn-success btn-sm rounded-pill px-3 shadow-sm">

                                                <i class="bi bi-download me-1"></i>
                                                Download

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="text-center py-5">

                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486740.png"
                                                 width="90"
                                                 class="mb-3">

                                            <h5 class="fw-bold text-muted">
                                                No Farmer Cards Generated
                                            </h5>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- EDIT MODAL -->

<div class="modal fade"
     id="editDataModal"
     tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title fw-bold">
                    Edit Farmer Details
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" id="editNameEn" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Gender</label>
                        <input type="text" id="editGender" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>DOB</label>
                        <input type="text" id="editDob" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Caste</label>
                        <input type="text" id="editCaste" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Area</label>
                        <input type="text" id="editArea" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Mobile</label>
                        <input type="text" id="editMobile" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label>Address</label>
                        <textarea id="editAddress"
                                  rows="2"
                                  class="form-control"></textarea>
                    </div>

                </div>

                <input type="hidden" id="hiddenPhotoData">
                <input type="hidden" id="hiddenLandData">
                <input type="hidden" id="hiddenAadhaarData">
                <input type="hidden" id="hiddenFarmerId">
                <input type="hidden" id="editNameLocal">
                


            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-success"
                        id="generateModalBtn">

                    Generate Card

                </button>

            </div>

        </div>

    </div>

</div>

<!-- CARD MODAL -->

<div class="modal fade"
     id="cardModal"
     tabindex="-1">

    <div class="modal-dialog modal-md modal-dialog-centered">

        <div class="modal-content bg-light">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title fw-bold">
                    Farmer Card Preview
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="preview-container">

                    <!-- FRONT -->

                    <div class="card-box"
                         id="card-front-hd">

                        <img src="{{ asset('assets/img/front.png') }}"
                             class="bg-img">

                        <div class="content-layer">

                            {{-- <img src="{{ asset('assets/img/agri.png') }}"
                                 class="agri-logo">

                            <img src="{{ asset('assets/img/emblem.png') }}"
                                 class="emblem"> --}}

                            <div class="f-gov">
                                GOVERNMENT OF INDIA
                            </div>

                            <div class="f-photo-box">

                                <img id="cardPhoto"
                                     class="f-photo">

                            </div>

                            <div class="f-data">

                                <div class="f-row">
                                    <div class="f-lbl f-gj">பெயர்</div>
                                    <div class="f-val f-gj" id="cardNameLocal"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Name</div>
                                    <div class="f-val" id="cardNameEn"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Gender</div>
                                    <div class="f-val" id="cardGender"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">DOB</div>
                                    <div class="f-val" id="cardDob"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Caste</div>
                                    <div class="f-val" id="cardCaste"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Area</div>
                                    <div class="f-val" id="cardArea"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Mobile</div>
                                    <div class="f-val" id="cardMobile"></div>
                                </div>

                                <div class="f-row">
                                    <div class="f-lbl">Aadhaar</div>
                                    <div class="f-val" id="cardAadhaar"></div>
                                </div>

                            </div>

                            <img src="{{ asset('assets/img/qr.png') }}"
                                 class="f-qr">

                            <div class="f-id"
                                 id="cardFarmerId"></div>

                            <div class="f-registry">
                                Farmer Registry
                            </div>

                        </div>

                    </div>

                    <!-- BACK -->

                    <div class="card-box"
                         id="card-back-hd">

                        <img src="{{ asset('assets/img/image.jpg') }}"
                             class="bg-img">

                        <div class="content-layer">

                            <img id="cardStateLogo" src="{{ asset('assets/img/logo.png') }}"
                                 class="b-round-logo">

                            <div class="f-gov">
                                GOVERNMENT OF INDIA
                            </div>

                            <div class="b-addr-lbl">
                                Address
                            </div>

                            <div class="b-addr-val"
                                 id="cardAddress"></div>

                            <table class="b-table">

                                <thead>

                                    <tr>
                                        <th id="th-dist">District</th>
                                        <th id="th-tehsil">Tehsil</th>
                                        <th id="th-village">Village</th>
                                        <th id="th-khata">khata</th>
                                        <th id="th-survey">Survey</th>
                                        <th id="th-area">Area</th>
                                    </tr>

                                </thead>

                                <tbody id="cardLandTableBody"></tbody>

                            </table>

                            <div class="b-phone">
                                1800-180-1551
                            </div>

                            <div class="b-web" id="cardWebUrl">
                                www.agristack.gov.in
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

              
                <button class="btn btn-danger"
                        onclick="downloadPDF()">

                    Download PDF

                </button>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

let editModal =
    new bootstrap.Modal(
        document.getElementById('editDataModal')
    );

let cardModal =
    new bootstrap.Modal(
        document.getElementById('cardModal')
    );

document.getElementById('fetchForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    let aadhaar =
        document.getElementById('aadhaarInput').value;

    Swal.fire({
        title:'Fetching Data...',
        allowOutsideClick:false,
        didOpen:()=>{
            Swal.showLoading();
        }
    });

    try{

        let response =
            await fetch(
                `/fetch-farmer-data?aadhaar=${aadhaar}`
            );

        let res =
            await response.json();

        Swal.close();

        if(res.status === 'success'){

            let fd = res.data;
             let localNameFinal = fd.FarmerDetails.FarmerNameLocal || "";
                if(localNameFinal === "" && fd.LandDetailsOwned && fd.LandDetailsOwned.length > 0) {
                    localNameFinal = fd.LandDetailsOwned[0].OwnerName || "";
                }
            document.getElementById('editNameEn').value =
                fd.FarmerDetails.FarmerNameEn || '';

                document.getElementById('editNameLocal').value =
                localNameFinal;
                

            document.getElementById('editGender').value =
                fd.FarmerDetails.Gender || '';

            document.getElementById('editDob').value =
                fd.FarmerDetails.DateOfBirth || '';

            document.getElementById('editCaste').value =
                fd.FarmerDetails.CasteCategory || '';

            document.getElementById('editArea').value =
                fd.ResidentialDetails.ResidentialType || '';

            document.getElementById('editMobile').value =
                fd.ContactDetails.MobileNumber || '';

            let fullAddr = [

                fd.ResidentialDetails.AddressEn,
                fd.ResidentialDetails.Village,
                fd.ResidentialDetails.SubDistrict,
                fd.ResidentialDetails.District,
                fd.ResidentialDetails.State,
                fd.ResidentialDetails.PINCode

            ].filter(Boolean).join(', ');

            document.getElementById('editAddress').value =
                fullAddr;

            let photo =
                fd.ExtendedFields.FarmerPhotograph;

            if(photo &&
               !photo.startsWith('data:image')){

                photo =
                    'data:image/jpeg;base64,' + photo;
            }

            document.getElementById('hiddenPhotoData').value =
                photo;

            document.getElementById('hiddenLandData').value =
                JSON.stringify(fd.LandDetailsOwned || []);

            document.getElementById('hiddenFarmerId').value =
                fd.FarmerDetails.FarmerId || '';

            document.getElementById('hiddenAadhaarData').value =
                aadhaar;

            editModal.show();

        }else{

            Swal.fire(
                'Error',
                res.message,
                'error'
            );

        }

    }catch(error){

        Swal.fire(
            'Error',
            'Server Error',
            'error'
        );

    }

});


document.getElementById('generateModalBtn')
.addEventListener('click', async function () {

    /*
    |--------------------------------------------------------------------------
    | GET FORM DATA
    |--------------------------------------------------------------------------
    */

    let name =
        document.getElementById('editNameEn').value;

    let nameLocal =
        document.getElementById('editNameLocal').value;

    let gender =
        document.getElementById('editGender').value;

    let dob =
        document.getElementById('editDob').value;

    let caste =
        document.getElementById('editCaste').value;

    let area =
        document.getElementById('editArea').value;

    let mobile =
        document.getElementById('editMobile').value;

    let address =
        document.getElementById('editAddress').value;

    let photo =
        document.getElementById('hiddenPhotoData').value;

    let aadhaar =
        document.getElementById('hiddenAadhaarData').value;

    let farmerId =
        document.getElementById('hiddenFarmerId').value;

    let landData =
        JSON.parse(
            document.getElementById('hiddenLandData').value || '[]'
        );

    /*
    |--------------------------------------------------------------------------
    | CARD DATA
    |--------------------------------------------------------------------------
    */

    document.getElementById('cardPhoto').src =
        photo || 'https://via.placeholder.com/120x140';

    document.getElementById('cardNameEn').innerText =
        ': ' + (name || '-');

    document.getElementById('cardNameLocal').innerText =
        ': ' + (nameLocal || '-');

    document.getElementById('cardGender').innerText =
        ': ' + (gender || '-');

    document.getElementById('cardDob').innerText =
        ': ' + (dob || '-');

    document.getElementById('cardCaste').innerText =
        ': ' + (caste || '-');

    document.getElementById('cardArea').innerText =
        ': ' + (area || '-');

    document.getElementById('cardMobile').innerText =
        ': ' + (mobile || '-');

    /*
    |--------------------------------------------------------------------------
    | AADHAAR FORMAT
    |--------------------------------------------------------------------------
    */

    let formattedAadhaar =
        aadhaar.replace(/(\d{4})(?=\d)/g, '$1 ');

    document.getElementById('cardAadhaar').innerText =
        ': ' + formattedAadhaar;

    /*
    |--------------------------------------------------------------------------
    | FARMER ID
    |--------------------------------------------------------------------------
    */

    document.getElementById('cardFarmerId').innerText =
        'Farmer ID : ' + (farmerId || '-');

    /*
    |--------------------------------------------------------------------------
    | ADDRESS
    |--------------------------------------------------------------------------
    */

    document.getElementById('cardAddress').innerText =
        address || '-';

    /*
    |--------------------------------------------------------------------------
    | LAND TABLE
    |--------------------------------------------------------------------------
    */

    let tbody =
        document.getElementById('cardLandTableBody');

    tbody.innerHTML = '';

    if (landData.length > 0) {

        landData.slice(0, 5).forEach((land) => {

            let district =
                land.District || '-';

            let taluka =
                land.SubDistrict ||
                land.Tehsil || '-';

            let village =
                land.Village || '-';

            let survey =
                land.SurveyNumber || '-';

            let subSurvey =
                land.SubSurveyNumber || '-';

            let totalArea =
                land.ExtentTotalAreaFinal ||
                land.TotalArea || '-';

            let tr =
                document.createElement('tr');

            tr.innerHTML = `
                <td>${district}</td>
                <td>${taluka}</td>
                <td>${village}</td>
                <td>${survey}</td>
                <td>${subSurvey}</td>
                <td>${totalArea}</td>
            `;

            tbody.appendChild(tr);

        });

    } else {

        let tr =
            document.createElement('tr');

        tr.innerHTML = `
            <td colspan="6" style="text-align:center;">
                No Land Data Available
            </td>
        `;

        tbody.appendChild(tr);

    }

    /*
    |--------------------------------------------------------------------------
    | PHOTO ERROR FIX
    |--------------------------------------------------------------------------
    */

    let img =
        document.getElementById('cardPhoto');

    img.onerror = function () {

        this.src =
            'https://via.placeholder.com/120x140';

    };

    /*
    |--------------------------------------------------------------------------
    | SHOW CARD MODAL
    |--------------------------------------------------------------------------
    */

    cardModal.show();

    /*
    |--------------------------------------------------------------------------
    | LOADING
    |--------------------------------------------------------------------------
    */

    Swal.fire({
        title:'Generating PDF...',
        text:'Please wait...',
        allowOutsideClick:false,
        didOpen:()=>{
            Swal.showLoading();
        }
    });

    try {

        /*
        |--------------------------------------------------------------------------
        | WAIT FOR MODAL RENDER
        |--------------------------------------------------------------------------
        */

        await new Promise(resolve =>
            setTimeout(resolve, 1500)
        );

        /*
        |--------------------------------------------------------------------------
        | GET CARD ELEMENTS
        |--------------------------------------------------------------------------
        */

        const front =
            document.getElementById('card-front-hd');

        const back =
            document.getElementById('card-back-hd');

        /*
        |--------------------------------------------------------------------------
        | CHECK HIDDEN ISSUE
        |--------------------------------------------------------------------------
        */

        console.log(front.offsetWidth);
        console.log(front.offsetHeight);

        console.log(back.offsetWidth);
        console.log(back.offsetHeight);

        /*
        |--------------------------------------------------------------------------
        | GENERATE FRONT CANVAS
        |--------------------------------------------------------------------------
        */

       const frontCanvas = await html2canvas(front,{ scale:1.5, useCORS:true, backgroundColor:'#ffffff' });
        const backCanvas = await html2canvas(back,{ scale:1.5, useCORS:true, backgroundColor:'#ffffff' });
        const frontImg = frontCanvas.toDataURL('image/jpeg',0.7);
         const backImg = backCanvas.toDataURL('image/jpeg',0.7); 
          const { jsPDF } = window.jspdf;
           const pdf = new jsPDF({ orientation:'landscape', unit:'mm', format:'a4', compress:true }); 
            pdf.addImage( frontImg, 'JPEG', 10, 35, 130, 80 );
             pdf.addImage( backImg, 'JPEG', 150, 35, 130, 80 );
             let pdfBase64 = pdf.output('datauristring');

        console.log(pdfBase64);

        /*
        |--------------------------------------------------------------------------
        | SAVE PDF + WALLET DEDUCTION
        |--------------------------------------------------------------------------
        */

        let response =
            await fetch('/save-farmer-pdf',{

                method:'POST',

                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content')
                },

                body:JSON.stringify({

                    pdf:pdfBase64,

                    aadhaar_number:
                        aadhaar,

                    name_en:
                        name,

                    service_id:
                        document.querySelector(
                            'input[name="serviceid"]'
                        ).value,

                    amount:
                        document.querySelector(
                            'input[name="servicepayment"]'
                        ).value

                })

            });

        let res =
            await response.json();

        Swal.close();

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        if(res.status === 'success'){

            pdf.save('Farmer_Card.pdf');

            Swal.fire(
                'Success',
                'Wallet Deducted & PDF Saved Successfully',
                'success'
            );

            setTimeout(()=>{
                location.reload();
            },1500);

        } else {

            Swal.fire(
                'Error',
                res.message || 'Failed',
                'error'
            );

        }

    } catch(error){

        Swal.close();

        console.log(error);

        Swal.fire(
            'Error',
            'PDF generation failed',
            'error'
        );

    }

});


 const stateTranslations = {
        "TAMIL NADU": { dist: "மாவட்டம்", tehsil: "வட்டம்", village: "கிராமம்", khata: "பட்டா எண்", survey: "சர்வே எண்", area: "பரப்பளவு", logo: "statelogo/tamilnadu.png", url: "www.tnfr.agristack.gov.in" },
        "MAHARASHTRA": { dist: "जिल्हा", tehsil: "तालुका", village: "गाव", khata: "खाते क्र.", survey: "सर्वे क्र.", area: "क्षेत्रफळ", logo: "statelogo/maharashtra.png", url: "www.mhfr.agristack.gov.in" },
        "GUJARAT": { dist: "જિલ્લો", tehsil: "તાલુકો", village: "ગામ", khata: "ખાતા નં.", survey: "સર્વે નં.", area: "વિસ્તાર", logo: "statelogo/gujarat.png", url: "www.gjfr.agristack.gov.in" },
        "BIHAR": { dist: "ज़िला", tehsil: "तहसील", village: "गाँव", khata: "खाता सं.", survey: "सर्वे सं.", area: "क्षेत्रफल", logo: "statelogo/bihar.png", url: "www.bhfr.agristack.gov.in" },
        "ANDHRA PRADESH": { dist: "జిల్లా", tehsil: "మండలం", village: "గ్రామం", khata: "ఖాతా నం.", survey: "సర్వే నం.", area: "విస్తీర్ణం", logo: "statelogo/andhra.png", url: "www.apfr.agristack.gov.in" },
        "UTTAR PRADESH": { dist: "ज़िला", tehsil: "तहसील", village: "गाँव", khata: "खाता सं.", survey: "सर्वे सं.", area: "क्षेत्रफल", logo: "statelogo/up.png", url: "www.upfr.agristack.gov.in" },
        "DEFAULT": { dist: "ज़िला", tehsil: "तहसील", village: "गाँव", khata: "खाता सं.", survey: "सर्वे सं.", area: "क्षेत्रफल", logo: "statelogo/default.png", url: "www.agristack.gov.in" }
    };

</script>

@endsection
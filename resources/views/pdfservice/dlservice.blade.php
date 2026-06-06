@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

     body { background: #f1f5f9; font-family: 'Poppins', sans-serif; min-height: 100vh; display: flex; flex-direction: column;  }
    .top-navbar { background: #fff; height: 70px; position: fixed; top: 0; left: 0; right: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between; padding: 0 30px; }
    .nav-title { color: #16a34a; font-weight: 700; font-size: 1.5rem; display: flex; align-items: center; gap: 10px; }
    .service-card { background: #ffffff; border-radius: 24px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1); overflow: hidden; width: 100%; max-width: 1000px; border: 1px solid #e2e8f0; min-height: 500px; display: flex; flex-direction: column; margin: 0 auto; }
    .card-row { flex: 1; display: flex; flex-wrap: wrap; }
    .input-panel { background: #ffffff; padding: 3rem; display: flex; flex-direction: column; justify-content: center; height: 100%; }
    .info-panel { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); color: white; padding: 3rem; display: flex; flex-direction: column; justify-content: center; position: relative; height: 100%; }
    .form-label { font-weight: 600; color: #334155; margin-bottom: 8px; }
    .form-control, .form-select { border-radius: 12px; padding: 14px 18px; border: 2px solid #e2e8f0; font-weight: 500; font-size: 1rem; background: #f8fafc; transition: 0.3s; }
    .form-control:focus, .form-select:focus { border-color: #22c55e; background: #fff; box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1); outline: none; }
    .btn-search { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; border: none; padding: 16px; border-radius: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; width: 100%; transition: 0.3s; margin-top: 25px; box-shadow: 0 10px 20px rgba(34, 197, 94, 0.3); }
    .btn-search:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(34, 197, 94, 0.4); }

    /* --- LOCKED CARD STYLES --- */
    .preview-container { display: flex; gap: 40px; justify-content: center; flex-wrap: wrap; padding: 20px; background: transparent; }
    
    .card-box { 
        width: 480px; 
        height: 303px; 
        position: relative; 
        overflow: hidden; 
        box-shadow: 0 8px 25px rgba(0,0,0,0.2); 
        border-radius: 6px; 
        font-family: 'Roboto', sans-serif; 
        background: #fff; 
        margin: 0 auto; 
    }
    
    .bg-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; object-fit: cover; }
    .content-layer { position: relative; z-index: 10; width: 100%; height: 100%; color: #000; text-align: left; }
    
    /* Utility for absolute positioning */
    .abs { position: absolute; white-space: nowrap; }
    .abs-wrap { position: absolute; white-space: normal; line-height: 1.3; }

</style>

<div class="page-wrapper">
        <div class="page-content">
<div class="container py-4">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="bg-info bg-gradient text-white p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-person-vcard-fill me-2"></i>
                        DL Card Generator
                    </h2>

                    <p class="mb-0 opacity-75">
                        Fetch Driving License Details & Generate Smart DL Card
                    </p>
                </div>

                <div class="text-end mt-3 mt-md-0">

                    <div class="badge bg-light text-success fs-6 px-3 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-shield-check me-1"></i>
                        Secure Verification
                    </div>

                </div>

            </div>

        </div>

        <!-- BODY -->
        <div class="card-body p-4 bg-light">

            <form id="verifyForm">
                   <input type="hidden" name="amount" id="amount">
                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                <input type="hidden" name="servicepayment" value="{{ $payment }}">

                <div class="row g-3 align-items-end">

                    <!-- DL Number -->
                    <div class="col-lg-4">

                        <label class="form-label fw-bold text-dark">
                            DL Number
                        </label>

                        <div class="input-group input-group-lg shadow-sm">

                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-card-heading text-success"></i>
                            </span>

                            <input type="text"
                                   id="dlNoInput"
                                   class="form-control border-0 shadow-none"
                                   placeholder="DL-1420110012345"
                                   required
                                   style="text-transform:uppercase;">

                        </div>

                    </div>

                    <!-- DOB -->
                    <div class="col-lg-3">

                        <label class="form-label fw-bold text-dark">
                            Date of Birth
                        </label>

                        <div class="input-group input-group-lg shadow-sm">

                            <span class="input-group-text bg-white border-0">
                                <i class="bi bi-calendar-date text-success"></i>
                            </span>

                            <input type="text"
                                   id="dobInput"
                                   class="form-control border-0 shadow-none"
                                   placeholder="DD-MM-YYYY"
                                   maxlength="10"
                                   required>

                        </div>

                    </div>

                    <!-- Theme -->
                    <div class="col-lg-3">

                        <label class="form-label fw-bold text-dark">
                            Card Theme
                        </label>

                        <select id="bgSelect"
                                class="form-select form-select-lg shadow-sm">

                            <option value="blue">
                                Light Blue Smart Card
                            </option>

                            <option value="white">
                                Plain White Theme
                            </option>

                        </select>

                    </div>

                    <!-- Generate Button -->
                    <div class="col-lg-2">

                        <button type="submit"
                                id="generateBtn"
                                class="btn btn-info btn-lg w-100 shadow-sm fw-bold rounded-3">

                            <i class="bi bi-cpu me-2"></i>
                            Generate

                        </button>

                    </div>

                </div>

            </form>

            <!-- STATS -->
            <div class="row mt-4 g-3">

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 bg-info text-white">

                        <div class="card-body text-center">

                            <h6 class="fw-semibold mb-2">
                                Total Generated
                            </h6>

                            <h2 class="fw-bold mb-0">
                                {{ count($dldetails) }}
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
                                {{ $dldetails->where('date','>=',date('Y-m-d'))->count() }}
                            </h2>

                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm rounded-4 bg-dark text-white">

                        <div class="card-body text-center">

                            <h6 class="fw-semibold mb-2">
                                Verification Status
                            </h6>

                            <h2 class="fw-bold mb-0">
                                Active
                            </h2>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RECENT RECORDS -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">

                <div class="card-header bg-white border-0 py-3">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <h5 class="fw-bold mb-0 text-success">
                            <i class="bi bi-clock-history me-2"></i>
                            Recent Generated DL Cards
                        </h5>

                       

                    </div>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table id="datatable" class="table table-hover align-middle mb-0">

                            <thead class="table-success">

                                <tr>
                                    <th class="text-center">#</th>
                                    <th>DL Number</th>
                                    <th>Date of Birth</th>
                                    <th>Date</th>
                                    <th class="text-center">PDF</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($dldetails as $key => $row)

                                <tr>

                                    <td class="text-center fw-bold">
                                        {{ $key + 1 }}
                                    </td>

                                    <td>{{ $row->dlnumber }}</td>

                                    <td>{{ $row->dob }}</td>

                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            {{ date('d-m-Y h:i A',strtotime($row->date)) }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ url('/upload/dl/'.$row->pdf) }}"
                                           download
                                           class="btn btn-success btn-sm rounded-pill px-3">

                                            <i class="bi bi-download me-1"></i>
                                            Download

                                        </a>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <i class="bi bi-file-earmark-x display-4 text-muted"></i>

                                        <h5 class="mt-3 text-muted">
                                            No DL Cards Generated
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
</div>
</div>

<div class="modal fade" id="cardModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content shadow-2xl border-0" style="border-radius: 24px; overflow:hidden;">
            
            <div class="modal-header border-0 text-white px-4 py-3" style="background: #111827;">
                <h5 class="modal-title fw-bold d-flex align-items-center gap-2" style="font-size:1.1rem;"><i class="bi bi-shield-check text-success"></i> HD Rendering Engine Terminal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body text-center bg-stripes py-5 overflow-auto" style="background-color: #f8fafc;">
                <div class="preview-container">
                    
                    <div class="card-box" id="card-front-hd">
                        <img id="bg_front" src="{{ asset('assets/img/frontsides.png') }}" class="bg-img" alt="Front BG">
                        <div class="content-layer">
                            <div class="abs" style="top: 8px; left: 90px; font-size: 20px; font-weight: 500; color: #111; letter-spacing: 0.5px;">INDIAN UNION DRIVING LICENCE</div>
                            <div class="abs" style="top: 35px; left: 110px; font-size: 15px; font-weight: 400; color: #111;" id="c_state_header">ISSUED BY GOVERNMENT OF DELHI</div>
                            <div class="abs" style="top: 5px; right: 15px; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; color: #000; z-index: 10;">DL</div>
                            <div class="abs" style="top: 75px; left: 90px; font-size: 18px; font-weight: 700;" id="disp_dl">---</div>
                            <div class="abs" style="top: 105px; left: 90px; font-size: 12px; font-weight: 500;">Issue Date</div>
                            <div class="abs" style="top: 105px; left: 180px; font-size: 12px; font-weight: 500;">Validity ( NT )</div>
                            <div class="abs" style="top: 105px; left: 270px; font-size: 12px; font-weight: 500;">Validity ( TR )</div>
                            <div class="abs" style="top: 125px; left: 90px; font-size: 14px; font-weight: 700;" id="c_issue_date">---</div>
                            <div class="abs" style="top: 125px; left: 180px; font-size: 14px; font-weight: 700;" id="c_val_nt">---</div>
                            <div class="abs" style="top: 125px; left: 270px; font-size: 14px; font-weight: 700;" id="c_val_tr">---</div>
                            <div class="abs-wrap" style="top: 173px; left: 20px; width: 365px; font-size: 13px; line-height: 1.4; color: #000;">
                                <div style="margin-bottom: 2px;">Name : <span style="font-weight: 700;" id="c_name">---</span></div>
                                <div style="margin-bottom: 2px;">Date Of Birth : <span style="font-weight: 700;" id="disp_dob">---</span> <span style="margin-left: 8px; font-size: 12px;">Blood Group: <b style="font-weight: 600;">U</b></span></div>
                                <div style="margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Son/Daughter/Wife of : <span style="font-weight: 700;" id="c_father">---</span></div>
                                <div style="display: flex; align-items: flex-start; margin-top: 1px;">
                                    <span style="white-space: nowrap;">Address :&nbsp;</span>
                                    <span style="font-size: 11px; font-weight: 700; line-height: 1.3;" id="c_address">---</span>
                                </div>
                            </div>
                            <img id="c_photo" src="" class="abs" style="top: 75px; right: 25px; width: 75px; height: 100px; object-fit: cover;">
                            <img id="c_sign" src="" class="abs" style="top: 180px; right: 25px; width: 75px; height: 30px; mix-blend-mode: multiply;">
                            <div class="abs" style="top: 215px; right: 25px; width: 75px; text-align: center; font-size: 10px;">Holder's Signature</div>
                            <div class="abs" style="top: 165px; right: -65px; font-size: 10px; transform: rotate(-90deg); width: 150px; text-align: center;" id="c_side_date">Date of First Issue ---</div>
                        </div>
                    </div>

                    <div class="card-box" id="card-back-hd">
                        <img id="bg_back" src="{{ asset('assets/img/backside.png') }}" class="bg-img" alt="Back BG">
                        <div class="content-layer">
                            <div class="abs" style="top: 6px; left: 20px; font-size: 18px; font-weight: 700;" id="disp_dl_back">DL No. ---</div>
                            <img id="dl_qr_code_img" class="abs" style="top: 48px; left: 20px; width: 80px; height: 80px;" src="">
                            <div class="abs" style="top: 50px; left: 120px; font-size: 13.5px;">ADPVEH No.(Regn.Numbers)</div>
                            <div class="abs" style="top: 85px; left: 120px; font-size: 13.5px;">Hazardous validity</div>
                            <div class="abs" style="top: 85px; left: 280px; font-size: 13.5px;">Hill Validity</div>
                            <div class="abs" style="top: 135px; left: 20px; width: 440px; height: 95px;">
                                <table style="width: 100%; border-collapse: collapse; text-align: center;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Class of<br>Vehicle</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Code</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Issued<br>by</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Date of<br>Issue</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Vehicle<br>Category</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Badge<br>Number</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Badge<br>Issued Date</th>
                                            <th style="border: 1px solid #000; background: #9bd3f0; font-size: 9.5px; padding: 4px;">Badge<br>Issued by</th>
                                        </tr>
                                    </thead>
                                    <tbody id="c_cov_body"></tbody>
                                </table>
                            </div>
                            <div class="abs" style="bottom: 25px; left: 20px; font-size: 14px;">Mobile Number: Not Provided</div>
                            <div class="abs" style="bottom: 13px; right: 20px; text-align: right;">
                                <div style="font-size: 15px; font-weight: 500;">Licencing Authority</div>
                                <div style="font-size: 12.5px;" id="c_auth">---</div>
                            </div>
                            <div class="abs" style="bottom: 3px; left: 0; width: 100%; text-align: center; font-size: 8px; color: #444;">
                                This duplicate card, generated from publicly available data on sarathi.parivahan.gov.in, is for reference/personal use only.
                            </div>
                            <div class="abs" style="top: 160px; right: -42px; font-size: 10px; transform: rotate(-90deg); width: 100px; text-align: center;">Form 7 Rule 16 (2)</div>
                        </div>
                    </div>

                </div>
            </div>
            

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// 1. CRITICAL GLOBAL SCOPE DECLARATION: Keeps variables visible to download functions
var currentDlNumber = "DL_Card";
var currentDob = "";

$(document).ready(function() {

    // Format DOB input automatically to DD-MM-YYYY
    document.getElementById('dobInput').addEventListener('input', function (e) {
        var input = e.target.value;
        var cleaned = input.replace(/\D/g, '');
        var formatted = "";
        if (cleaned.length > 0) {
            formatted = cleaned.substring(0, 2);
            if (cleaned.length > 2) { formatted += '-' + cleaned.substring(2, 4); }
            if (cleaned.length > 4) { formatted += '-' + cleaned.substring(4, 8); }
        }
        e.target.value = formatted;
    });

    // Handle form submit safely
  $(document).on('submit', '#verifyForm', function(e) {
     
        e.preventDefault(); // Stop standard browser request submission immediately
        
        var dlValue = $('#dlNoInput').val();
        var dobValue = $('#dobInput').val();

        if (!dlValue || !dobValue) {
            Swal.fire('Error', 'Please fill in all fields.', 'warning');
            return false;
        }

        dlValue = dlValue.trim().toUpperCase();
        dobValue = dobValue.trim();
        var bgSelect = $('#bgSelect').val();

        // Save inside global variable reference safely
        currentDlNumber = dlValue;
        currentDob = dobValue;
        var $btn = $('#generateBtn');
        var originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Processing...').prop('disabled', true);

        $.ajax({
            url: "{{ route('dlpdf.fetch') }}",
            type: "GET",
            dataType: "json",
            data: {
                dlno: dlValue,
                dob: dobValue
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                $btn.html(originalText).prop('disabled', false);

                if (data.status === 'success' && data.data) {
                    var d = data.data;

                    $('#disp_dl').text(d.dl_number || dlValue);
                    $('#disp_dl_back').text("DL No. " + (d.dl_number || dlValue));
                    $('#disp_dob').text(d.dob || dobValue);
                    
                    $('#c_name').text(d.name || "---");
                    $('#c_father').text(d.father_husband_name || "---");
                    $('#c_address').text(d.address || "---");
                    $('#c_auth').text(d.rto || "---");
                    $('#c_state_header').text("ISSUED BY GOVERNMENT OF " + (d.state ? d.state.toUpperCase() : "INDIA"));

                    let ntValid = (d.validity_non_transport || "").split('to');
                    let issueDate = ntValid[0] ? ntValid[0].trim() : "---";
                    let ntEnd = ntValid[1] ? ntValid[1].trim() : "---";
                    
                    let trValid = (d.validity_transport || "").split('to');
                    let trEnd = trValid[1] ? trValid[1].trim() : (trValid[0] && trValid[0] !== "Not Found" ? trValid[0].trim() : "NA");

                    $('#c_issue_date').text(issueDate);
                    $('#c_val_nt').text(ntEnd);
                    $('#c_val_tr').text(trEnd);
                    $('#c_side_date').text("Date of First Issue " + issueDate);

                    if(d.photo_base64) $('#c_photo').attr('src', d.photo_base64);
                    if(d.signature_base64) $('#c_sign').attr('src', d.signature_base64);

                    let $tbody = $('#c_cov_body');
                    $tbody.empty();
                    
                    if (d.class_of_vehicles && d.class_of_vehicles.length > 0) {
                        d.class_of_vehicles.forEach(v => {
                            let icon = (v.cov.includes('LMV') || v.cov.includes('MCW') || v.cov.includes('2WN')) ? '🚗' : '🚚';
                            let type = v.cov.includes('TRANS') ? 'TR' : 'NT';
                            let authCode = dlValue.substring(0, 4);

                            let tr = `<tr>
                                <td style="border: 1px solid #000; font-size: 12px; padding: 2px;">${icon}</td>
                                <td style="border: 1px solid #000; font-size: 11px; font-weight: bold;">${v.cov}</td>
                                <td style="border: 1px solid #000; font-size: 11px; font-weight: bold;">${authCode}</td>
                                <td style="border: 1px solid #000; font-size: 11px; font-weight: bold;">${issueDate}</td>
                                <td style="border: 1px solid #000; font-size: 11px; font-weight: bold;">${type}</td>
                                <td style="border: 1px solid #000; font-size: 11px;"></td>
                                <td style="border: 1px solid #000; font-size: 11px;"></td>
                                <td style="border: 1px solid #000; font-size: 11px;"></td>
                            </tr>`;
                            $tbody.append(tr);
                        });
                    }
                    $tbody.append(`<tr><td colspan="8" style="border: 1px solid #000; height: 14px;"></td></tr>`);

                    var qrText = "DL:" + dlValue + "|DOB:" + dobValue + "|Name:" + (d.name || "---");
                    var qr = qrcode(0, 'M'); 
                    qr.addData(qrText); 
                    qr.make();
                    $('#dl_qr_code_img').attr('src', qr.createDataURL(4, 0)); 

                    if(bgSelect === 'white') {
                        $('#bg_front').attr('src', "{{ asset('assets/img/dlfrontsideimg.png') }}");
                        $('#bg_back').attr('src', "{{ asset('assets/img/dlbacksideimg.png') }}");
                    } else {
                        $('#bg_front').attr('src', "{{ asset('assets/img/frontsides.png') }}");
                        $('#bg_back').attr('src', "{{ asset('assets/img/backside.png') }}");
                    }

                    var cardModal = new bootstrap.Modal(document.getElementById('cardModal'));
                    cardModal.show();

                    setTimeout(function () {
                        autoGenerateSaveAndReload();
                    }, 1500);
                    
                } else {
                    Swal.fire('Failed', data.message || 'Invalid details.', 'error');
                }
            },
            error: function(xhr, status, error) {
                $btn.html(originalText).prop('disabled', false);
                var errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Unable to fetch data from server.';
                Swal.fire('Error', errMsg, 'error');
            }
        });

        return false; 
    });
});

// 2. KEEP DOWNLOAD ACTIONS OUTSIDE DOCUMENT READY: Allows buttons with onclick attributes to find them globally
function downloadPNG(divId, fileName) {
    Swal.fire({ title: 'Generating Image...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
    html2canvas(document.getElementById(divId), { scale: 4, useCORS: true }).then(canvas => {
        Swal.close();
        const link = document.createElement('a');
        link.download = currentDlNumber + '_' + fileName + '.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    });
}



async function autoGenerateSaveAndReload() {

    try {

        window.jsPDF = window.jspdf.jsPDF;

        Swal.fire({
            title: 'Generating PDF...',
            text: 'Please wait...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        const frontEl = document.getElementById('card-front-hd');
        const backEl = document.getElementById('card-back-hd');

        const canvasFront = await html2canvas(frontEl, {
            scale: 4,
            useCORS: true
        });

        const canvasBack = await html2canvas(backEl, {
            scale: 4,
            useCORS: true
        });

        const pdf = new jsPDF('p', 'mm', 'a4');

        pdf.addImage(
            canvasFront.toDataURL('image/jpeg'),
            'JPEG',
            15,
            20,
            85.6,
            54
        );

        pdf.addImage(
            canvasBack.toDataURL('image/jpeg'),
            'JPEG',
            110,
            20,
            85.6,
            54
        );

        // Download automatically
        pdf.save(currentDlNumber + '_DL.pdf');

        // Base64 for database save
        let pdfBase64 = pdf.output('datauristring');

        const response = await fetch(
            "{{ route('save.dl.pdf') }}",
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    pdf: pdfBase64,
                    dl_number: currentDlNumber,
                    dob: currentDob,
                    service_id:
                        document.querySelector(
                            'input[name="serviceid"]'
                        ).value,}),
                        amount: 
                        document.querySelector(
                            'input[name="servicepayment"]'
                        ).value
            }
        );

        const res = await response.json();

        Swal.close();

        if (res.status === 'success') {

            Swal.fire({
                icon: 'success',
                title: 'PDF Saved Successfully',
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(function () {
                location.reload();
            }, 1500);

        } else {

            Swal.fire(
                'Error',
                res.message || 'Failed to save PDF',
                'error'
            );
        }

    } catch (error) {

        console.log(error);

        Swal.fire(
            'Error',
            'PDF generation failed',
            'error'
        );
    }
}
</script>
@endsection
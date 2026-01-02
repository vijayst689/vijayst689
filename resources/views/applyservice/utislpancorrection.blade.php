@extends('layouts.app')
@section('content')
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

                    <form onsubmit="return checkpayment(event)" action="{{ url('submitutisl_corection') }}"
                        id="myForm" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="amount" id="amount">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="servicepayment" value="{{ $payment }}">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="mode" class="form-label">Old Pan Card</label>
                                <select id="pan" required class="form-control" name="mode">
                                    <option value="">Select</option>
                                    <option value="File">File</option>
                                    <option value="Text">Text</option>
                                </select>

                                <label for="name" class="form-label">Name</label>
                                <input required class="form-control" name="name" type="text" maxlength="30"
                                    style="width: 100%;" placeholder="Name">

                                <label for="aadhaar_pdf" class="form-label">Aadhaar Pdf</label>
                                <input required class="form-control" accept="application/pdf,image/x-eps" name="aadhaar_pdf"
                                    type="file" style="width: 100%;">

                                <label for="signature" class="form-label">Signature</label>
                                <input required class="form-control" name="signature" type="file" style="width: 100%;">

                                <label for="father_name" class="form-label">Father Name</label>
                                <input required class="form-control" name="father_name" type="text" maxlength="30"
                                    style="width: 100%;" placeholder="Father Name">
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="" id="oldfile" style="display: none;">
                                    <label>Old PanFile</label>
                                    <input id="oldfile" class="form-control" type="file" name="pan_file">
                                </div>

                                <div class="" id="panno" style="display: none;">
                                    <label>Pan No</label>
                                    <input id="panno" class="form-control" type="text" maxlength="10" name="pan_no"
                                        placeholder="Pan No">
                                </div>

                                <label for="mobile" class="form-label">Mobile No</label>
                                <input required class="form-control number" name="mobile" type="text" maxlength="10"
                                    style="width: 100%;" placeholder="Mobile Number">

                                <label for="photo" class="form-label">Photo</label>
                                <input required class="form-control" name="photo" type="file" style="width: 100%;">

                                <label for="email" class="form-label">Email</label>
                                <input required class="form-control" name="email" type="text" maxlength="70"
                                    style="width: 100%;" placeholder="E-Mail">

                                <label for="date_of_birth" class="form-label">DOB</label>
                                <input required class="form-control" name="date_of_birth" type="date"
                                    style="width: 100%;">
                            </div>
                        </div>
                        <div class="mt-2 text-center" id="nopayment"></div>
                        <div class="mt-2 text-center">
                            <button type="submit" id="save" class="btn btn-primary me-2">Submit</button>
                        </div>
                    </form>
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table id="example2" class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pandetails as $key => $ser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $ser->mobile }}</td>
                                            <td>{{ $ser->message }}</td>
                                            <td>{{ $ser->amount }}</td>
                                            <td>{{ $ser->applied_date }}</td>
                                            <td>{{ $ser->status }}</td>
                                            @if ($ser->status == 'Failure')
                                                <td>Refunded</td>
                                            @else
                                                <td>{{ $ser->status }}</td>
                                            @endif
                                            <td>{{ $ser->opid }}</td>
                                            <td style="white-space: nowrap;">
                                                @if ($ser->status == 'Pending' || $ser->status == 'Processing')
                                                    <a href="{{ url('/pancard_reapply', $ser->api_txid) }}/{{ $ser->service_id }}"
                                                        type="button" style="font-size: small"
                                                        class="btn-sm btn btn-primary">Reapply</a>
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
    </div>
    </div>
@endsection
@push('page_scripts')
    <script>
         document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
        var ramjibalance = "{{ $mainbalance->wallet }}";
        ramjibalance = parseFloat(ramjibalance);
        amount = parseInt(amount);

        function checkpayment(e) {
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#amount").val(amount);
                return true;

            }
        }

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });

        $('#pan').change(function() {
            if ($('#pan').val() == 'File') {
                $('#oldfile').show("slow");
                $('#panno').hide("slow");
            } else {
                $('#oldfile').hide("slow");
                $('#panno').show("slow");
            }
        });
    </script>
@endpush

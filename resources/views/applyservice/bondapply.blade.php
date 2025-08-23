@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
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
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h6 class="card-title">Service Payment : <span
                                        class="text-danger">{{ $payment }}</span></h6>
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('bondsubmit') }}" enctype="multipart/form-data"
                                        method="post">
                                        {{ csrf_field() }}

                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                            <div class="mb-3 col-md-6">
                                                <label for="applicant_name" class="form-label">Applicant Name</label>
                                                <input type="text" maxlength="30" class="form-control"
                                                    name="applicant_name" placeholder="Applicant Name" />

                                                <label for="document_number" class="form-label">Document Number</label>
                                                <input type="text" maxlength="30" class="form-control"
                                                    name="document_number" placeholder="Document No" />

                                                <label for="dist_id" class="form-label">District</label>
                                                <select required name="dist_id" id="dist_id" class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option value="{{ $d->id }}">{{ $d->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                <input type="text" maxlength="12" class="form-control number"
                                                    name="aadhaar_no" placeholder="Aadhaar Number" />

                                                <label for="year" class="form-label">Year</label>
                                                <input type="year" maxlength="4" class="form-control number"
                                                    name="year" placeholder="Year" />

                                                <label for="taluk_id" class="form-label">Taluk</label>
                                                <select required name="taluk_id" id="taluk" class="form-control">
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <p id="nopayment"></p>
                                            </div>
                                            <div class="mt-2 text-center">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary me-2">Apply</button>
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
                        $("#acc_number, #confirmacc_number").keyup(checkAccountNumberMatch);
                    });

                    $('#dist_id').on('change', function() {
                        var dist_id = this.value;
                        $("#taluk").html('');
                        var url = "{{ url('service/get_taluk') }}/" + dist_id;
                        $.ajax({
                            url: url,
                            type: "GET",
                            success: function(result) {
                                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                                $.each(result, function(key, value) {
                                    $("#taluk").append('<option value="' + value
                                        .id + '">' + value.taluk_name + '</option>');
                                });
                            }
                        });
                    });

                    $("#pricetable").on('click', '.btnDelete', function() {
                        $(this).closest('tr').remove();
                    });

                    function addnewrow() {
                        $("#pricetable tbody").append(
                            "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Mother'>தாய்</option><option value='Father'>தந்தை</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Father In Law'>மாமனார்</option><option value='Mother In Law'>மாமியார்</option><option value='Son In Law'>மருமகன்</option><option value='Daughter In Law'>மருமகள்</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'><td><input class='form-control' required type='date' name='relation_dob[]'></td><td><select required name='maritial_status[]' class='form-control alive_or_dead'><option value=''>Select</option><option value='Married'>Married</option><option value='Single'>Single</option><option value='Divorced'>Divorced</option></select></td><td><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='bx bx-trash'></i></a></td></tr>"
                        );
                    }
                </script>
            @endpush

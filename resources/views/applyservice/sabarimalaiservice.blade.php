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
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <h6 class="card-title">Service Payment : <span
                                            class="text-danger">{{ $payment }}</span></h6><br>
                                    <form class="row g-4" action="{{ url('submitapply_sabarimalai') }}"
                                        enctype="multipart/form-data" method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">

                                            @if ($serviceid == 183)
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Name" maxlength="30" />
                                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />
                                                    <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                                                    <input required type="date" class="form-control" name="darshan_date"
                                                        maxlength="10" />
                                                    <label for="route" class="form-label">Route</label>
                                                    <select required class="form-control " id="route" name="route"
                                                        style="width: 100%;">
                                                        <option value="">Select Route</option>
                                                        <option value="Pamba-Marakkoottam-4Kms">Pamba-Marakkoottam-4Kms
                                                        </option>
                                                        <option value="Vandiperiyar-Sathram-Pulmedu-16Kms">
                                                            Vandiperiyar-Sathram-Pulmedu-16Kms</option>
                                                        <option value="Erumely-Kalaketti Traditional Path-46Kms">
                                                            Erumely-Kalaketti Traditional Path-46Kms</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label number">Photo</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="photo" />
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card
                                                        (Front&Back)</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="aadhaar_card" />
                                                    <label for="time" class="form-label">நேரம்</label>
                                                    <select required class="form-control " id="time" name="time"
                                                        style="width: 100%;">
                                                        <option value="">Select Time</option>
                                                        <option value="03:00 - 04:00">03:00 - 04:00</option>
                                                        <option value="04:00 - 05:00">04:00 - 05:00</option>
                                                        <option value="05:00 - 06:00">05:00 - 06:00</option>
                                                        <option value="06:00 - 07:00">06:00 - 07:00</option>
                                                        <option value="07:00 - 08:00">07:00 - 08:00</option>
                                                        <option value="08:00 - 09:00">08:00 - 09:00</option>
                                                        <option value="09:00 - 10:00">09:00 - 10:00</option>
                                                        <option value="10:00 - 11:00">10:00 - 11:00</option>
                                                        <option value="11:00 - 12:00">11:00 - 12:00</option>
                                                        <option value="12:00 - 13:00">12:00 - 13:00</option>
                                                        <option value="02:00 - 03:00">02:00 - 03:00</option>
                                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                                        <option value="17:00 - 18:00">17:00 - 18:00</option>
                                                        <option value="18:00 - 19:00">18:00 - 19:00</option>
                                                        <option value="19:00 - 20:00">19:00 - 20:00</option>
                                                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                                                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                                                        <option value="22:00 - 23:00">22:00 - 23:00</option>

                                                    </select>

                                                </div>
                                            @elseif($serviceid == 184)
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Name" maxlength="30" />
                                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />
                                                    <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                                                    <input required type="date" class="form-control"
                                                        name="darshan_date" maxlength="10" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label number">Photo</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="photo" />
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card
                                                        (Front&Back)</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="aadhaar_card" />
                                                    <label for="time" class="form-label">நேரம்</label>
                                                    <select required class="form-control " id="time" name="time"
                                                        style="width: 100%;">
                                                        <option value="">Select Time</option>
                                                        <option value="03:00 - 04:00">03:00 - 04:00</option>
                                                        <option value="04:00 - 05:00">04:00 - 05:00</option>
                                                        <option value="05:00 - 06:00">05:00 - 06:00</option>
                                                        <option value="06:00 - 07:00">06:00 - 07:00</option>
                                                        <option value="07:00 - 08:00">07:00 - 08:00</option>
                                                        <option value="08:00 - 09:00">08:00 - 09:00</option>
                                                        <option value="09:00 - 10:00">09:00 - 10:00</option>
                                                        <option value="10:00 - 11:00">10:00 - 11:00</option>
                                                        <option value="11:00 - 12:00">11:00 - 12:00</option>
                                                        <option value="12:00 - 13:00">12:00 - 13:00</option>
                                                        <option value="02:00 - 03:00">02:00 - 03:00</option>
                                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                                        <option value="17:00 - 18:00">17:00 - 18:00</option>
                                                        <option value="18:00 - 19:00">18:00 - 19:00</option>
                                                        <option value="19:00 - 20:00">19:00 - 20:00</option>
                                                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                                                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                                                        <option value="22:00 - 23:00">22:00 - 23:00</option>

                                                    </select>

                                                </div>
                                            @elseif($serviceid == 185)
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Name" maxlength="30" />
                                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />
                                                    <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                                                    <input required type="date" class="form-control"
                                                        name="darshan_date" maxlength="10" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label number">Photo</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="photo" />
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card
                                                        (Front&Back)</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="aadhaar_card" />
                                                    <label for="time" class="form-label">நேரம்</label>
                                                    <select required class="form-control " id="time" name="time"
                                                        style="width: 100%;">
                                                        <option value="">Select Time</option>
                                                        <option value="03:00 - 04:00">03:00 - 04:00</option>
                                                        <option value="04:00 - 05:00">04:00 - 05:00</option>
                                                        <option value="05:00 - 06:00">05:00 - 06:00</option>
                                                        <option value="06:00 - 07:00">06:00 - 07:00</option>
                                                        <option value="07:00 - 08:00">07:00 - 08:00</option>
                                                        <option value="08:00 - 09:00">08:00 - 09:00</option>
                                                        <option value="09:00 - 10:00">09:00 - 10:00</option>
                                                        <option value="10:00 - 11:00">10:00 - 11:00</option>
                                                        <option value="11:00 - 12:00">11:00 - 12:00</option>
                                                        <option value="12:00 - 13:00">12:00 - 13:00</option>
                                                        <option value="02:00 - 03:00">02:00 - 03:00</option>
                                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                                        <option value="17:00 - 18:00">17:00 - 18:00</option>
                                                        <option value="18:00 - 19:00">18:00 - 19:00</option>
                                                        <option value="19:00 - 20:00">19:00 - 20:00</option>
                                                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                                                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                                                        <option value="22:00 - 23:00">22:00 - 23:00</option>

                                                    </select>

                                                </div>
                                            @elseif($serviceid == 186)
                                                <div class="mb-3 col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input required type="text" class="form-control" name="name"
                                                        placeholder="Name" maxlength="30" />
                                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                                    <input required type="text" maxlength="10" class="form-control"
                                                        name="mobile" placeholder="Mobile Number" />
                                                    <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                                                    <input required type="date" class="form-control"
                                                        name="darshan_date" maxlength="10" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="photo" class="form-label number">Photo</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="photo" />
                                                    <label for="aadhaar_card" class="form-label">Aadhaar Card
                                                        (Front&Back)</label>
                                                    <input required type="file" maxlength="20" class="form-control"
                                                        name="aadhaar_card" />
                                                    <label for="time" class="form-label">நேரம்</label>
                                                    <select required class="form-control " id="time" name="time"
                                                        style="width: 100%;">
                                                        <option value="">Select Time</option>
                                                        <option value="03:00 - 04:00">03:00 - 04:00</option>
                                                        <option value="04:00 - 05:00">04:00 - 05:00</option>
                                                        <option value="05:00 - 06:00">05:00 - 06:00</option>
                                                        <option value="06:00 - 07:00">06:00 - 07:00</option>
                                                        <option value="07:00 - 08:00">07:00 - 08:00</option>
                                                        <option value="08:00 - 09:00">08:00 - 09:00</option>
                                                        <option value="09:00 - 10:00">09:00 - 10:00</option>
                                                        <option value="10:00 - 11:00">10:00 - 11:00</option>
                                                        <option value="11:00 - 12:00">11:00 - 12:00</option>
                                                        <option value="12:00 - 13:00">12:00 - 13:00</option>
                                                        <option value="02:00 - 03:00">02:00 - 03:00</option>
                                                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                                                        <option value="17:00 - 18:00">17:00 - 18:00</option>
                                                        <option value="18:00 - 19:00">18:00 - 19:00</option>
                                                        <option value="19:00 - 20:00">19:00 - 20:00</option>
                                                        <option value="20:00 - 21:00">20:00 - 21:00</option>
                                                        <option value="21:00 - 22:00">21:00 - 22:00</option>
                                                        <option value="22:00 - 23:00">22:00 - 23:00</option>

                                                    </select>

                                                </div>
                                            @endif
                                            <div class="text-center">
                                                <p id="nopayment"></p>
                                            </div>
                                            <div class="text-center">
                                                <div class="col-12">
                                                    <div class="mb-0">
                                                        <button id="save" type="submit"
                                                            class="btn btn-primary">Apply</button>
                                                    </div>
                                                </div>
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
         document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
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
                </script>
            @endpush

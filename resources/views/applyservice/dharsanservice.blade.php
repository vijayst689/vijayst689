@extends('layouts.app')
@section('content')
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
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_dharsan') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                        <div class="row">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="service_amount" value="{{ $payment }}">

                        @if ($serviceid == 183)

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control"
                            name="name" placeholder="Name" maxlength="30" />
                            <label for="mobile" class="form-label number">Mobile Number</label>
                            <input required type="text" maxlength="10" class="form-control"
                            name="mobile" placeholder="Mobile Number" />
                            <label for="darshan_date" class="form-label">தரிசனம் தேதி</label>
                            <input required type="date" class="form-control"
                            name="darshan_date" maxlength="10" />
                            <label for="route" class="form-label">Route</label>
                            <select required class="form-control " id="route" name="route"  style="width: 100%;">
                            <option value="">Select Route</option>
                            <option value="Pamba-Marakkoottam-4Kms">Pamba-Marakkoottam-4Kms</option>
                            <option value="Vandiperiyar-Sathram-Pulmedu-16Kms">Vandiperiyar-Sathram-Pulmedu-16Kms</option>
                            <option value="Erumely-Kalaketti Traditional Path-46Kms">Erumely-Kalaketti Traditional Path-46Kms</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="photo" class="form-label number">Photo</label>
                            <input required type="file" maxlength="20" class="form-control"
                            name="photo" />
                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front&Back)</label>
                            <input required type="file" maxlength="20" class="form-control"
                            name="aadhaar_card" />
                            <label for="time" class="form-label">நேரம்</label>
                            <select required class="form-control " id="time" name="time"  style="width: 100%;">
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
                            <input required type="text" class="form-control"
                            name="name" placeholder="Name" maxlength="30" />
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
                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front&Back)</label>
                            <input required type="file" maxlength="20" class="form-control"
                            name="aadhaar_card" />
                            <label for="time" class="form-label">நேரம்</label>
                            <select required class="form-control " id="time" name="time"  style="width: 100%;">
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
                            <input required type="text" class="form-control"
                            name="name" placeholder="Name" maxlength="30" />
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
                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front&Back)</label>
                            <input required type="file" maxlength="20" class="form-control"
                            name="aadhaar_card" />
                            <label for="time" class="form-label">நேரம்</label>
                            <select required class="form-control " id="time" name="time"  style="width: 100%;">
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
                            <input required type="text" class="form-control"
                            name="name" placeholder="Name" maxlength="30" />
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
                            <label for="aadhaar_card" class="form-label">Aadhaar Card (Front&Back)</label>
                            <input required type="file" maxlength="20" class="form-control"
                            name="aadhaar_card" />
                            <label for="time" class="form-label">நேரம்</label>
                            <select required class="form-control " id="time" name="time"  style="width: 100%;">
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
                         <div class="text-center"><p id="nopayment"></p></div>
                           <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
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

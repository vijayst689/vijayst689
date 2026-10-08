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
                            <form class="row g-4" action="{{ url('submitapply_smartcard') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    @if ($serviceid == 236)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />
                                            <label for="smart_card" class="form-label">Smart
                                                Card(Front & Back)</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Smart Card" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label>Family Head Aadhaar</label>
                                            <input id="family_head_aadhaar" class="form-control" required type="file"
                                                name="family_head_aadhaar">
                                            <label>Already Applied Application</label>
                                            <input id="already_applied_application" class="form-control" required
                                                type="file" name="already_applied_application">
                                        </div>
                                    @elseif ($serviceid == 237)
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="dist_id" class="form-label">District</label>
                                            <select name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label style="color:#23e156" for="vao_area" class="form-label">VAO</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="vao_area" placeholder="VAO" />
                                            <label style="color:#23e156" for="door_no" class="form-label">Door No</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="door_no" placeholder="Door No" />
                                            <label style="color:#23e156" for="street_name" class="form-label">Street
                                                Name</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="street_name" placeholder="Street Name" />
                                            <label style="color:#23e156" for="postal_area_english"
                                                class="form-label">Postal
                                                Area</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="postal_area_english" placeholder="Postal Area" />
                                            <label style="color:#23e156" for="aadhaar_card" class="form-label">Adhaar
                                                card (front & Back)</label>
                                            <input required type="file" class="form-control" name="aadhaar_card"
                                                placeholder="Adhaar card (front & Back)" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label style="color:#23e156" for="taluk_id" class="form-label">Taluk</label>
                                            <select name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input required type="text" class="form-control" name="pin_code"
                                                placeholder="Pin Code" />
                                            <label style="color:#23e156" for="mobile" class="form-label number">Mobile
                                                Number</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="Mobile Number" maxlength="10" />
                                            <label style="color:#23e156" for="street_name_tamil" class="form-label">தெரு
                                                பெயர்</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="street_name_tamil" placeholder="தெரு பெயர்" />
                                            <label style="color:#23e156" for="postal_area_tamil"
                                                class="form-label">அஞ்சல் பெயர்</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="postal_area_tamil" placeholder="அஞ்சல் பெயர்" />

                                            <label style="color:#23e156" for="smart_card" class="form-label">Smart
                                                Card(Front & Back)</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Smart Card" />
                                        </div>
                                    @elseif($serviceid == 238)
                                        <div class="mb-3 col-md-6">

                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">தாலுகா</label>
                                            <select required name="taluk_id" id="talukid" class="form-control change">
                                                <option value="">Select Taluk</option>
                                                @foreach ($taluk as $t)
                                                    <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />

                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />

                                            <label for="photo" class="form-label">புகைப்படம்</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="photo" />
                                        </div>
                                    @elseif($serviceid == 239)
                                        <div class="mb-3 col-md-6">

                                            <label for="aadhaar_card" class="form-label">Adhaar Card (குடும்ப
                                                தலைவர்)</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />

                                            <label for="dist_id" class="form-label">தாலுகா</label>
                                            <select required name="taluk_id" id="talukid" class="form-control change">
                                                <option value="">Select Taluk</option>
                                                @foreach ($taluk as $t)
                                                    <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smart_card" class="form-label">Smart Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smart_card" />
                                        </div>
                                    @elseif($serviceid == 240)
                                        <div class="mb-3 col-md-6">

                                            <label>Aadhaar Card</label>
                                            <input required id="aadhaar_card" class="form-control" type="file"
                                                name="aadhaar_card">

                                            <label for="mobile" class="form-label number">Mobile Number (Adhaar
                                                Link)</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label for="smart_card" class="form-label">Smart card</label>
                                            <input accept="image/jpeg, image/png" required type="file"
                                                class="form-control" name="smart_card" />

                                            <label for="dist_id" class="form-label">தாலுகா</label>
                                            <select required name="taluk_id" id="talukid" class="form-control change">
                                                <option value="">Select Taluk</option>
                                                @foreach ($taluk as $t)
                                                    <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($serviceid == 241)
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />
                                            <label for="smart_card" class="form-label">Smart
                                                Card(Front & Back)</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Smart Card" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">தாலுகா</label>
                                            <select required name="taluk_id" id="talukid" class="form-control change">
                                                <option value="">Select Taluk</option>
                                                @foreach ($taluk as $t)
                                                    <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($serviceid == 242)
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number (Adhaar Link)</label>
                                            <input required maxlength="10" type="text" class="form-control number"
                                                name="mobile" placeholder="Mobile Number (Adhaar Link)" />
                                            <label for="smart_card" class="form-label">Smart
                                                Card(Front & Back)</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Smart Card" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smart_mobile" class="form-label">Mobile Number (Smart Card
                                                Link)</label>
                                            <input required maxlength="10" type="text" class="form-control number"
                                                name="smart_mobile" placeholder="Mobile Number (Smart Card Link)" />
                                            <label for="dist_id" class="form-label">தாலுகா</label>
                                            <select required name="taluk_id" id="talukid" class="form-control change">
                                                <option value="">Select Taluk</option>
                                                @foreach ($taluk as $t)
                                                    <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($serviceid == 243)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />
                                            <label for="smart_card" class="form-label">Smart
                                                Card(Front & Back)</label>
                                            <input required type="file" class="form-control" name="smart_card"
                                                placeholder="Smart Card" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required maxlength="10" type="text" class="form-control number"
                                                name="mobile" placeholder="Mobile Number" />
                                            <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />
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
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });
    </script>
@endpush

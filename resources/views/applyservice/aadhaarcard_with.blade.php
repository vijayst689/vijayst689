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
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitaadhaar_without') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Applicant Name</label>
                                        <input required type="text" class="form-control" name="name"
                                            placeholder="Applicant Name" maxlength="30" />

                                        <label for="relationship" class="form-label">Relationship</label>
                                        <select required type="text" class="form-control" name="relationship">
                                            <option value="">Select</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Gaurdian">Gaurdian</option>
                                        </select>

                                        <label for="name_english" class="form-label">Name In English</label>
                                        <input required type="text" maxlength="30" class="form-control"
                                            name="name_english" placeholder="Name In English" />

                                        <label for="name_tamil" class="form-label">தமிழில் பெயர்</label>
                                        <input required type="text" maxlength="30" class="form-control" name="name_tamil"
                                            placeholder="தமிழில் பெயர்" />

                                        <label for="address_proof" class="form-label">Address Proof</label>
                                        <select required type="text" class="form-control" name="address_proof">
                                            <option value="">Select</option>
                                            <option value="Voter id">Voter id</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Electricity Bill">Electricity Bill</option>
                                            <option value="Gas Bill">Gas Bill</option>
                                        </select>

                                        <label for="address_english" class="form-label">Address In English</label>
                                        <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_english"
                                            placeholder="Address In English"></textarea>

                                    </div>
                                    <div class="mb-3 col-md-6">

                                        <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="aadhaar_card" />

                                        <label for="photo" class="form-label">Photo</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="photo" />

                                        <label for="signature" class="form-label">Signature</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="signature" />

                                        <label for="mobile" class="form-label number">Mobile Number</label>
                                        <input required type="text" maxlength="10" class="form-control number"
                                            name="mobile" placeholder="Mobile No" />

                                        <label for="proof" class="form-label">Proof</label>
                                        <input required type="file" maxlength="20" class="form-control"
                                            name="proof" />

                                        <label for="address_tamil" class="form-label">முகவரி தமிழில்</label>
                                        <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_tamil"
                                            placeholder="முகவரி தமிழில்"></textarea>

                                    </div>
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
    </script>
@endpush

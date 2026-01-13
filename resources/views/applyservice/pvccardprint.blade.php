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
                                        class="text-danger">{{ $payment }}</span></h6>
                                <form class="row g-4" action="{{ url('submitpvccardprint') }}" enctype="multipart/form-data"
                                    method="post" id="myForm">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" name="service_amount" value="{{ $payment }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                        @if ($serviceid == 157)
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-sm align-middle mb-2">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="25%">Service</th>
                                                            <th>Document</th>
                                                            <th width="20%">Password</th>
                                                            <th width="8%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="serviceTable">
                                                        <tr>
                                                            <td>
                                                                <select name="service[0][name]"
                                                                    class="form-select form-select service-select"
                                                                    onchange="togglePassword(this); updateTotal()"
                                                                    required>
                                                                    <option value="">Select</option>
                                                                    <option value="aadhaar" data-password="yes">Aadhaar</option>
                                                                    <option value="pan" data-password="yes">PAN</option>
                                                                    <option value="voter" data-password="no">Voter ID</option>
                                                                    <option value="ration" data-password="no">Ration Card</option>
                                                                    <option value="esharam" data-password="no">Esharam Card</option>
                                                                    <option value="ayushman" data-password="no">Ayushman Card</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <input type="file"
                                                                    name="service[0][file]"
                                                                    class="form-control form-control"
                                                                    required>
                                                            </td>

                                                            <td>
                                                                <input type="text"
                                                                    name="service[0][password]"
                                                                    class="form-control form-control password-field d-none"
                                                                    placeholder="Password">
                                                            </td>

                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn btn-success"
                                                                    onclick="addRow()">
                                                                    <i class="bx bx-plus"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif

                                        {{-- TOTAL --}}
                                        <div class="col-12 text-end">
                                            <div class="border rounded p-2 bg-light">
                                                <small>Total Services :
                                                    <strong id="serviceCount">0</strong>
                                                </small><br>
                                                <span class="fw-semibold">
                                                    Total Amount :
                                                    <span class="text-danger">₹ <span id="totalAmount">0</span></span>
                                                </span>
                                            </div>
                                        </div>

                                        <p id="nopayment" class="text-center small mb-0"></p>

                                        {{-- DELIVERY ADDRESS --}}
                                        <div class="col-12">
                                            <div class="border rounded-3 p-3 bg-white">

                                                <div class="d-flex align-items-center mb-2">
                                                    <h5 class="mb-0 fw-semibold">Delivery Address</h5>
                                                </div>

                                                <hr class="my-2">

                                                <div class="row g-3">

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Full Name</label>
                                                        <input type="text"
                                                            name="delivery[name]"
                                                            class="form-control form-control"
                                                            placeholder="Full name">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Mobile</label>
                                                        <input type="text"
                                                            name="delivery[mobile]"
                                                            class="form-control form-control number"
                                                            placeholder="Mobile number" maxlength="10">
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold">Address</label>
                                                        <textarea name="delivery[address]"
                                                            rows="2"
                                                            class="form-control form-control"
                                                            placeholder="House no, street, area"></textarea>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">Pincode</label>
                                                        <input type="text"
                                                            name="delivery[pincode]"
                                                            class="form-control form-control number"
                                                            placeholder="Pincode" maxlength="6">
                                                    </div>

                                                </div>
                                            </div>
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
            @endsection
            @push('page_scripts')
            <script>
                let rowIndex = 1;
                const servicePrice = parseFloat("{{ $payment }}");
                const walletBalance = parseFloat("{{ Auth::user()->wallet }}");

                function addRow() {
                    const table = document.getElementById('serviceTable');
                    const row = table.rows[0].cloneNode(true);

                    row.querySelectorAll('select, input').forEach(el => {
                        el.name = el.name.replace(/\[\d+\]/, `[${rowIndex}]`);
                        el.value = '';
                        el.required = false;
                        if (el.classList.contains('password-field')) {
                            el.classList.add('d-none');
                        }
                    });

                    const btn = row.querySelector('button');
                    btn.className = 'btn btn-danger btn-sm';
                    btn.innerHTML = '<i class="bx bx-trash"></i>';
                    btn.onclick = () => {
                        row.remove();
                        updateTotal();
                    };

                    table.appendChild(row);
                    rowIndex++;
                }

                function togglePassword(select) {
                    const need = select.options[select.selectedIndex]?.dataset.password;
                    const row = select.closest('tr');
                    const pass = row.querySelector('.password-field');
                    const file = row.querySelector('input[type=file]');

                    file.required = select.value !== '';

                    if (need === 'yes') {
                        pass.classList.remove('d-none');
                        pass.required = true;
                    } else {
                        pass.classList.add('d-none');
                        pass.required = false;
                        pass.value = '';
                    }
                }

                function updateTotal() {
                    let count = 0;
                    document.querySelectorAll('.service-select').forEach(s => {
                        if (s.value) count++;
                    });

                    const total = count * servicePrice;

                    document.getElementById('serviceCount').innerText = count;
                    document.getElementById('totalAmount').innerText = total;
                    document.querySelector('input[name="service_amount"]').value = total;

                    const btn = document.getElementById('save');
                    const msg = document.getElementById('nopayment');

                    if (total > walletBalance) {
                        btn.disabled = true;
                        msg.innerHTML = "❌ Insufficient wallet balance";
                        msg.style.color = "red";
                    } else {
                        btn.disabled = false;
                        msg.innerHTML = "";
                    }
                }

                document.getElementById('myForm').addEventListener('submit', () => {
                    document.getElementById('save').disabled = true;
                    document.getElementById('save').innerText = "Submitting...";
                });

                $('#svn').change(function() {
                    if ($('#svn').val() == 'ration') {
                        $('#rationopen').show("slow");
                        $('#rationopen1').show("slow");
                        $('#rationopen').prop("required", false);
                    } else {
                        $('#rationopen').hide("slow");
                        $('#rationopen1').hide("slow");
                        $('#rationopen').prop("required", false);
                    }
                });
            </script>
            @endpush
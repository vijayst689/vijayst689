@extends('layouts.app')

@section('content')
<style>
    /* Custom Styling for Advanced UI */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        border-radius: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card {
        border-left: 4px solid #4f46e5;
    }
    .form-control-advanced {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease-in-out;
        background-color: #f8fafc;
    }
    .form-control-advanced:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        border: none;
        color: #ffffff;
        border-radius: 0.75rem;
        padding: 0.85rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.025em;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        transition: all 0.2s ease-in-out;
    }
    .btn-gradient:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
        color: #ffffff;
    }
    .btn-gradient:disabled {
        background: #cbd5e1;
        box-shadow: none;
        cursor: not-allowed;
    }
    .badge-soft-primary {
        background-color: #e0e7ff;
        color: #4338ca;
        font-weight: 600;
    }
    .badge-soft-success {
        background-color: #dcfce7;
        color: #15803d;
        font-weight: 600;
    }
    .table-custom thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 1.25rem;
    }
    .table-custom tbody td {
        padding: 1rem 1.25rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
</style>

<div class="container-fluid py-4 px-md-5">
    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">{{ $servicename }}</h3>
            <p class="text-muted mb-0 small">Enter details below to submit a voter request</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge badge-soft-primary px-3 py-2 rounded-pill d-flex align-items-center gap-1">
                <i class="bi bi-wallet2"></i> Service Fee: ₹{{ $payment ?? 0 }}
            </span>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if (session()->has('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger border-0 shadow-sm rounded-3 alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <div>{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Left Side: Submission Form --}}
        <div class="col-lg-5 col-xl-4">
            <div class="glass-card p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fw-bold text-dark mb-0">New Application</h5>
                        <span class="badge badge-soft-success rounded-pill px-2.5 py-1">Instant Processing</span>
                    </div>

                    <form onsubmit="return checkpayment(event)" action="{{ url('/submitvoterfind') }}" id="formAccountSettings" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="amount" id="amount">
                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                        <input type="hidden" name="servicepayment" value="{{ $payment }}">

                        {{-- EPIC Input --}}
                        <div class="mb-3.5">
                            <label for="epic_no" class="form-label text-secondary fw-semibold small">EPIC Number</label>
                            <div class="position-relative">
                                <input class="form-control form-control-advanced text-uppercase" 
                                       type="text" 
                                       name="epic_no" 
                                       maxlength="10" 
                                       required 
                                       id="epic_no" 
                                       autofocus 
                                       placeholder="e.g. ABC1234567" />
                            </div>
                        </div>

                        {{-- Mobile Input --}}
                        <div class="mb-4">
                            <label for="mobile" class="form-label text-secondary fw-semibold small">Mobile Number</label>
                            <div class="position-relative">
                                <input class="form-control form-control-advanced" 
                                       type="tel" 
                                       name="mobile" 
                                       maxlength="10" 
                                       pattern="[0-9]{10}"
                                       required 
                                       id="mobile" 
                                       placeholder="10-digit mobile number" />
                            </div>
                        </div>

                        {{-- Insufficient Balance Alert Container --}}
                        <div id="nopayment" class="mb-3"></div>

                        {{-- Submit Button --}}
                        <div class="d-grid pt-2">
                            <button type="submit" id="save" class="btn btn-gradient">
                                Proceed & Submit
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Quick Help Footer --}}
                <div class="mt-4 pt-3 border-top text-center">
                    <p class="text-muted small mb-0">
                        Need help? Contact support if your wallet balance is low.
                    </p>
                </div>
            </div>
        </div>

        {{-- Right Side: History Data Table --}}
        <div class="col-lg-7 col-xl-8">
            <div class="glass-card h-100 p-0 overflow-hidden d-flex flex-column">
                <div class="p-4 border-bottom bg-white d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Recent Transactions</h5>
                        <p class="text-muted small mb-0">List of your recent voter submission requests</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                        Total Records: {{ count($voterdetails) }}
                    </span>
                </div>

                <div class="table-responsive flex-grow-1">
                    <table id="example1" class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>EPIC Number</th>
                                <th>Status / Message</th>
                                <th>Amount</th>
                                <th class="text-end">Datetime</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($voterdetails as $key => $ser)
                                <tr>
                                    <td class="fw-bold text-muted" style="width: 50px;">{{ sprintf('%02d', $key + 1) }}</td>
                                    <td>
                                        <span class="fw-bold text-dark font-monospace">{{ $ser->epic_no }}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">{{ $ser->message ?? 'Submitted' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">₹{{ $ser->amount }}</span>
                                    </td>
                                    <td class="text-end text-muted small">
                                        {{ $ser->date }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <p class="mb-0">No recent transactions found.</p>
                                        </div>
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
@endsection

@push('page_scripts')
<script>
    var ramjibalance = parseFloat("{{ $mainbalance->rawallet ?? 0 }}");
    var amount = parseInt("{{ $payment ?? 0 }}");

    function checkpayment(e) {
        if (amount > ramjibalance) {
            alert("LOW BALANCE");
            $('#save').prop("disabled", true);
            $('#nopayment').html(`
                <div class="alert alert-danger border-0 p-2 text-center small fw-semibold rounded-3">
                    Low Balance For the Service. Please Contact Admin.
                </div>
            `);
            return false;
        } else {
            $("#nopayment").html("");
            $("#save").attr("disabled", true).html('<span class="spinner-border spinner-border-sm me-2" role="status"></span>Processing...');
            $("#amount").val(amount);
            return true;
        }
    }

    $(function() {
        var wallet = "{{ Auth::user()->wallet ?? 0 }}";
        var payment = "{{ $payment ?? 0 }}";
        
        if (parseFloat(payment) > parseInt(wallet)) {
            $('#save').prop("disabled", true);
            $('#nopayment').html(`
                <div class="alert alert-danger border-0 p-2 text-center small fw-semibold rounded-3">
                    Insufficient Wallet Balance. Please recharge.
                </div>
            `);
        }
    });
</script>
@endpush
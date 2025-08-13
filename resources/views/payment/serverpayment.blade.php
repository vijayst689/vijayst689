<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Activation & Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
  <div class="card shadow rounded-4">
    <div class="card-header bg-primary text-white rounded-top-4">
      <h4 class="mb-0">Server Activation & Payment</h4>
    </div>

    @php
    use Carbon\Carbon;

    $status = $paymentdetails->status ?? null;
    $adminPaymentDate = Auth::user()->payment_date ?? null; // Admin updated due date
    $currentDate = Carbon::now();
    $nextBillDate = $adminPaymentDate ? Carbon::parse($adminPaymentDate) : null;

    $needsPayment = false;

    if ($nextBillDate) {
        $daysDiff = $currentDate->diffInDays($nextBillDate, false);

        // Within 5 days before due date (and not past due yet)
        if ($daysDiff <= 5 && $daysDiff > 0) {
            $needsPayment = true;
        }

        // Past or on due date
        if ($daysDiff <= 0) {
            $needsPayment = true; // Modal shows, dashboard restriction handled separately
        }
    }

    // Always show modal if payment is pending or rejected
    if ($status === 'Pending' || $status === 'Rejected') {
        $needsPayment = true;
    }
    @endphp

    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row mb-4">
        <div class="col-md-6">
          <h5>Activation Date</h5>
          <p class="text-muted" id="activation-date">{{  date('d M Y', strtotime(Auth::user()->payment_date)) }}</p>
          @isset($paymentdetails)
            @if($paymentdetails->status == "Approved" && $nextBillDate && $currentDate->lessThan($nextBillDate))
              <p>Next BILL DATE <strong>{{ $nextBillDate->format('d M Y') }}</strong>.</p>
            @endif
          @endisset
        </div>
       
        <div class="col-md-6">
          <h5>Payment Status</h5>
          @if($status == "Pending")
    <span class="badge bg-warning">Pending</span>
@elseif($status == "Approved" && $nextBillDate && $currentDate->lessThan($nextBillDate))
    @php
        $diffDays = $currentDate->diffInDays($nextBillDate, false); // false to get negative if past date
    @endphp

    @if($diffDays <= 5)
        <span class="badge bg-info">Next Due</span>
    @else
        <span class="badge bg-success">Completed</span>
    @endif

@elseif($status == "Rejected")
    <span class="badge bg-danger">Rejected</span>
    <span class="badge bg-warning">Please Pay Again...</span>
@elseif($nextBillDate && $currentDate->greaterThanOrEqualTo($nextBillDate))
    <span class="badge bg-warning">Due</span>
@endif
        </div>

        {{-- Payment Button --}}
        @if($needsPayment)
          <center><button class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#payNowModal">Pay Now</button></center>
        @elseif($status == "Pending" && $nextBillDate && $currentDate->lessThan($nextBillDate))
          <center><button class="btn btn-outline-warning mt-2" disabled>Payment Pending</button></center>
        @elseif($status == "Approved" && $nextBillDate && $currentDate->lessThan($nextBillDate))
          <center><button class="btn btn-outline-success mt-2" disabled>Payment Completed</button></center>
        @endif
      </div>

      <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span>Your account will be activated After the Payment made...</span>
        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-primary">
          ← Dashboard
        </a>
      </div>

      {{-- Payment History --}}
      @if(isset($paymentHistory) && count($paymentHistory) > 0)
        <h5 class="mt-4">Payment History</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Payment Date</th>
                <th>Status</th>
                <th>Amount (₹)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($paymentHistory as $index => $history)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($history->activation_date)->format('d M Y') }}</td>
                <td>
                  @if($history->status == "Approved")
                    <span class="badge bg-success">Approved</span>
                  @elseif($history->status == "Pending")
                    <span class="badge bg-warning">Pending</span>
                  @elseif($history->status == "Rejected")
                    <span class="badge bg-danger">Rejected</span>
                  @endif
                </td>
                <td>{{ number_format($history->payment, 2) }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="payNowModal" tabindex="-1" aria-labelledby="payNowLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="payNowLabel">Make a Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ url('/saveserver_payment') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('upload/qr/qrimgramji.jpeg') }}" alt="Payment Image" class="img-fluid" style="height: 50%; width: 50%">
          </div>
          <p class="text-center">Please proceed with payment of <strong>₹{{ Auth::user()->server_amount }}</strong>.</p>
          <div class="mb-3">
            <label for="paymentProof" class="form-label">Upload Payment Proof (screenshot, receipt)</label>
            <input type="file" class="form-control" id="paymentProof" name="payment_proof" accept="image/*,application/pdf">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Pay Now</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Auto-popup modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let needsPayment = @json($needsPayment);
    if (needsPayment) {
        const payModal = new bootstrap.Modal(document.getElementById('payNowModal'));
        payModal.show();
    }
});
</script>

</body>
</html>

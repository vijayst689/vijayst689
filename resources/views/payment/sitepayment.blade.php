<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Due</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { background: #f8f9fa; }
    .modal-backdrop.show {
        opacity: 0.8 !important; /* darker background */
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="card shadow rounded-4">
    <div class="card-header bg-danger text-white rounded-top-4">
      <h4 class="mb-0">⚠️ Payment Due</h4>
    </div>

    @php
      use Carbon\Carbon;

      $status = $unpaidPayment->paid_status ?? null;
      $adminPaymentDate = $unpaidPayment->payment_date ?? null;
      $currentDate = Carbon::today();
      $dueDate = $adminPaymentDate ? Carbon::parse($adminPaymentDate) : null;

      $showModal = false;
      $dueMsg = '';

      if ($dueDate) {
          $daysDiff = $currentDate->diffInDays($dueDate, false);

          if ($daysDiff === 1) {
              $dueMsg = "Your payment is due tomorrow (" . $dueDate->format('d M Y') . ")";
          }
          if ($daysDiff <= 0) {
              $showModal = true;
              $dueMsg = "Your payment is due today (" . $dueDate->format('d M Y') . ")";
          }
      }

      if ($status === 'Pending' || $status === 'Declined') {
          $showModal = true;
      }else{
          $showModal = false;
      }
    @endphp

    <div class="card-body">
      <div class="mb-3">
        <h5>Payment Date</h5>
        <p class="text-muted">{{ $dueDate ? $dueDate->format('d M Y') : 'Not Set' }}</p>
        @if($dueMsg)
          <div class="alert alert-warning">{{ $dueMsg }}</div>
        @endif
      </div>

      <div class="mb-3">
        <h5>Payment Status</h5>
        @if($status == "Pending")
          <span class="badge bg-warning">Pending</span>
        @elseif($status == "Approved" && $dueDate && $currentDate->lessThan($dueDate))
          <span class="badge bg-success">Completed</span>
        @elseif($status == "Waiting")
          <span class="badge bg-danger">Waiting for approval...</span>
           @elseif($status == "Declined")
          <span class="badge bg-danger">Declined</span>
        @elseif($dueDate && $currentDate->greaterThanOrEqualTo($dueDate))
          <span class="badge bg-danger">Due</span>
        @endif
      </div>

      <div class="alert alert-info d-flex justify-content-between align-items-center">
        <span>Please clear your payment to continue using services.</span>
        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-primary">← Dashboard</a>
      </div>
    </div>
  </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="payNowModal" tabindex="-1" aria-labelledby="payNowLabel" aria-hidden="true" 
     data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="payNowLabel">⚠️ Payment Due Today</h5>
      </div>

      <form action="{{ url('/save_sitepayment') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="row_id" value="{{ $unpaidPayment->id ?? '' }}">
        <input type="hidden" name="amount" value="{{ $unpaidPayment->amount ?? '' }}">
        <div class="modal-body">
          <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('upload/qr/qrimgramji.jpeg') }}" alt="Payment QR" class="img-fluid" style="height:50%;">
          </div>
          <p class="text-center">
             ⚠️ Reminder: Payment of 
            <strong>{{ $unpaidPayment->amount }}</strong> 
            for <strong>{{ $unpaidPayment->payment_reason }}</strong>
          </p>
          <div class="mb-3">
            <label for="paymentProof" class="form-label">Upload Payment Proof</label>
            <input type="file" class="form-control" id="paymentProof" name="payment_proof" accept="image/*,application/pdf" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">💳 Submit Payment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let showModal = @json($showModal);
    if (showModal) {
        const payModal = new bootstrap.Modal(document.getElementById('payNowModal'));
        payModal.show();
    }
});
</script>

</body>
</html>

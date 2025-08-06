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

    $status = $paymentdetails->status ?? NULL;
    $paymentDate = Auth::user()->payment_date ?? NULL;
    $paidDate = $paymentdetails->activation_date ?? NULL; // Make sure this is in Y-m-d format

     $paymentCarbon = $paidDate ? Carbon::parse($paidDate) : null;
  $currentMonth = Carbon::now()->month;
  $currentYear = Carbon::now()->year;
  $isThisMonthPayment = $paymentCarbon && 
                          $paymentCarbon->month == $currentMonth && 
                          $paymentCarbon->year == $currentYear;
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
          @if($paymentdetails->status == "Approved" && $isThisMonthPayment)
          <p>Next BILL DATE <strong>{{ date('d M Y', strtotime(Auth::user()->payment_date . ' +1 month')) }}</strong>.</p>
          @endif
          @endif
        </div>
       
        <div class="col-md-6">
          <h5>Payment Status</h5>
         @if(!$isThisMonthPayment || ($paymentdetails->status == "Pending"))
         
          <span class="badge bg-warning" id="payment-status">Pending</span>

          @elseif($paymentdetails->status == "Approved" && $isThisMonthPayment)
           <span class="badge bg-success" id="payment-status">Completed</span>
          @elseif($paymentdetails->status == "Rejected" && $isThisMonthPayment)
          <span class="badge bg-danger" id="payment-status">Rejected</span>
          <span class="badge bg-warning">Please Pay Again...</span>
          @endif
          
          <br>
         
        </div>
        @if(!$isThisMonthPayment || ($paymentdetails->status == "Rejected"))
    <center><button class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#payNowModal">Pay Now</button></center>
@elseif($paymentdetails->status == "Pending" && $isThisMonthPayment)
    <center><button class="btn btn-outline-warning mt-2" disabled>Payment Pending</button></center>
@elseif($paymentdetails->status == "Approved" && $isThisMonthPayment)
    <center><button class="btn btn-outline-success mt-2" disabled>Payment Completed</button></center>
@endif
       
      </div>

    <div class="alert alert-info d-flex justify-content-between align-items-center">
  <span>Your account will be activated After the Payment made...</span>
  <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-primary">
    ← Dashboard
  </a>
</div>

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

      <form  action="{{ url('/saveserver_payment') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="modal-body">

          <!-- Centered Image -->
          <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('upload/qr/qrimgramji.jpeg') }}" alt="Payment Image" class="img-fluid" style="height: 50%; width: 50% ">
          </div>

          <p class="text-center">Please proceed with payment of <strong>₹{{ Auth::user()->server_amount }}</strong>.</p>

          <div class="mb-3">
            <label for="paymentProof" class="form-label">Upload Payment Proof (screenshot, receipt)</label>
            <input type="file" class="form-control" id="paymentProof" name="payment_proof" accept="image/*,application/pdf">
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Pay Now</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Auto-popup modal every 1 hour -->
<script>
/*document.addEventListener('DOMContentLoaded', function () {
  const paymentStatus = 'pending'; // Change to 'paid' if already paid

  if (paymentStatus !== 'paid') {
    const payModal = new bootstrap.Modal(document.getElementById('payNowModal'));
    setInterval(() => {
      payModal.show();
    }, 3600000); // Every 1 hour
  }
});*/
</script>

</body>
</html>

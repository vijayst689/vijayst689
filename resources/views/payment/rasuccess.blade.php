@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-4">

                    <div class="mb-3">
                        <div class="rounded-circle bg-success text-white mx-auto"
                             style="width:90px;height:90px;line-height:90px;font-size:45px;">
                            ✓
                        </div>
                    </div>

                    <h3 class="text-success fw-bold">Payment Successful</h3>
                    <p class="text-muted">Your transaction has been completed successfully.</p>

                    <hr>

                    <div class="text-start">
                        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
                        <p><strong>Amount:</strong> ₹{{ number_format($order->payment, 2) }}</p>
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        @if(!empty($order->utr))
                            <p><strong>UTR:</strong> {{ $order->utr }}</p>
                        @endif
                    </div>

                    <a href="{{ url('/dashboard') }}" class="btn btn-success w-100 mt-3">
                        Go to Dashboard
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

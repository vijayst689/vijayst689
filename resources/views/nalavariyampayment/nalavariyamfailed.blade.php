@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body text-center p-4">

                    <div class="mb-3">
                        <div class="rounded-circle bg-danger text-white mx-auto"
                             style="width:90px;height:90px;line-height:90px;font-size:45px;">
                            ✕
                        </div>
                    </div>

                    <h3 class="text-danger fw-bold">Payment Failed</h3>
                    <p class="text-muted">We could not process your payment.</p>

                    <hr>

                    <div class="text-start">
                        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
                        <p><strong>Amount:</strong> ₹{{ number_format($order->payment, 2) }}</p>
                        <p><strong>Status:</strong> {{ $order->status ?? 'FAILED' }}</p>
                    </div>

                    <a href="{{ url('/') }}" class="btn btn-danger w-100 mt-3">
                        Try Again
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

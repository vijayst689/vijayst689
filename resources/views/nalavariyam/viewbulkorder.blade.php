@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
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
                 {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">🧾 Bulk Order — <span class="text-primary">{{ $user->name }}</span></h5>
                </div>

                {{-- Orders Table --}}
                <div class="table-responsive">
                    <table id="" class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th>Service Name</th>
                                <th class="text-end">Unit Price (₹)</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Amount (₹)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $quantity = 0;
                            @endphp
                            @foreach ($bulkorders as $key => $bulkorderslist)
                                @php
                                    $quantity += $bulkorderslist->quantity;
                                    $total += $bulkorderslist->amount * $bulkorderslist->quantity;
                                @endphp
                                <tr>
                                    <td class="text-center fw-semibold">{{ $key + 1 }}</td>
                                    <td>{{ $bulkorderslist->service_name }}</td>
                                    <td class="text-end">₹ {{ number_format($bulkorderslist->amount, 2) }}</td>
                                    <td class="text-end">{{ $bulkorderslist->quantity }}</td>
                                    <td class="text-end text-success fw-semibold">
                                        ₹ {{ number_format($bulkorderslist->amount * $bulkorderslist->quantity, 2) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($bulkorderslist->added_datetime)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        @php
                            $deliveryfee = ($quantity > 0 && $quantity < 5) ? 50 : 0;
                        @endphp

                        <tfoot class="table-light fw-bold">
                            @if ($deliveryfee > 0)
                                <tr>
                                    <td colspan="4" class="text-end">Delivery Fee</td>
                                    <td class="text-end text-danger">₹ {{ number_format($deliveryfee, 2) }}</td>
                                    <td></td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="4" class="text-end">Total</td>
                                <td class="text-end text-success">₹ {{ number_format($total + $deliveryfee, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="hidden" name="delivery_amount" value="{{ $deliveryfee }}">
                </div>

                {{-- Status & Buttons --}}
                <form method="POST" action="{{ url('updatebulkstatus') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-4">
                            <div class="mb-3 d-flex align-items-center">
                                <select required name="status" id="" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="button" onclick="show_address()" class="btn btn-outline-primary me-2">
                            <i class="bi bi-geo-alt"></i> View Address
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Submit
                        </button>
                    </div>
                </form>

                {{-- Address Modal --}}
                <div class="modal fade" id="address_modal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow-lg border-0">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="addressModalLabel">Customer Address</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
                                <p class="mb-1"><strong>Address:</strong> {{ $user->address }}</p>
                                <p class="mb-0"><strong>Phone:</strong> {{ $user->phone }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
@push('page_scripts')
<script>
    function show_address() {
        const modal = new bootstrap.Modal(document.getElementById('address_modal'));
        modal.show();
    }
</script>
@endpush
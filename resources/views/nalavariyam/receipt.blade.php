@extends('layouts.app')
@section('content')
<style>

    @media print {
    .no-print,
    .sidebar,
    .main-sidebar,
    footer,
    .main-footer,
    nav,
    header {
        display: none !important;
    }

     aside,
    aside *,
    .sidebar,
    .main-sidebar {
        display: none !important;
        visibility: hidden !important;
        width: 0 !important;
    }

     .position-fixed.bottom-0.end-0.m-3.d-flex.align-items-center {
        display: none !important;
    }

    body {
        background: #fff !important;
    }

    #printable-bill, #printable-bill * {
        background: #fff !important;
        color: #000 !important;
        box-shadow: none !important;
    }

    #printable-bill {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
/*@media print {
    body {
        background: #fff !important;
        color: #000 !important;
    }

    .no-print {
        display: none !important;
    }

    #printable-bill, #printable-bill * {
        background: #fff !important;
        color: #000 !important;
        box-shadow: none !important;
    }

    #printable-bill {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

   
    .main-wrapper > aside,
    footer,
    nav {
        display: none !important;
    }
}*/
</style>
<main class="main-wrapper">
    <div class="main-content">
        <div class="row" id="printable-bill">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center> <img src="{{ URL::to('/') }}/upload/header.png" width="700"></br><b>Receipt</b></center>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div><strong>From : </strong>{{ $users->name }} </br>{{ $users->address }}</div>
                            </div>
                            <div class="col-sm-6" style="text-align: right;">
                                <div>

                                    Cell Number :{{ $users->phone }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-sm-9">
                                <div>
                                    <strong>Bill To : </strong>{{ $customers->name }}, {{ $customers->phone }}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div style="text-align: right;">
                                    <strong>Receipt No : </strong> 00{{ $customers->id }}</br>
                                    <strong> Date : </strong> {{ date('Y-m-d') }}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th class="right" style="text-align: right;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td class="left strong">{{ $services->service_name }} (சந்தா)</td>
                                        <td class="right" style="text-align: right;">120</td>
                                    </tr>

                                    <tr>

                                        <td class="left">
                                            <h5><b id="header1">Amount in words : </b> {{ $getamount }}</h5>
                                        </td>
                                        <td class="right" style="text-align: right;">Total 120</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-9 col-sm-5">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left">
                                                </br>
                                            </br>
                                            <strong>Reference No : {{ $formdata->application_no }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="right">
                                        </br>
                                        <div>

                                        </div>
                                        <strong>Authorised Signatory</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-12">
                    <center><button onclick="printBill()" class="btn btn-primary "><i class="fas fa-print"></i>
                    Print</button></center>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</main>
@endsection
@push('page_scripts')
<script type="text/javascript">
   function printBill() {

    window.print();

    }
</script>
@endpush

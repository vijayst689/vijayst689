@extends('layouts.app')
@section('content')
<style>
   /* General Styles */
   .header-img {
      max-width: 100%;
      height: auto;
   }

   .table-clear td {
      border: none !important;
   }

   /* Print Styles */
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

      body {
         background: #fff !important;
         margin: 0;
         padding: 0;
         color: #000;
      }

      #printable-bill,
      #printable-bill * {
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

      .header-img {
         max-width: 100%;
         height: auto;
      }
   }
</style>

<div class="row" id="printable-bill">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <div class="text-center mb-3">
               <img src="{{ URL::to('/') }}/upload/header.png" class="header-img mb-2">
               <h4 class="mb-0"><b>Receipt</b></h4>
            </div>
            <hr>
            <div class="row mb-3">
               <div class="col-sm-6">
                  <strong>From:</strong><br>
                  {{ $users->name }}<br>
                  {{ $users->address }}
               </div>
               <div class="col-sm-6 text-end">
                  <strong>Cell Number:</strong> {{ $users->phone }}
               </div>
            </div>

            <hr>
            <div class="row mb-4">

               <div class="col-sm-9">
                  <strong>Bill To:</strong> {{ $customers->name }}, {{ $customers->phone }}
               </div>
               <div class="col-sm-3 text-end">
                  <strong>Receipt No:</strong> 00{{ $customers->id }}<br>
                  <strong>Date:</strong> {{ date('Y-m-d') }}
               </div>

            </div>
            <div class="table-responsive-sm">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Service Name</th>
                        <th class="text-end">Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{ $services->service_name }} (சந்தா)</td>
                        <td class="text-end">120</td>
                     </tr>
                     <tr>
                        <td><b>Amount in words:</b> {{ $getamount }}</td>
                        <td class="text-end"><b>Total:</b> 120</td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="row">
               <div class="row mt-4">
                  <div class="col-lg-9 col-sm-5">
                     <strong>Reference No:</strong> {{ $formdata->application_no }}
                  </div>
                  <div class="col-lg-3 col-sm-5 text-end">
                     <strong>Authorised Signatory</strong>
                  </div>
               </div>

               <div class="row no-print mt-4">
                  <div class="col-12 text-center">
                     <button onclick="printBill()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Print
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </section>
   @endsection
   @push('page_scripts')
<script type="text/javascript">
    function printBill() {
        window.print();
    }
</script>
@endpush

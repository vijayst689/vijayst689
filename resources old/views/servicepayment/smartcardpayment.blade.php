@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                            <h5 class="card-title">Smartcard Payment</h5>
                            <form class="row g-4" action="{{ url('/savesmart_payment') }}" enctype="multipart/form-data"
                            method="post">
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <table id="" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Service Name</th>
                                            <th>Taluk</th>
                                            <th>Distributor</th>
                                            <th>Retailer</th>
                                            <th>Customer</th>
                                            <th>Admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><select required class="form-control change" name="serviceid" id="serviceid">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $s)
                                                <option value="{{ $s->id }}">{{ $s->service_name }}</option>
                                                @endforeach
                                            </select></td>
                                            <td><select required class="form-control change" name="taluk_id" id="taluk_id">
                                                <option value="">Select</option>
                                                @foreach ($taluk as $t)
                                                <option value="{{ $t->id }}">{{ $t->taluk_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>


                                        <input name="parent_id" type="hidden" value="{{ $serviceid }}" />

                                        <td><input class="form-control decimal" name="distributor_amount" id="distributor_amount" type="text" maxlength="6" /></td>
                                        <td><input class="form-control decimal" name="retailer_amount" type="text" maxlength="6" id="retailer_amount" /></td>
                                        <td><input class="form-control decimal" name="customer_amount" type="text" maxlength="6" id="customer_amount" /></td>
                                        <td><input class="form-control decimal" name="admin_amount" type="text" maxlength="6" id="admin_amount" /></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <div class="col-12">
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
<script>

    $('.change').on('change', function() {
        var taluk_id = $("#taluk_id").val();
        var service_id = $("#serviceid").val();
        var url = "{{ url('get_smartcard_payment') }}/" + taluk_id + "/" + service_id;
        if(taluk_id != "" && service_id != ""){
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $("#distributor_amount").val(result.distributor_amount);
                    $("#retailer_amount").val(result.retailer_amount);
                    $("#customer_amount").val(result.customer_amount);
                    $("#admin_amount").val(result.admin_amount);
                }
            });
        }

    });

</script>
@endpush

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
                    <h5 class="card-title">Activation Member Details</h5>
                    <form class="row g-4" action="{{ url('/savenalavariyam_payment') }}" enctype="multipart/form-data"
                        method="post">
                        {{ csrf_field() }}
                        <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>District</th>
                                        <th>Rolle</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                @foreach ($member as $key => $m)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $m->id }}</td>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->district_name }}</td>
                                        @if( $m->nalavariyam_usertype == 3)
                                        <td>Distributor</td>
                                        @elseif($m->nalavariyam_usertype == 4)
                                        <td>Retailer</td>
                                        @else
                                        <td class="text-danger">Empty</td>
                                        @endif
                                        <td style="white-space: nowrap">
                                            @php
                                                $address1 = $m->address;
                                                $address1 = str_replace(PHP_EOL, ' ', $address1);
                                                $address1 = str_replace("\r\n", ' ', $address1);
                                                $address1 = str_replace("\n", ' ', $address1);
                                                $NEWLINE_RE = '/(\r\n)|\r|\n/';
                                                $address1 = preg_replace($NEWLINE_RE, ' ', $address1);
                                            @endphp
                                           <a onclick="userstatus('{{ $m->id }}','{{ $address1 }}')" type="button" class="btn-sm btn btn-danger"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <div class="modal fade" id="userdata">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title align-self-center" id="exampleModalform1">User Details</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label"><span style="color:red"></span>Address
                        </label>
                        <label for="" class="col-sm-8 col-form-label"><span style="color:red"
                                id="showaddress"></span> </label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a type="" class=""></a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')

<script>

     function userstatus(id, address) {
            $("#statusid").val(id);
            $("#showaddress").text(address);
            $("#userdata").modal("show");
        }
</script>
@endpush

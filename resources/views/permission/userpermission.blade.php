@extends('layouts.app')
@section('content')
<style type="text/css">
    .row-padded {
        background-color: ;
        padding: 1px;
        margin: 4px;
        border: 1px solid skyblue;
    }
</style>
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Permissions</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end row-->

            <div class="card mt-4">
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
                <div class="card-body">
                     <div class="row">
                        <form class="row" action="{{ url('/savepermission') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="user_id" value="{{ $userid }}">
                         <h5 class="text-center text-danger">PDF Services</h5>
                        @foreach($findservices as $ser)
                <div class="col-6 col-xl-6">
                    <div class="row row-padded">
                    <label class="form-check-label col-sm-10" for="pdf{{ $ser->id }}">{{ $ser->name }}</label>
                    <div class="icheck-success d-inline col-sm-2">
                         
                        <input name="service_id[]" @foreach($checkpermission1 as $c) @if($c->service_id == $ser->id) checked @endif  @endforeach type="checkbox" id="pdf{{ $ser->id }}" value="{{ $ser->id }}_1">
                       
                    </div> 
                </div>
                </div>
                @endforeach
                        <h5 class="text-center text-danger mt-4">Utility Services</h5>
                        @foreach($utilityservices as $ser1)
                <div class="col-6 col-xl-6">
                    <div class="row row-padded">
                    <label class="form-check-label col-sm-10" for="ut{{ $ser1->id }}">{{ $ser1->name }}</label>
                    <div class="icheck-success d-inline col-sm-2">
                        <input name="service_id[]"  @foreach($checkpermission2 as $c) @if($c->service_id == $ser1->id) checked @endif  @endforeach type="checkbox" id="ut{{ $ser1->id }}" value="{{ $ser1->id }}_2">
                    </div> 
                </div>
                </div>
                @endforeach
                <h5 class="text-center text-danger mt-4">Pancard Services</h5>
                        @foreach($panservices as $ser1)
                <div class="col-6 col-xl-6">
                    <div class="row row-padded">
                    <label class="form-check-label col-sm-10" for="pan{{ $ser1->id }}">{{ $ser1->name }}</label>
                    <div class="icheck-success d-inline col-sm-2">
                        <input name="service_id[]"  @foreach($checkpermission4 as $c) @if($c->service_id == $ser1->id) checked @endif  @endforeach type="checkbox" id="pan{{ $ser1->id }}" value="{{ $ser1->id }}_4">
                    </div> 
                </div>
                </div>
                @endforeach
                        <h5 class="text-center text-danger mt-4">Other Services</h5>
                        @foreach($services as $ser2)
                <div class="col-6 col-xl-6">
                    <div class="row row-padded">
                    <label class="form-check-label col-sm-10" for="ser{{ $ser2->id }}">{{ $ser2->service_name }}</label>
                    <div class="icheck-success d-inline col-sm-2">
                        <input name="service_id[]"  @foreach($checkpermission3 as $c) @if($c->service_id == $ser2->id) checked @endif  @endforeach type="checkbox" id="ser{{ $ser2->id }}" value="{{ $ser2->id }}_3">
                    </div> 
                </div>
                </div>
                @endforeach
                 <div class="col-md-12 mt-4">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-grd-primary px-4">Submit</button>
                                        </div>
                                    </div>
            </form> 
            </div>

                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
       
    </script>
@endpush

@extends('layouts.app')
@section('content')
<main class="main-wrapper">
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $servicename }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
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
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0 fw-bold"></h5>
                            </div>
                        </div>
                        <form class="row g-4">
                       
                    <div id="datahide" class="row col-md-12 mt-4">
                    @foreach($viewservice as $service)
                         <div class="col-md-6 mb-2">
                                    <label for="input1" class="form-label">Name</label>
                                    <input type="text" disabled class="form-control" placeholder="Name" value="{{ $service->name }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">Phone</label>
                                    <input type="text" value="{{ $service->phone }}" disabled class="form-control"  placeholder="Phone">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">Aadhaar No</label>
                                    <input type="text" value="{{ $service->aadhaar_no }}" disabled class="form-control number" placeholder="Aadhaar No">
                                </div>
                                @foreach($service->document as $doc)
                                    <div class="col-md-6 mb-2">
                                    <label for="input3" class="form-label">{{ $doc->file_name }}</label>
                                    @if($doc->cus_docx != "")
                                          <br><a target="_blank" class="btn btn-grd btn-grd-primary px-1"  href="{{ URL::to('/') }}/upload/document/{{ $doc->cus_docx }}" >Download</a>
                                          @else
                                           <br><a class="btn btn-grd btn-grd-primary px-1">No File</a>
                                        @endif
                                </div>
                                @endforeach
                    @endforeach
         
                </div>

                </form>
            </div>
        </div>
    </div>
</div><!--end row-->
</div>
</main>
@endsection
@push('page_scripts')
<script>

</script>
@endpush

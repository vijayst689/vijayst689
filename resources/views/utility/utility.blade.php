@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($utlityser as $ut)
                        <div class="col-md-3 col-lg-2 col-sm-4 mb-2">
                            <div class="text-center">
                                 <a href="{{ url('/utilityservice', $ut->id) }}">
                                    <img src="/upload/uti_image/{{ $ut->ser_image }}" alt=""
                                        class="rounded-circle img-thumbnail avatar-xl"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
    </script>
@endpush

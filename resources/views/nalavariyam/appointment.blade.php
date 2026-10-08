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
                    <div class="card-body">
                        <h1 class="card-title">பதவி நியமனச் சான்றிதழ்</h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('add_appointment') }}" enctype="multipart/form-data"
                                method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">பெயர் தமிழில்</label>
                                        <input required type="text" class="form-control" name="name"
                                            placeholder="பெயர்" maxlength="100" />

                                        <label for="district" class="form-label">மாவட்டம் தமிழில்</label>
                                        <input required type="text" class="form-control" name="district"
                                            placeholder="மாவட்டம்" maxlength="100" />

                                        <label for="village" class="form-label">கிராமம் தமிழில்</label>
                                        <input required type="text" class="form-control" name="village"
                                            placeholder="கிராமம்" maxlength="100" />

                                        <label for="station_name" class="form-label">சேவை நிலையத்தின் பெயர்</label>
                                        <input required type="text" class="form-control" name="station_name"
                                            placeholder="சேவை நிலையத்தின் பெயர்" maxlength="100" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label">செல் நம்பர்</label>
                                        <input required type="text" maxlength="10" class="form-control number" name="mobile"
                                            placeholder="Mobile Number" />

                                        <label for="taluk" class="form-label">தாலுகா தமிழில்</label>
                                        <input required type="text" maxlength="100" class="form-control" name="taluk"
                                            placeholder="தாலுகா" />

                                        <label for="photo" class="form-label">புகைப்படம்</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="photo" />

                                    </div>

                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush

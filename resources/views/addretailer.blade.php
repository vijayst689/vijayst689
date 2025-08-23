@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
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
    <div class="row">
           <div class="col-12 col-xl-12">
            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
              <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                  <div class="">
                    <h5 class="mb-0 fw-bold">Add Retailer</h5>
                  </div>
                  <div class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                      data-bs-toggle="dropdown">
                      <span class="material-icons-outlined fs-5">more_vert</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                 </div>
								<form class="row g-4">
									<div class="col-md-6">
										<label for="input1" class="form-label">First Name</label>
										<input type="text" class="form-control" id="input1" placeholder="First Name">
									</div>
									<div class="col-md-6">
										<label for="input2" class="form-label">Last Name</label>
										<input type="text" class="form-control" id="input2" placeholder="Last Name">
									</div>
									<div class="col-md-12">
										<label for="input3" class="form-label">Phone</label>
										<input type="text" class="form-control" id="input3" placeholder="Phone">
									</div>
									<div class="col-md-12">
										<label for="input4" class="form-label">Email</label>
										<input type="email" class="form-control" id="input4">
									</div>
									<div class="col-md-12">
										<label for="input5" class="form-label">Password</label>
										<input type="password" class="form-control" id="input5">
									</div>
									<div class="col-md-12">
										<label for="input6" class="form-label">DOB</label>
										<input type="date" class="form-control" id="input6">
									</div>
									<div class="col-md-12">
										<label for="input7" class="form-label">Country</label>
										<select id="input7" class="form-select">
											<option selected="">Choose...</option>
											<option>One</option>
											<option>Two</option>
											<option>Three</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="input8" class="form-label">City</label>
										<input type="text" class="form-control" id="input8" placeholder="City">
									</div>
									<div class="col-md-4">
										<label for="input9" class="form-label">State</label>
										<select id="input9" class="form-select">
											<option selected="">Choose...</option>
											<option>One</option>
											<option>Two</option>
											<option>Three</option>
										</select>
									</div>
									<div class="col-md-2">
										<label for="input10" class="form-label">Zip</label>
										<input type="text" class="form-control" id="input10" placeholder="Zip">
									</div>
									<div class="col-md-12">
										<label for="input11" class="form-label">Address</label>
										<textarea class="form-control" id="input11" placeholder="Address ..." rows="4" cols="4"></textarea>
									</div>
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="button" class="btn btn-grd-primary px-4">Update Profile</button>
											<button type="button" class="btn btn-light px-4">Reset</button>
										</div>
									</div>
								</form>
							</div>
            </div>
           </div>

        </div><!--end row-->



    </div>
  </main>
  <!--end m

    @endsection

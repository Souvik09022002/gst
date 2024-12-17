@extends('layout.app')

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

@section('content')
<div class="content-page" style="margin: 50px;">
    <div class="content">

        <!-- Start Content -->
        <div class="container-fluid">

            <!-- Start Page Title -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box d-flex justify-content-between align-items-center">
                        <h4 class="page-title font-weight-bold text-uppercase text-primary">Add Clients</h4>
                        <button class="btn btn-primary btn-lg rounded-pill">+ Add New</button>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->

            <!-- Success and Error Messages -->
            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
          
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- End Success and Error Messages -->

            <!-- Start Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-light rounded-lg">
                        <div class="card-body">
                            <h4 class="header-title text-uppercase text-primary mb-4">Basic Info</h4>
                            <hr class="mb-4">
                            <form class="needs-validation" novalidate="" action="{{ route('postParty') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="partyType" class="font-weight-bold">Type</label>                
                                            <select name="party_type" class="form-control border-0 shadow-sm"
                                                id="partyType" placeholder="Please select Type" required="">
                                                <option value="Client">Client</option>
                                                <option value="Vendor">Vendor</option>
                                                <option value="Employee">Employee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="fullName" class="font-weight-bold">Full Name</label>
                                            <input type="text" name="Full_name" class="form-control border-0 shadow-sm"
                                                id="fullName" placeholder="Enter client's full name" required="">
                                            <div class="invalid-feedback">
                                                Please provide a Full name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="phoneNumber" class="font-weight-bold">Phone/Mobile Number</label>
                                            <input type="text" name="number" class="form-control border-0 shadow-sm"
                                                id="phoneNumber" placeholder="Enter phone/mobile number" required="">
                                            <div class="invalid-feedback">
                                                Please provide a Number.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="address" class="font-weight-bold">Address</label>
                                            <input type="text" name="Address" class="form-control border-0 shadow-sm"
                                                id="address" placeholder="Enter Address" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Address.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="header-title text-uppercase text-primary mt-5 mb-4">Bank Details</h4>
                                <hr class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="accountHolder" class="font-weight-bold">Account Holder Name</label>
                                            <input type="text" name="Account_Holder_Name" class="form-control border-0 shadow-sm"
                                                id="accountHolder" placeholder="Enter Account Holder name" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Account Holder Name.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="accountNumber" class="font-weight-bold">Account Number</label>
                                            <input type="text" name="Account_Number" class="form-control border-0 shadow-sm"
                                                id="accountNumber" placeholder="Enter Account Number" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid Account Number.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="bankName" class="font-weight-bold">Bank Name</label>
                                            <input type="text" name="Bank_Name" class="form-control border-0 shadow-sm"
                                                id="bankName" placeholder="Enter Bank Name" required="">
                                            <div class="invalid-feedback">
                                                Please provide a Bank Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="ifscCode" class="font-weight-bold">IFSC Code</label>
                                            <input type="text" name="IFSC_Code" class="form-control border-0 shadow-sm"
                                                id="ifscCode" placeholder="Enter IFSC Code" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid IFSC Code.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="zipCode" class="font-weight-bold">ZIP Code</label>
                                            <input type="text" name="ZIP_Code" class="form-control border-0 shadow-sm"
                                                id="zipCode" placeholder="Enter ZIP Code" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid ZIP Code.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="state" class="font-weight-bold">State</label>
                                            <input type="text" name="State" class="form-control border-0 shadow-sm"
                                                id="state" placeholder="Enter State" required="">
                                            <div class="invalid-feedback">
                                                Please provide a State.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="branch" class="font-weight-bold">Branch</label>
                                            <input type="text" name="Branch" class="form-control border-0 shadow-sm"
                                                id="branch" placeholder="Enter Branch" required="">
                                            <div class="invalid-feedback">
                                                Please provide a Branch Name.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <button class="btn btn-primary btn-lg rounded-pill" type="submit">Submit</button>
                                <button class="btn btn-secondary btn-lg rounded-pill" type="reset">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form -->

        </div>
    </div>

    <!-- End Page Content -->

    <!-- Footer Start -->
    <footer class="footer bg-light mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    &copy; <script>document.write(new Date().getFullYear());</script> UBold theme by <a href="#">Coderthemes</a>
                </div>
                <div class="col-md-6 text-md-right">
                    <a href="javascript:void(0);" class="text-primary">About Us</a>
                    <a href="javascript:void(0);" class="text-primary">Help</a>
                    <a href="javascript:void(0);" class="text-primary">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</div>

@endsection

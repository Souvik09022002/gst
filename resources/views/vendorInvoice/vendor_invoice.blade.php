@extends('layout.app')
@section('content')
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <!-- start page title -->
        <div class="content-page m-0 p-0">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title font-weight-bold text-uppercase"> Create Invoice </h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="needs-validation pb-2" novalidate="">
                                        <h6 class="text-right"><b>Date : </b><Span>02/09/2023</Span></h6>
                                        <h4 class="page-title "><i data-feather="edit-3"
                                                class="pr-0 mr-1 text-uppercase"></i>Enter Your
                                            Details</h4>
                                        <hr>
                                        <div class="row my-3">
                                            <div class="form-group col-md-4">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Enter Name" required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Phone No.</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Phone/Mobile no." required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Email Address" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="">D.O.B.</label>
                                                <input type="date" class="form-control border-bottom"
                                                    id="validationCustom02" placeholder="" required="">
                                            </div>

                                            <div class="form-group col-md-9">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom02" placeholder="Destination/Address"
                                                    required="">

                                            </div>
                                        </div>
                                        <h4 class="page-title pt-2"><i data-feather="edit-3" class="pr-0 mr-1"></i>ENTER
                                            YOUR BANK
                                            DETAIL</h4>
                                        <hr>
                                        <div class="row my-3">
                                            <div class="form-group col-md-4">
                                                <label for="">Account Holder Name</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Enter Account Holder Name"
                                                    required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Account Number</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Enter Account Number"
                                                    required="">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Bank Name</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom02" placeholder="Enter Bank Name" required="">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="">IFSC Code</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="IFSC Code" required="">

                                            </div>
                                            <div class="form-group col-md-9">
                                                <label for="">Bank Address</label>
                                                <input type="text" class="form-control border-bottom"
                                                    id="validationCustom01" placeholder="Destination/Address"
                                                    required="">
                                            </div>
                                        </div>
                                        <h4 class="page-title "><i data-feather="edit-3" class="pr-0 mr-1"></i>ENTER
                                            PRODUCT/ITEM DETAIL
                                        </h4>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-8 border p-1">
                                                <span>DESCRIPTIONS</span>
                                            </div>
                                            <div class="col-md-4 border p-1">
                                                TOTAL AMOUNT
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-8 border p-2">
                                                <input class="form-control" name="item_description" />
                                            </div>
                                            <div class="col-md-4 border p-2">
                                                <input class="form-control" type="text" id="totalInput"
                                                    oninput="calculateTotalAmount()">
                                            </div>
                                        </div>

                                        <div class="row mt-0">
                                            <div class="col-md-12">
                                                <ul style="list-style: none;float: right;">
                                                    <li>
                                                        <b>Total Amount:</b> ₹ <span type="text"
                                                            id="totalDisplay">0</span>
                                                    </li>
                                                    <li>
                                                        <b>Tax:</b> ₹ <span type="text" id="taxDisplay">0</span>
                                                        <!-- <input type="hidden" value="0" name="text_amount"
                                                            id="taxAmount"> -->
                                                    </li>
                                                    <li>
                                                        <b>Net Amount:</b> ₹ <span type="text"
                                                            id="totalDisplay">0</span>
                                                        <!-- <input type="hidden" value="0" name="net_amount" id="netAmount"> -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                <div class="row mt-3 px-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control border-bottom"
                                                id="validationCustom05" placeholder="Declaration">
                                        </div>

                                        <a href="printGST_bill.html">
                                            <button type="submit" class="btn btn-success float-right mb-2">SUBMIT <i
                                                    data-feather="arrow-right" class="ml-1 fw-bold"></i></button>
                                        </a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    @endsection
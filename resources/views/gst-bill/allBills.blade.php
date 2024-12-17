@extends('layout.app')
@section('content')
<div class="content-page" style="margin: 50px;">
    <div class="row">
        <div class="col">
            <div class="page-title-box">
                <h2 class="page-title font-weight-bold text-uppercase">Manage Clients</h2>
            </div>
        </div>

    </div>
    <!-- end page title -->
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
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <a href="{{route('addBill')}}" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Add Bills
                </a>
                <h4 class="header-title mb-4 text-uppercase">Manage Bills</h4>
                <div class="row align-items-center mb-3">
                    <div class="col-md-8">
                    <div class="form-group d-flex align-items-center">
    <label for="entries" class="mr-2 mb-0">Show</label>
    <form action="{{ route('select_Bills_row') }}" method="get">
        <select name="select_Bills_row" id="entries"
            aria-controls="alternative-page-datatable"
            class="custom-select custom-select-sm form-control form-control-sm w-auto">
            <option value="10">5</option>
            <option value="25">10</option>
            <option value="50">25</option>
            <option value="100">50</option>
            <option value="100">100</option>
        </select>
        <span class="ml-2">entries</span>
    </form>
</div>

                    </div>
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('search_Bills') }}" class="d-flex">
                            <label class="sr-only" for="search_Bills">Search:</label>
                            <input name="search_Bills" id="search_Bills" type="search" class="form-control form-control-sm mr-2"
                                placeholder="Search..." aria-controls="alternative-page-datatable">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <table class="table table-hover table-bordered table-striped m-0 dt-responsive nowrap w-100" id="tickets-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th>invoice No.</th>
                            <th>Bills Name</th>
                            <th>Invoice Dates</th>
                            <th>Order Dates</th>
                            <th>description</th>
                            <th>Rate & Quentity</th>
                            <th>Base Amount</th>
                            <th>GST</th>
                            <th>Net amount</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @if($Bills)
                    <tbody>
                        <!-- Updated Table Rows -->
                        @foreach($Bills as $Bills)
                        <tr>
                            <!-- 8 -->
                            <td class="text-center align-middle"><strong>{{$Bills->id}}</strong></td>
                            <!-- 7 -->
                            <td class="align-middle">
                                <span class="badge badge-warning">{{$Bills->invoice_number}}</span>
                            </td>
                            <!-- 6 -->
                            <td class="align-middle">
                                <span class="badge badge-primary">{{$Bills->party_name}}</span><hr>
                                <span class="badge badge-light">{{$Bills->Address}}</span>
                            </td>
                            <!-- 5 -->
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <strong>Invoice Date:</strong>
                                        <span class="badge badge-info">{{$Bills->invoice_date}}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                  
                                    <li>
                                        <strong>Order Date:</strong>
                                        <span class="badge badge-success">{{$Bills->order_date}}</span>
                                    </li>
                                </ul>
                            </td>
                            <!-- 4 -->
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <i class="mdi mdi-file-document-box-outline text-primary"></i>
                                        <strong>Description:</strong> {{$Bills->item_description}}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-barcode-scan text-primary"></i>
                                        <strong>HSN Code:</strong> {{$Bills->hsn_code}}
                                    </li>
                                </ul>
                            </td>
                            <!-- 3 -->
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <i class="mdi mdi-package-variant-closed text-info"></i>
                                        <strong>Quantity:</strong> {{$Bills->quantity}}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-currency-inr text-success"></i>
                                        <strong>Rate:</strong> {{$Bills->rate}}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-calculator text-danger"></i>
                                        <strong>Amount:</strong> {{$Bills->amount}}
                                    </li>
                                </ul>
                            </td>
                            <!-- 2 -->
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <i class="mdi mdi-currency-inr text-success"></i>
                                        <strong>Total Amount:</strong> {{$Bills->total_amount}}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-percent text-warning"></i>
                                        <strong>Total Tax:</strong> {{$Bills->tax_amount}}
                                    </li>
                                    
                                    
                                </ul>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                <li>
                                        <strong>GST Details:</strong>
                                        <ul class="pl-3">
                                            <li>
                                                <i class="mdi mdi-percent-outline text-danger"></i>
                                                CGST: {{$Bills->cgst_rate}}% -> {{$Bills->cgst_amount}}
                                            </li>
                                            <li>
                                                <i class="mdi mdi-percent-outline text-warning"></i>
                                                SGST: {{$Bills->sgst_rate}}% -> {{$Bills->sgst_amount}}
                                            </li>
                                            <li>
                                                <i class="mdi mdi-percent-outline text-info"></i>
                                                IGST: {{$Bills->igst_rate}}% -> {{$Bills->igst_amount}}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                            <!-- 1 -->
                            <td class="align-middle">
                                <strong>Net Amount:</strong>
                                <span class="badge badge-success">{{$Bills->net_amount}}</span>
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript:void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                     
                                           <form action="{{route('Edit_Bill',$Bills->id)}}" method="get">
                                           <button class="dropdown-item">
                                                Edit
                                           </button>
                                           </form>
                                      
                                           <form action="{{route('Delete_Bill',$Bills->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                           <button class="dropdown-item">
                                                Delete
                                           </button>
                                           </form>
                                           <form action="{{route('print_page',$Bills->id)}}" method="get">
                                           <button class="dropdown-item">
                                                print this page
                                           </button>
                                           </form>
                                    </div>
                                </div>
                                       
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    @endif
                </table>

            </div><!-- end col -->
        </div>

    </div>
    <!-- end row -->

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2015 -
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    &copy; UBold theme by <a href="">Coderthemes</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<div id="pagination-container" class="mt-3"></div>
<script src="{{asset('assets/pagination.js')}}"></script>

<script>
    function fillEditModal(id, Bills_type, full_name, number, address, account_holder_name, bank_details, account_number, bank_name, ifsc_code, zip_code, state, branch) {
        $('#Bills_id').val(id);
        $('#Bills_type').val(Bills_type);
        $('#full_name').val(full_name);
        $('#number').val(number);
        $('#address').val(address);
        $('#account_holder_name').val(account_holder_name);
        $('#bank_details').val(bank_details);
        $('#account_number').val(account_number);
        $('#bank_name').val(bank_name);
        $('#ifsc_code').val(ifsc_code);
        $('#zip_code').val(zip_code);
        $('#state').val(state);
        $('#branch').val(branch);
    }
</script>
@endsection
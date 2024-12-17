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
                <a href="{{route('addParty')}}" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                    <i class="mdi mdi-plus-circle"></i> Add Client
                </a>
                <h4 class="header-title mb-4 text-uppercase">Manage Clients</h4>
                <div class="row align-items-center mb-3">
                    <div class="col-md-8">
                        <div class="form-group d-flex align-items-center">
                            <label for="entries" class="mr-2 mb-0">Show</label>
                            <select name="alternative-page-datatable_length" id="entries"
                                aria-controls="alternative-page-datatable"
                                class="custom-select custom-select-sm form-control form-control-sm w-auto">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ml-2">entries</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('search') }}" class="d-flex">
                            <label class="sr-only" for="search">Search:</label>
                            <input name="search" id="search" type="search" class="form-control form-control-sm mr-2"
                                placeholder="Search..." aria-controls="alternative-page-datatable">
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <table class="table table-hover table-bordered table-striped m-0 dt-responsive nowrap w-100" id="tickets-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th>Party Type</th>
                            <th>Client Details</th>
                            <th>Client A/c Details</th>
                            <th>IFSC No./Zip Code</th>
                            <th>State & Branch</th>
                            <th>Created On</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    @if($parties)
                    <tbody>
                        @foreach($parties as $party)
                        <tr>
                            <td class="text-center align-middle"><strong>{{$party->id}}</strong></td>
                            <td class="align-middle">
                                <span class="badge badge-warning">{{$party->party_type}}</span>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Name:</strong> {{$party->Full_name}}</li>
                                    <li><strong>Phone:</strong> {{$party->number}}</li>
                                    <li><strong>Address:</strong> {{$party->Address}}</li>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Account Holder:</strong> {{$party->Account_Holder_Name}}</li>
                                    <li><strong>Bank Details:</strong> {{$party->Bank_Details}}</li>
                                    <li><strong>Account Number:</strong> {{$party->Account_Number}}</li>
                                    <li><strong>Bank Name:</strong> {{$party->Bank_Name}}</li>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li><strong>IFSC Code:</strong> {{$party->IFSC_Code}}</li>
                                    <li><strong>ZIP Code:</strong> {{$party->ZIP_Code}}</li>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <ul class="list-unstyled mb-0">
                                    <li><strong>State:</strong> {{$party->State}}</li>
                                    <li><strong>Branch:</strong> {{$party->Branch}}</li>
                                </ul>
                            </td>
                            <td class="align-middle">
                                <span>{{date("d-m-Y", strtotime($party->created_at))}}</span>
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript:void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#editPartyModal" onclick="fillEditModal('{{ $party->id }}', '{{ $party->party_type }}', '{{ $party->Full_name }}', '{{ $party->number }}', '{{ $party->Address }}', '{{ $party->Account_Holder_Name }}', '{{ $party->Bank_Details }}', '{{ $party->Account_Number }}', '{{ $party->Bank_Name }}', '{{ $party->IFSC_Code }}', '{{ $party->ZIP_Code }}', '{{ $party->State }}', '{{ $party->Branch }}')">
                                            <i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit
                                        </a>
                                        <form action="{{route('party_delete',$party->id)}}" method="post" onsubmit="return confirm(`Are you want to delete the {{$party->Full_name}} ??`)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="editPartyModal" tabindex="-1" role="dialog" aria-labelledby="editPartyModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPartyModalLabel">Edit Party</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('party_update') }}">
                                                @csrf
                                                <input type="hidden" name="party_id" id="party_id">

                                                <!-- Party Type -->
                                                <div class="form-group">
                                                    <label for="party_type">Party Type</label>
                                                    <select name="party_type" id="party_type" class="form-control" value="{{$party->party_type}}">
                                                        <option value="Client">Client</option>
                                                        <option value="vendor">Vendor</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>

                                                <!-- Other Input Fields -->
                                                <div class="form-group">
                                                    <label for="full_name">Full Name</label>
                                                    <input type="text" name="Full_name" id="full_name" value="{{$party->Full_name}}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Number</label>
                                                    <input type="text" name="number" id="number" value="number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" name="Address" id="address" class="form-control" value="{{$party->Address}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="account_holder_name">Account Holder Name</label>
                                                    <input type="text" name="Account_Holder_Name" id="account_holder_name" class="form-control" value="{{$party->Account_Holder_Name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_details">Bank Details</label>
                                                    <input type="text" name="Bank_Details" id="bank_details" class="form-control" value="{{$party->Bank_Details}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="account_number">Account Number</label>
                                                    <input type="text" name="Account_Number" id="account_number" class="form-control" value="{{$party->Account_Number}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bank_name">Bank Name</label>
                                                    <input type="text" name="Bank_Name" id="bank_name" class="form-control" value="{{$party->Bank_Name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ifsc_code">IFSC Code</label>
                                                    <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control" value="{{$party->IFSC_Code}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="zip_code">ZIP Code</label>
                                                    <input type="text" name="ZIP_Code" id="zip_code" class="form-control" value="{{$party->ZIP_Code}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" name="State" id="state" class="form-control" value="{{$party->State}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="branch">Branch</label>
                                                    <input type="text" name="Branch" id="branch" class="form-control" value="{{$party->Branch}}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Party</button>
                                            </form>
                                        </div>
                                    </div>
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
    function fillEditModal(id, party_type, full_name, number, address, account_holder_name, bank_details, account_number, bank_name, ifsc_code, zip_code, state, branch) {
        $('#party_id').val(id);
        $('#party_type').val(party_type);
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
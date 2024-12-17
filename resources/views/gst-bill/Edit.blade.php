@extends('layout.app')
@section('content')

<!-- Begin page -->
<div class="content-page" style="margin: 50px;">
    <div class="content">
        <!-- Start Content -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title font-weight-bold">CREATE GST BILL</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Success and Error Messages -->
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- End Success and Error Messages -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title text-uppercase mb-4">Invoice Basic Info</h4>
                            <hr>
                            <form action="{{ route('update_Bill',$Bill->id) }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                   
                                    <div class=" col-md-12">
                                        <label for="party_name" class="col-sm-2 col-form-label">party_name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="party_name" placeholder="party_name" name="party_name" value="{{ $Bill->party_name }}" >
                                        </div>
                                    </div>
                                    <div class=" col-md-12">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="Address" placeholder="Address" name="Address" value="{{ $Bill->Address }}" >
                                        </div>
                                    </div>
                                    <div class=" col-md-12">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Order_no</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="Order_no" placeholder="Order_no" name="Order_no" value="{{$Bill->Order_no}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="invoice_date">Invoice Date</label>
                                            <input name="invoice_date" type="date" class="form-control" id="invoice_date" value="{{$Bill->invoice_date}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="order_date">Order Date</label>
                                            <input name="order_date" type="date" class="form-control" id="order_date" value="{{$Bill->order_date}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="invoice_number">Invoice Number</label>
                                            <input name="invoice_number" type="text" class="form-control" id="invoice_number" value="{{$Bill->invoice_number}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h4 class="header-title text-uppercase mb-3">Item Details</h4>
                                        <hr>
                                    </div>
                                </div>

                                <div class="row mb-2 bg-primary text-white text-center border rounded">
                                    <div class="col-md-1 border p-2"><b>SL.no</b></div>
                                    <div class="col-md-5 border p-2"><b>Item Description</b></div>
                                    <div class="col-md-2 border p-2" style="flex-basis: 100px;"><b>HSN Code</b></div>
                                    <div class="col-md-2 border p-2" style="flex-basis: 120px;"><b>Quantity</b></div>
                                    <div class="col-md-2 border p-2"><b>Rate</b></div>
                                    <div class="col-md-2 border p-2"><b>Amount</b></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-1 border p-2">
                                        <textarea class="form-control text-center" rows="10" name="sl_no[]" id="slNoTextarea" required>{{ $Bill->sl_no }}</textarea>
                                    </div>

                                    <div class="col-md-5 border p-2">
                                        <textarea class="form-control text-center" rows="10" name="item_description[]" id="itemDescriptionTextarea">{{ $Bill->item_description }}</textarea>
                                    </div>

                                    <div class="col-md-2 border p-2" style="flex-basis: 100px;">
                                        <textarea class="form-control text-center" rows="10" name="hsn_code[]" id="hsnCodeTextarea">{{ $Bill->hsn_code }}</textarea>
                                    </div>

                                    <div class="col-md-2 border p-2" style="flex-basis: 120px;">
                                        <textarea class="form-control text-center" rows="10" name="quantity[]" id="quantityTextarea">{{ $Bill->quantity }}</textarea>
                                    </div>

                                    <div class="col-md-2 border p-2">
                                        <textarea class="form-control text-center" rows="10" name="rate[]" id="rateTextarea">{{ $Bill->rate }}</textarea>
                                    </div>

                                    <div class="col-md-2 border p-2">
                                        <textarea class="form-control text-center" rows="10" name="amount[]" id="amountTextarea" readonly>{{ $Bill->amount }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="total_box p-3 border rounded bg-success text-white" style="width: 300px;">
                                            <div class="text-center mb-2">
                                                <b>TOTAL AMOUNT</b>
                                            </div>
                                            <div>
                                                <input name="total_amount" class="form-control bg-white text-dark" type="text" id="totalAmountInput" value="{{$Bill->total_amount}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex justify-content-between">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cgst">CGST (%)</label>
                                                <input name="cgst_rate" type="number" step="0.01" class="form-control" placeholder="CGST Rate" id="cgst" value="{{ $Bill->cgst_rate }}">

                                                <span class="float-end gststyle" id="cgstDisplay">0</span>
                                                <input type="hidden" id="cgstAmount" name="cgst_amount" value="{{$Bill->cgst_amount}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sgst">SGST (%)</label>
                                                <input name="sgst_rate" type="number" step="0.01" class="form-control" placeholder="SGST Rate" id="sgst" value="{{$Bill->sgst_rate}}">
                                                <span class="float-end gststyle" id="sgstDisplay">0</span>
                                                <input type="hidden" id="sgstAmount" name="sgst_amount" value="{{$Bill->sgst_amount}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="igst">IGST (%)</label>
                                                <input name="igst_rate" type="number" step="0.01" class="form-control" placeholder="IGST Rate" id="igst" value="{{$Bill->igst_rate}}">
                                                <span class="float-end gststyle" id="igstDisplay">0</span>
                                                <input type="hidden" id="igstAmount" name="igst_amount" value="{{$Bill->igst_amount}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    <li><b style="font-size: larger;">Total Amount:</b> ₹ <span id="totalAmountDisplay">0</span></li>
                                                    <li><b style="font-size: larger;">Tax:</b> ₹ <span id="taxDisplay">0</span>
                                                        <input type="hidden" name="tax_amount" id="taxAmount" value="{{ $Bill->tax_amount }}">

                                                    </li>
                                                    <li style="font-size: larger;"><b>Net Amount:</b> ₹ <span id="netAmountDisplay">0</span>
                                                        <input type="hidden" name="net_amount" id="netAmount" value="{{$Bill->net_amount}}">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="declaration">Declaration</label>
                                            <input name="declaration" type="text" class="form-control" id="declaration" placeholder="Declaration" value="{{$Bill->declaration}}">
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">SUBMIT</button>
                                            <button type="reset" class="btn btn-secondary">RESET</button>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalAmountInput = document.getElementById('totalAmountInput');
        const cgstRateInput = document.getElementById('cgst');
        const sgstRateInput = document.getElementById('sgst');
        const igstRateInput = document.getElementById('igst');
        const quantityTextarea = document.getElementById('quantityTextarea');
        const rateTextarea = document.getElementById('rateTextarea');
        const amountTextarea = document.getElementById('amountTextarea');

        const calculateAmounts = () => {
            const quantities = quantityTextarea.value.split('\n').map(q => parseFloat(q) || 0);
            const rates = rateTextarea.value.split('\n').map(r => parseFloat(r) || 0);
            const amounts = quantities.map((quantity, i) => quantity * (rates[i] || 0));
            amountTextarea.value = amounts.join('\n');

            const totalAmount = amounts.reduce((total, amount) => total + amount, 0);
            totalAmountInput.value = totalAmount.toFixed(2);

            const cgstRate = parseFloat(cgstRateInput.value) || 0;
            const sgstRate = parseFloat(sgstRateInput.value) || 0;
            const igstRate = parseFloat(igstRateInput.value) || 0;

            const cgstAmount = (totalAmount * cgstRate / 100).toFixed(2);
            const sgstAmount = (totalAmount * sgstRate / 100).toFixed(2);
            const igstAmount = (totalAmount * igstRate / 100).toFixed(2);

            document.getElementById('cgstDisplay').textContent = cgstAmount;
            document.getElementById('sgstDisplay').textContent = sgstAmount;
            document.getElementById('igstDisplay').textContent = igstAmount;

            document.getElementById('cgstAmount').value = cgstAmount;
            document.getElementById('sgstAmount').value = sgstAmount;
            document.getElementById('igstAmount').value = igstAmount;

            const taxAmount = parseFloat(cgstAmount) + parseFloat(sgstAmount) + parseFloat(igstAmount);
            const netAmount = totalAmount + taxAmount;
            const roundOffAmount = Math.round(netAmount);

            document.getElementById('totalAmountDisplay').textContent = totalAmount.toFixed(2);
            document.getElementById('taxDisplay').textContent = taxAmount.toFixed(2);
            document.getElementById('netAmountDisplay').textContent = netAmount.toFixed(2);

            document.getElementById('taxAmount').value = taxAmount.toFixed(2);
            document.getElementById('netAmount').value = roundOffAmount.toFixed(2);
        };

        quantityTextarea.addEventListener('input', calculateAmounts);
        rateTextarea.addEventListener('input', calculateAmounts);
        cgstRateInput.addEventListener('input', calculateAmounts);
        sgstRateInput.addEventListener('input', calculateAmounts);
        igstRateInput.addEventListener('input', calculateAmounts);

        calculateAmounts(); // Initial calculation

        const clientSelect = document.getElementById('clientSelect');

        // Fetch client address via AJAX
        clientSelect.addEventListener('change', function() {
            const selectedClient = clientSelect.value; // Get selected client's name

            $.ajax({
                url: '{{ route("get_client_address") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Add CSRF token
                    party_name: selectedClient
                },
                success: function(response) {
                    if (response.address) {
                        $('#Address').val(response.address); // Set address in input field
                    } else {
                        $('#Address').val('Address not found');
                    }
                },
                error: function() {
                    alert('Error retrieving address');
                }
            });
        });
    });
</script>
<style>
    .content-page {
        background-color: #f9f9f9;
        padding: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .card-body {
        background-color: #ffffff;
        border-radius: 10px;
    }

    .header-title {
        color: #007bff;
    }

    .total_box {
        background-color: #28a745;
        color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 0.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
    }

    .form-select {
        border-radius: 0.25rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .gststyle {
        color: #dc3545;
    }

    .bg-primary {
        background-color: #007bff;
        color: #ffffff;
    }

    .text-white {
        color: #ffffff;
    }
</style>

@endsection
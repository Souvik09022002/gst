@extends('layout.app')
@section('content')

<div class="content-page" style="margin: 0px;">
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="page-title">Create GST Bill</h1>
                </div>
            </div>

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

            <div class="card main-card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Invoice Information</h2>
                    <form action="{{ route('createGstBill') }}" method="post">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="clientSelect">Select Party Name</label>
                                <select name="party_name" class="form-select custom-select" id="clientSelect" required>
                                    <option value="" disabled selected>Select a party</option>
                                    @foreach($existingClients as $client)
                                    <option value="{{ $client->Full_name }}">{{ $client->Full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="Address">Address</label>
                                <input type="text" class="form-control custom-input" id="Address" name="Address" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="Order_no">Order No</label>
                                <input type="text" class="form-control custom-input" id="Order_no" name="Order_no">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="invoice_date">Invoice Date</label>
                                <input name="invoice_date" type="date" class="form-control custom-input" id="invoice_date" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="order_date">Order Date</label>
                                <input name="order_date" type="date" class="form-control custom-input" id="order_date" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="invoice_number">Invoice Number</label>
                                <input name="invoice_number" type="text" class="form-control custom-input" id="invoice_number" required>
                            </div>
                        </div>

                        <h2 class="card-title mb-4">Item Details</h2>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th class="sl_no">SL.no</th>
                                        <th class="Item_Description">Item Description</th>
                                        <th style="width: 100px;">HSN Code</th>
                                        <th style="width:120px" >Quantity</th>
                                        <th style="width:150px;">Rate</th>
                                        <th style="width:150px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="sl_no[]" id="slNoTextarea" required></textarea></td>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="item_description[]" id="itemDescriptionTextarea"></textarea></td>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="hsn_code[]" id="hsnCodeTextarea"></textarea></td>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="quantity[]" id="quantityTextarea"></textarea></td>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="rate[]" id="rateTextarea"></textarea></td>
                                        <td><textarea class="form-control custom-textarea" rows="15" name="amount[]" id="amountTextarea" readonly></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card gst-card">
                                    <div class="card-body">
                                        <h3 class="card-title">GST Details</h3>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="cgst">CGST (%)</label>
                                                <input name="cgst_rate" type="number" step="0.01" class="form-control custom-input" id="cgst">
                                                <span class="float-end text-danger" id="cgstDisplay">0</span>
                                                <input type="hidden" id="cgstAmount" name="cgst_amount" value="0">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="sgst">SGST (%)</label>
                                                <input name="sgst_rate" type="number" step="0.01" class="form-control custom-input" id="sgst">
                                                <span class="float-end text-danger" id="sgstDisplay">0</span>
                                                <input type="hidden" id="sgstAmount" name="sgst_amount" value="0">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="igst">IGST (%)</label>
                                                <input name="igst_rate" type="number" step="0.01" class="form-control custom-input" id="igst" value="0">
                                                <span class="float-end text-danger" id="igstDisplay">0</span>
                                                <input type="hidden" id="igstAmount" name="igst_amount" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card total-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Total Amount</h3>
                                        <input name="total_amount" class="form-control form-control-lg mb-2 custom-input" type="text" id="totalAmountInput" readonly>
                                        <ul class="list-unstyled total-list">
                                            <li><strong>Total Amount:</strong> ₹ <span id="totalAmountDisplay">0</span></li>
                                            <li><strong>Tax:</strong> ₹ <span id="taxDisplay">0</span></li>
                                            <li><strong>Net Amount:</strong> ₹ <span id="netAmountDisplay">0</span></li>
                                        </ul>
                                        <input type="hidden" name="tax_amount" id="taxAmount" value="0">
                                        <input type="hidden" name="net_amount" id="netAmount" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="declaration">Declaration</label>
                            <input name="declaration" type="text" class="form-control custom-input" id="declaration" placeholder="Declaration">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary custom-btn">Submit</button>
                            <button type="reset" class="btn btn-secondary custom-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    textarea.form-control{
        padding: 5px;
        text-align: center;
    }
    th{
        padding: 0;
        margin: 5px;
    }
    .sl_no{
        width: 90px
    }
    .Item_Description{
        width: 600px;
    }
    .content-page {
        background-color: #f0f8ff;
        padding: 2rem;
        font-family: 'Arial', sans-serif;
    }
    .page-title {
        color: #4a90e2;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .main-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background: linear-gradient(145deg, #ffffff, #f0f0f0);
    }
    .card-title {
        color: #4a90e2;
        font-weight: bold;
        border-bottom: 2px solid #4a90e2;
        padding-bottom: 10px;
    }
    .form-label {
        font-weight: 600;
        color: #333;
    }
    .custom-input, .custom-select, .custom-textarea {
        border-radius: 10px;
        border: 2px solid #4a90e2;
        transition: all 0.3s ease;
    }
    .custom-input:focus, .custom-select:focus, .custom-textarea:focus {
        box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
    }
    .custom-table {
        border-radius: 10px;
        overflow: hidden;
    }
    .custom-table thead {
        background-color: #4a90e2;
        color: white;
    }
    .custom-table th, .custom-table td {
        border: 1px solid #4a90e2;
    }
    .gst-card, .total-card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .gst-card {
        background: linear-gradient(145deg, #e6f3ff, #ffffff);
    }
    .total-card {
        background: linear-gradient(145deg, #4a90e2, #3498db);
        color: white;
    }
    .total-list li {
        margin-bottom: 10px;
        font-size: 1.1em;
    }
    .custom-btn {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .btn-primary {
        background-color: #4a90e2;
        border-color: #4a90e2;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    .btn-primary:hover, .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .alert {
        border-radius: 10px;
    }
</style>

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
            Full_name: selectedClient
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

@endsection
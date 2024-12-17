@extends('layout.app')
@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Times New Roman", serif;
        /* Classic serif font */
        font-size: 16px;
        line-height: 1.6;
        color: #333;
    }

    .invoice-container {
        max-width: 1250px;
        margin: 0 auto;
        padding: 20px;
        border: 3px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        background-color: #f9f9f9;
    }

    .invoice-title {
        font-size: 30px;
        font-weight: bold;
        color: #000080;
        /* Classic dark blue */
    }

    .table-bordered {
        border: 2px solid #000;
        font-weight: bold;
    }

    .table-bordered th,
    .table-bordered td {
        border: 2px solid #000;
        padding: 10px;
    }

    thead.thead-light {
        background-color: #000080;
        color: #fff;
        font-weight: bold;
    }

    tbody tr {
        font-size: 16px;
    }

    tfoot tr {
        background-color: #e8e8e8;
        font-weight: bold;
    }

    .signature-box {
        margin-top: 50px;
        text-align: right;
        font-size: 18px;
    }

    .terms-conditions {
        font-size: 14px;
        color: #333;

        padding: 15px;
        border-radius: 5px;
    }

    .total-in-words {
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }
    body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 72px;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.1); /* Adjust the opacity for better visibility */
            white-space: nowrap;
            z-index: -2;
        }
        .a{
            padding-left: 12px;
        }
</style>
<div class="container mt-5 ">
    <button id="printButton" class="btn btn-primary mb-3 no-print" onclick="printDiv('Invoice')">Print Invoice</button>
    <button id="generate-pdf" class="btn btn-danger mb-3 no-print">PDF Invoice</button>
    <hr class="m-0 p-0 border border-primary"> 
    <div class="invoice-container border-dark p-3" id='Invoice'>
        <!-- Header Section -->
        <div class="row p-1 align-items-center p-0 m-0">
            <div class="col-1 text-righ p-0 m-0">
                <img src="{{asset('assets/images/Untitled.png')}}" alt="Logo" class="logo" style="width: 70px; height:100px">
            </div>
            <div class="col-6 pr-2">
                <div class="side_bar_1">
                    <h1 class="invoice-title font-weight-bold">SOUVIK ENTERPRISE</h1>
                    <p class="text-muted">General Order Suppliers(Specialist on Electrical Goods)</p>
                </div>
            </div>
            <div class="col-5 border border-dark rounded  p-2" style="font-size: larger;">
                <div class="d-flex justify-content-end mb-1">
                    <label class="form-check-label mr-3 " for="exampleCheck1">Original for Receipient</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <label class="form-check-label mr-3" for="exampleCheck2">Duplicate for Transpoter</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                </div>
                <div class="d-flex justify-content-end">
                    <label class="form-check-label mr-3" for="exampleCheck3">Triplicate for Supplier</label>
                    <input type="checkbox" class="form-check-input" id="exampleCheck3">
                </div>
            </div>
        </div>

      
        <div class="row p-0 m-0 border border-dark d-flex">
            <!-- 1st comperment -->
            <div class="col-5 pr-2 m-0">
                <div class="header_foot  pr-2 m-0">
                    <p class="p-0 m-0 font-weight-bold">97/2 I.R BELILIOUS LANE,<br>
                        Howrah - 711101<br>
                        Tel: 9831399851<br>
                        Email: souvikenterprise2014@gmail.com</p>
                </div>
            </div>
            <!-- 2nd comperment -->
            <div class="col-1 d-flex align-items-center justify-content-center p-2 mr-3">
                <div class="v_line border border-dark"></div>
            </div>
            <!-- 3rd comperment -->
            <div class="col-5 m-0 p-2">
                <strong>PAN No     .: AKVPB4911A</strong><br>
                <strong>GSTIN      .: 19AKVPB4911A1ZD </strong><br>
                <strong>State Code .: 19 </strong>
            </div>
        </div>


       
        <div class="row">
            <div class="col-12">
                <h2 class="text-center m-0 p-0">TAX INVOICE</h2>

            </div>
        </div>

        <!-- Customer and Invoice Details -->
        <div class="row border border-dark rounded m-0 p-0">
            <div class="col-5">
                <h5 class="text-primary">Customer Details</h5>
                <p><strong>Name: {{$allDetailsById->party_name}}</strong></p>
                <p><strong>Address:</strong> {{$allDetailsById->Address}}<br>
                    <strong>Place of Supply:</strong> KOLKATA (07)
                </p>
            </div>
            <div class="col-1 d-flex align-items-center justify-content-center p-2">
                <div class="v_line border border-dark"></div>
            </div>
            <div class="col-6">
                <h5 class="text-primary">Invoice Details</h5>
                <p><strong>Invoice No.:</strong> {{$allDetailsById->invoice_number}}<br>
                    <strong>Invoice Date:</strong> {{$allDetailsById->invoice_date}}<br>
                    <strong>Order Date :</strong> {{$allDetailsById->order_date}}<br>
                    <strong>P.O. No.:</strong> {{$allDetailsById->Order_no}}<br>
                    <strong>DELIVERY DATE:</strong> {{$allDetailsById->order_date}}
                </p>
            </div>
        </div>

        <!-- Products/Services Table -->
        <div class="row">
            <div class="col-12">
                <table class="table mt-2" style="border: 2px solid;">
                    <thead class="border  border-dark rounded ">
                        <tr class="border  border-dark rounded ">
                            <th class="border  border-dark rounded " style="width: 70px;">Sr. No.</th>
                            <th class="border  border-dark rounded " style="width: 600px;">Name of Product / Service</th>
                            <th class="border  border-dark rounded " style="width: 100px;">HSN / SAC</th>
                            <th class="border  border-dark rounded " style="width: 100px;">Qty</th>
                            <th class="border  border-dark rounded " style="width: 100px;">Rate</th>
                            <th class="border  border-dark rounded " style="width: 100px;">Taxable Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border  border-dark rounded "><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->sl_no}}</textarea></td>
                            <td class="border  border-dark rounded " style="flex-basis: 250px;"><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->item_description}}</textarea></td>
                            <td class="border  border-dark rounded "><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->hsn_code}}</textarea></td>
                            <td class="border  border-dark rounded "><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->quantity}}</textarea></td>
                            <td class="border  border-dark rounded "><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->rate}}</textarea></td>
                            <td class="border  border-dark rounded "><textarea class="form-control custom-textarea" rows="10" readonly>{{$allDetailsById->amount}}</textarea></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary">
                            <th colspan="3">Total</th>
                            <td>{{$allDetailsById->total_quantity}}</td>
                            <td>{{$allDetailsById->total_rate}}</td>
                            <td>{{$allDetailsById->total_amount}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Total in Words and Tax Details -->
        <div class="row p-0 m-0">
            <div class="col-6 p-0 m-0">
                <div class="total-in-words">
                    <strong>Total in words:</strong>
                    <hr class="m-0 p-0 border border-dark">
                    <span id="totalInWords">Loading...</span>
                    <hr class="m-0 p-0 border border-dark">
                </div>

            </div>
            <div class="col-6 p-0 m-0">
                <table class="table table-bordered table-sm p-0 m-0">
                    <tr>
                        <th>CGST</th>
                        <td>{{$allDetailsById->cgst_rate}}%</td>
                        <td>{{$allDetailsById->cgst_amount}}</td>
                    </tr>
                    <tr>
                        <th>SGST</th>
                        <td>{{$allDetailsById->sgst_rate}}%</td>
                        <td>{{$allDetailsById->sgst_amount}}</td>
                    </tr>
                    <tr>
                        <th>IGST</th>
                        <td>{{$allDetailsById->igst_rate}}%</td>
                        <td>{{$allDetailsById->igst_amount}}</td>
                    </tr>
                    <tr class="table-secondary">
                        <th>Total TAX</th>
                        <td colspan="2">{{$allDetailsById->tax_amount}}</td>
                    </tr>
                    <tr class="table-primary">
                        <th>Grand Total</th>
                        <td colspan="2"><strong id="net_amount">{{$allDetailsById->net_amount}}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr class="p-0 m-0 border border-dark w-50">
        <!-- Bank and Signature Details -->
        <div class="row">
            <div class="col-6">
                <h5 class="text-primary">Bank Details</h5>
                <p><strong>Bank Name:</strong>Punjab National Bank<br>
                    <strong>Branch Name:</strong> Brabourbon Road<br>
                    <strong>Bank Account Number:</strong>3186002100037432<br>
                    <strong>Bank Branch IFSC:</strong> PUNB0010000
                </p>
            </div>
            <div class="col-6 text-right">
                <div class="signature-box d-flex  p-0 m-0 justify-content-end">
                    <!-- <img src="https://www.onlygfx.com/wp-content/uploads/2017/12/ok-stamp-4.png" alt="Signature" style="max-width: 150px;"> -->
                    <p class="mt-2 text-center"> E & O.E <br>Souvik Enterprise<br> <br>  <br>Authorised Signatory</p>
                </div>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms-conditions m-0 p-0">
            <h5 class="text-primary">Terms and Conditions</h5>
            <ol>
                <li>Goods once sold will not br taken back or exchanged</li>
                <li>Our Responsibility ceases after delivery of goods.</li>
                <li>Subject to Howrah Jurisdiction only.</li>
            </ol>
        </div>

        <!-- Footer Note -->
        <div class="footer-note m-0 p-0">
            <p>This is a computer-generated invoice. No signature required.</p>
        </div>
    </div>
</div>

<!-- External Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<!-- Include html2canvas library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- Optionally include jsPDF plugin for HTML rendering -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/html2pdf.bundle.min.js"></script>


<script>
    function numberToWords(num) {
        const ones = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        const teens = ['Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
        const thousands = ['', 'Thousand', 'Million', 'Billion', 'Trillion'];

        if (num === 0) return 'Zero';

        let words = '';

        function convertChunk(chunk) {
            let str = '';
            if (chunk > 99) {
                str += ones[Math.floor(chunk / 100)] + ' Hundred ';
                chunk %= 100;
            }
            if (chunk > 10 && chunk < 20) {
                str += teens[chunk - 11] + ' ';
            } else {
                str += tens[Math.floor(chunk / 10)] + ' ';
                if (chunk % 10 > 0) {
                    str += ones[chunk % 10] + ' ';
                }
            }
            return str.trim();
        }

        let chunkCount = 0;
        while (num > 0) {
            let chunk = num % 1000;
            if (chunk > 0) {
                words = convertChunk(chunk) + ' ' + thousands[chunkCount] + ' ' + words;
            }
            num = Math.floor(num / 1000);
            chunkCount++;
        }

        return words.trim();
    }

    function updateTotalInWords() {
        const netAmount = parseFloat(document.getElementById('net_amount').innerText.replace(/,/g, ''));
        const words = numberToWords(Math.round(netAmount));
        document.getElementById('totalInWords').innerText = words + ' Only';
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        updateTotalInWords();
    });

    function printDiv(divId) {
        let head = '<html><head><title>' + document.title + '</title></head>';
        let footer = '</body></html>';
        let new_str = document.getElementById(divId).innerHTML;
        let old_str = document.body.innerHTML;
        document.body.innerHTML = head + new_str + footer;
        window.print();
        document.body.innerHTML = old_str;
        return false;
    }
    // function pdftDiv(e){
    //     var convertToPdf = document.getElementById('Invoice');
    //     var doc = new jsPDF();
    //     doc.forHTML(convertToPdf,15,15);
    //     doc.save()

    // }
    $(document).ready(function() {
        $('#generate-pdf').on('click', function() {
            var element = document.getElementById('Invoice'); // Target your section

            // Custom jsPDF settings for a single-page layout
            var opt = {
                margin: 0,
                filename: 'Invoice.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 0.75
                }, // Increase scale for better quality and fit
                jsPDF: {
                    unit: 'in',
                    format: 'legal',
                    orientation: 'portrait'
                },
                pagebreak: {
                    avoid: 'body'
                }
            };

            html2pdf().set(opt).from(element).save();
        });
    });
</script>
@endsection
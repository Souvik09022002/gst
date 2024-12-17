<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vendorController extends Controller
{
    public function vendor(){
        return view('vendorInvoice.vendor_invoice');
    }
}

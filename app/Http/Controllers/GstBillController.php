<?php

namespace App\Http\Controllers;

use App\Models\GstBill;
use App\Models\Parties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class GstBillController extends Controller
{
    public function addBill()
    {       
       
        $existingClients = Parties::where('party_type','client')
                            ->select('Full_name')
                            ->distinct()
                            ->get();
        return view('gst-bill.add',['existingClients'=>$existingClients]);

    }
    public function get_client_address(Request $request) {
        $client = Parties::where('Full_name', $request->Full_name)->first();
        
        if ($client) {
            return response()->json(['address' => $client->Address]);
        } else {
            return response()->json(['address' => 'Address not found']);
        }
    }
    
        public function Bills_update(){
            
        }
    public function createGstBill(Request $request)
    {
        //dd($request->all());
        try {   

           
            // Loop through each set of data
            $slNos = $request->input('sl_no', []);
            $descriptions = $request->input('item_description', []);
            $hsnCodes = $request->input('hsn_code', []);
            $quantities = $request->input('quantity', []);
            $rates = $request->input('rate', []);
            $amounts = $request->input('amount', []);
    
            foreach ($slNos as $index => $slNo) {
                $gstBill = new GstBill();
                $gstBill->party_name = $request->input('party_name');
                $gstBill->Address = $request->input('Address');
                $gstBill->Order_no = $request->input('Order_no');
                $gstBill->invoice_date = $request->input('invoice_date');
                $gstBill->order_date = $request->input('order_date');
                $gstBill->invoice_number = $request->input('invoice_number');
    
                // Set individual data
                $gstBill->sl_no = $slNo;
                $gstBill->item_description = $descriptions[$index] ?? '';
                $gstBill->hsn_code = $hsnCodes[$index] ?? '';
                $gstBill->quantity = $quantities[$index] ?? '';
                $gstBill->rate = $rates[$index] ?? '';
                $gstBill->amount = $amounts[$index] ?? '';
    
                $gstBill->total_amount = $request->input('total_amount');
                $gstBill->cgst_rate = $request->input('cgst_rate');
                $gstBill->cgst_amount = $request->input('cgst_amount');
                $gstBill->sgst_rate = $request->input('sgst_rate');
                $gstBill->sgst_amount = $request->input('sgst_amount');
                $gstBill->igst_rate = $request->input('igst_rate');
                $gstBill->igst_amount = $request->input('igst_amount');
                $gstBill->tax_amount = $request->input('tax_amount');
                $gstBill->net_amount = $request->input('net_amount');
                $gstBill->declaration = $request->input('declaration');
    
                // Save the model to the database
                $gstBill->save();
            }
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Data inserted successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with error message
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function select_Bills_row(Request $request)
    {
        // Retrieve the number of rows to display, default to 10 if not provided
        $select_Bills_row = $request->input('select_Bills_row', 10);
        
        
        $Bills = GstBill::orderBy('order_date', 'desc')->limit($select_Bills_row)->get();
        
        
        return view('gst-bill.allBills', ['Bills' => $Bills]);
    }
    
    
    public function manageBills()
    {
        $BillDatas = new GstBill();
        //  $Bills = $BillDatas->orderBy('order_date', 'desc')
        //    ->get();
        
        $Bills = DB::select('SELECT * FROM `gst_bills` ORDER BY `gst_bills`.`created_at` DESC');
        return view('gst-bill.allBills',['Bills'=>$Bills]);
    }           

    public function search_Bills(Request $request)
    {
        $search_Bills = $request->input('search_Bills');
        
        // If search term is provided, filter the bills
        if ($search_Bills != '') {
            $Bills = GstBill::query()
                ->where('party_name', 'LIKE', "%{$search_Bills}%")
                ->orWhere('invoice_date', 'LIKE', "%{$search_Bills}%")
                ->orWhere('order_date', 'LIKE', "%{$search_Bills}%")
                ->orWhere('invoice_number', 'LIKE', "%{$search_Bills}%")
                ->orderBy('created_at','desc')
                ->get();
        } else {
            // If no search term is provided, return all bills
            $Bills = GstBill::all();
        }
    
        return view('gst-bill.allBills', ['Bills' => $Bills]);
    }
    

    public function printBill()
    {
        return view('gst-bill.print');
    }



    public function Edit_Bill(Request $request) {
        $Bill = GstBill::find($request->id);
        return view('gst-bill.Edit', ['Bill' => $Bill]);
    }

    public function update(Request $request)
    {
        try {
            // Get all inputs
            $slNos = $request->input('sl_no', []);
            $descriptions = $request->input('item_description', []);
            $hsnCodes = $request->input('hsn_code', []);
            $quantities = $request->input('quantity', []);
            $rates = $request->input('rate', []);
            $amounts = $request->input('amount', []);
    
            // Clean inputs
            $cleanedSlNos = array_map('trim', $slNos);
            $cleanedDescriptions = array_map('trim', $descriptions);
            $cleanedHsnCodes = array_map('trim', $hsnCodes);
            $cleanedQuantities = array_map('trim', $quantities);
            $cleanedRates = array_map('trim', $rates);
            $cleanedAmounts = array_map('trim', $amounts);
    
            // Process each item
            foreach ($cleanedSlNos as $index => $slNo) {
                $gstBill = new GstBill();
                $gstBill->party_name = $request->input('party_name');
                $gstBill->Address = $request->input('Address');
                $gstBill->Order_no = $request->input('Order_no');
                $gstBill->invoice_date = $request->input('invoice_date');
                $gstBill->order_date = $request->input('order_date');
                $gstBill->invoice_number = $request->input('invoice_number');
                //----------------------
                $gstBill->sl_no = $slNo;
                $gstBill->item_description = $cleanedDescriptions[$index] ?? '';
                $gstBill->hsn_code = $cleanedHsnCodes[$index] ?? '';
                $gstBill->quantity = $cleanedQuantities[$index] ?? '';
                $gstBill->rate = $cleanedRates[$index] ?? '';
                $gstBill->amount = $cleanedAmounts[$index] ?? '';
                //------------------------
                $gstBill->total_amount = $request->input('total_amount');
                $gstBill->cgst_rate = $request->input('cgst_rate');
                $gstBill->cgst_amount = $request->input('cgst_amount');
                $gstBill->sgst_rate = $request->input('sgst_rate');
                $gstBill->sgst_amount = $request->input('sgst_amount');
                $gstBill->igst_rate = $request->input('igst_rate');
                $gstBill->igst_amount = $request->input('igst_amount');
                $gstBill->tax_amount = $request->input('tax_amount');
                $gstBill->net_amount = $request->input('net_amount');
                $gstBill->declaration = $request->input('declaration');
    
                // Save the model to the database
                $gstBill->update(); // Use save() instead of update() since update() is used for existing models
            }
    
            // Redirect back with success message
            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with error message
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    
    public function Delete_Bill($id){
        $Bills = GstBill::find($id);
        if($Bills){
            $Bills->delete();
            return redirect()->back()->with('success', 'Bill Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error', 'Bill not found and delete UnsuccessFull!!');
        }
    }


    public function print_page(Request $request){
        $allDetailsById = GstBill::find($request->id);
        // if($allDetailsById){
        //     // Redirect to the named route with parameters
        //     return redirect()->route('print_page', ['id' => $request->id])
        //                      ->with('allDetailsById', $allDetailsById);
        // } else {
        //     return redirect()->back()->with('error', 'You cannot print this page!!');
        // }
        return view('gst-bill.print',['allDetailsById'=>$allDetailsById]);
    }
    
    
}

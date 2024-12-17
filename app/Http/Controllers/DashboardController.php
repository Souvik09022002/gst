<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\GstBill;
use Illuminate\Http\Request;
use App\Models\Parties; // Model import
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Existing client
        $partyData = DB::table('gst_bills')
            ->select('party_name', DB::raw('count(party_name) as party_count'))
            ->groupBy('party_name')
            ->get();
            
        $existingClient = Parties::where('party_type', 'client')->select('Full_name')->distinct()->get();
    
        // Fetch counts and sums from the database
        $partyCount = DB::select('SELECT COUNT(Full_name) as count FROM parties');
        $gstBillCount = DB::select('SELECT COUNT(id) as count FROM gst_bills');
        $totalTransaction = DB::select('SELECT SUM(net_amount) as total FROM gst_bills');
        $orderCount = DB::select('SELECT COUNT(Order_no) as count FROM gst_bills');
    
        // Extract the values from the results (assuming the first result)
        $partyCount = $partyCount[0]->count ?? 0;
        $gstBillCount = $gstBillCount[0]->count ?? 0;
        $totalTransaction = $totalTransaction[0]->total ?? 0;
        $orderCount = $orderCount[0]->count ?? 0;
    
        // Bar chart data
        $parties = Parties::all();
        $chatData = [];
        foreach ($parties as $party) {
            $partyCounts = GstBill::where('party_name', $party->Full_name)->count();
            $chatData[] = [
                'name' => $party->Full_name,
                'count' => $partyCounts
            ];
        }
        // Return the view with the extracted values
        return view('dashboard', [
            'partyCount' => $partyCount,
            'gstBillCount' => $gstBillCount,
            'totalTransaction' => $totalTransaction,
            'orderCount' => $orderCount,
            'existingClient' => $existingClient,
            'partyData' => $partyData,
            'chatData' => $chatData  // Pass chatData here
        ]);
    }
    public function dateTime_gstbill(Request $request) {
        $fromDate = $request->input('from_date_chart');
        $toDate = $request->input('to_date_chart');
        $parties = Parties::all();
    
        $chatData = [];
        foreach ($parties as $party) {
            $partyCountsvar = GstBill::where('party_name', $party->Full_name)
                ->whereBetween('order_date', [$fromDate, $toDate])  // Correct date filtering
                ->count();
            
            $chatData[] = [
                'name' => $party->Full_name,
                'count' => $partyCountsvar
            ];
        }
    
        return response()->json(['chatData' => $chatData]);
    }
    

    public function fiterDataText(Request $request){
        // First, ensure that you are receiving the data correctly.
        // dd($request->all()); // Uncomment this for testing if needed
        
        // Once confirmed, comment out the above line and use the actual logic:
        $selectAmmountBaseOnDate = DB::table('gst_bills')
            ->whereBetween('order_date', [$request->from_date, $request->to_date])
            ->sum('net_amount');
    
        return response()->json([
            'selectAmmountBaseOnDate' => $selectAmmountBaseOnDate
        ]);
    }
   

    public function getData(Request $request){
        // Query the net amount for the given party and date range
        $netAmount = DB::table('gst_bills')
            ->where('party_name', $request->client_name)
            ->whereBetween('order_date', [$request->from_date, $request->to_date])
            ->sum('net_amount');
    
        // Debugging step (remove in production)
        Log::info('Net Amount:', ['net_amount' => $netAmount]);
    
        // Return the response in JSON format
        return response()->json([
            'net_amount' => $netAmount
        ]);
    }   
}

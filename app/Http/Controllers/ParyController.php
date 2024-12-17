<?php

namespace App\Http\Controllers;

use App\Models\parties;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ParyController extends Controller
{
    public function addParty(){
        return view('party.addparty');
    }

    public function postParty(Request  $request){
       //echo "<pre>"; print_r($request->all());
       if($request){

        $validated = $request->validate([
            'party_type' => 'required|string',
            'Full_name' => 'required|string|max:255',
            'number' => 'required|string',
            'Address' => 'required|string|max:255',
            'Account_Holder_Name' =>'string|max:255',
            'Account_Number' => 'string',
            'Bank_Name' => 'string|max:255',
            'IFSC_Code' => 'string|max:11',
            'ZIP_Code' => 'string',
            'State' => 'string|max:255',
            'Branch' => 'string|max:255',
        ]);
        if($validated){
            $parties = new parties();
            $params = $request->all();
            unset($params['_token']);
            $parties->insert($params);
            return redirect()->back()->with('success','data added successfully');    
        }
        else{
            return redirect()->back()->with('error','invalid data did not valid');
        }
       }
       else{
        return redirect()->back()->with('error','request not work');
       }
    }

    public function manageParty(){
        $parties = parties::all();
        // echo "<pre>" ;print_r($parties);
        return view('party.manageparty', compact('parties')); 
    }

    public function search(Request $request){
      
        $search = $request->input('search');
       
           $parties = parties::query()
           ->where('party_type', 'LIKE', "%{$search}%")
           ->orWhere('Full_name', 'LIKE', "%{$search}%")
           ->orWhere('number', 'LIKE', "%{$search}%")
           ->orWhere('Address', 'LIKE', "%{$search}%")
           ->orWhere('Account_Holder_Name', 'LIKE', "%{$search}%")
           ->orWhere('Bank_Details', 'LIKE', "%{$search}%")
           ->orWhere('Account_Number', 'LIKE', "%{$search}%")
           ->orWhere('Bank_Name', 'LIKE', "%{$search}%")
           ->orWhere('IFSC_Code', 'LIKE', "%{$search}%")
           ->orWhere('ZIP_Code', 'LIKE', "%{$search}%")
           ->orWhere('State', 'LIKE', "%{$search}%")
           ->orWhere('Branch', 'LIKE', "%{$search}%")
           ->orWhere('created_at', 'LIKE', "%{$search}%")
           ->get();
          // dd($parties);
         return view('party.manageparty',['parties'=>$parties]);

         if($search == ""){
            $parties = parties::all();
            return view('party.manageparty', compact('parties'));
         }
        
    }

    public function update(Request $request)
{
    //dd($request->all());
    $party = parties::find($request->party_id);
    $upadate_party = $party->update($request->only([
        'party_type', 
        'Full_name', 
        'number', 
        'Address', 
        'Account_Holder_Name', 
        'Bank_Details', 
        'Account_Number', 
        'Bank_Name', 
        'IFSC_Code', 
        'ZIP_Code', 
        'State', 
        'Branch'
    ]));

   // dd($upadate_party);
    return redirect()->back()->with('success', 'Party updated successfully!');
}

public function delete($id){
    $party = parties::find($id);
    if($party){
        $party->delete();
        return redirect()->back()->with('error','party Deleted SuccessFully');
    }
    else{
        return redirect()->back()->with('error','party not found and delete UnsuccessFull!!');
    }
}

   
    

    
}

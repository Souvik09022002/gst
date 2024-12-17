<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Gst_bill;
use App\Http\Controllers\GstBillController;
use App\Http\Controllers\ParyController;
use App\Http\Controllers\printController;
use App\Http\Controllers\vendorController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/",[DashboardController::class,'dashboard'])->name('dashboard');
Route::post('/fiterDataText', [DashboardController::class, 'fiterDataText'])->name('fiterDataText');
Route::post('/filterData', [DashboardController::class, 'getData'])->name('filterData');
// web.php
Route::post('/dateTime_gstbill', [DashboardController::class, 'dateTime_gstbill'])->name('dateTime_gstbill');


Route::get('/login',function(){
    return view('login&Register.Login');
});
Route::get('/register',function(){
    return view('login&Register.Register');
});

//clent
Route::get('/add_party',[ParyController::class,'addParty'])->name('addParty');
Route::post('/post_party',[ParyController::class,'postParty'])->name('postParty');

Route::get('/manage_client',[ParyController::class,'manageParty'])->name('manageParty');
Route::get('/manage-client',[ParyController::class,'search'])->name('search');
Route::post('/manage-client', [ParyController::class, 'update'])->name('party_update');
Route::delete('/manage-client/{id}',[ParyController::class,'delete'])->name('party_delete');


// gst billing 
Route::get('/add_bill',[GstBillController::class,'addBill'])->name('addBill');
Route::post('/get_client_address', [GstBillController::class, 'get_client_address'])->name('get_client_address');
Route::post('/add_bill',[GstBillController::class,'createGstBill'])->name('createGstBill');
Route::get('/select_Bills_row', [GstBillController::class, 'select_Bills_row'])->name('select_Bills_row');
Route::get('/Edit_Bill/{id}',[GstBillController::class,'Edit_Bill'])->name('Edit_Bill');
Route::post('/update_Bill/{id}', [GstBillController::class, 'update'])->name('update_Bill');
Route::delete('/Delete_Bill/{id}',[GstBillController::class,'Delete_Bill'])->name('Delete_Bill');
Route::get('/print_page/{id}', [GstBillController::class, 'print_page'])->name('print_page');
// Route::post('/generate-pdf', [printController::class, 'generate_pdf'])->name('generate_pdf');

Route::get('/Manage-Bill',[GstBillController::class,'ManageBills'])->name('ManageBills');
Route::get('/print_bill',[GstBillController::class,'printBill'])->name('printBill');
Route::get('/search_Bills',[GstBillController::class,'search_Bills'])->name('search_Bills');
Route::post('/Bills_delete',[GstBillController::class,'Bills_delete'])->name('Bills_delete');
Route::post('/Bills_update',[GstBillController::class,'Bills_update'])->name('Bills_update');


//vendor
Route::get('/vendor_Invoice',[vendorController::class,'vendor'])->name('vendor');
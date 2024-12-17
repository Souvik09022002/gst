<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGstBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('gst_bills', function (Blueprint $table) {
        $table->id();
        $table->string('party_name');
        $table->date('invoice_date');
        $table->date('order_date')->nullable();
        $table->string('invoice_number');
        $table->text('sl_no');
        $table->text('item_description');
        $table->text('hsn_code');
        $table->text('quantity');
        $table->text('rate');
        $table->text('amount');
        $table->decimal('total_amount', 15, 2)->default(0);
        $table->decimal('cgst_rate', 5, 2)->default(0);
        $table->decimal('sgst_rate', 5, 2)->default(0);
        $table->decimal('igst_rate', 5, 2)->default(0);
        $table->decimal('cgst_amount', 15, 2)->default(0);
        $table->decimal('sgst_amount', 15, 2)->default(0);
        $table->decimal('igst_amount', 15, 2)->default(0);
        $table->decimal('tax_amount', 15, 2)->default(0);
        $table->decimal('net_amount', 15, 2)->default(0);
        $table->text('declaration')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gst_bills');
    }
}

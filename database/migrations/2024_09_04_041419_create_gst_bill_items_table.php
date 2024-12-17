<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGstBillItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gst_bill_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gst_bill_id')->constrained('gst_bills')->onDelete('cascade');
            $table->string('item_description');
            $table->string('hsn_code');
            $table->integer('quantity');
            $table->decimal('rate', 15, 2);
            $table->decimal('amount', 15, 2);
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
        Schema::dropIfExists('gst_bill_items');
    }
}

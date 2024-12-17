<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties',function(Blueprint $table){
            $table->id();
            $table->enum('party_type',['Client','vendor','Employee'])->nullable();
            $table->string('Full_name')->nullable();
            $table->string('number')->nullable();
            $table->string('Address')->nullable();
            $table->string('Account_Holder_Name')->nullable();
            $table->string('Bank_Details')->nullable();
            $table->string('Account_Number')->nullable();
            $table->string('Bank_Name')->nullable();
            $table->string('IFSC_Code')->nullable();
            $table->string('ZIP_Code')->nullable();
            $table->string('State')->nullable();
            $table->string('Branch')->nullable();
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
        //
    }
}

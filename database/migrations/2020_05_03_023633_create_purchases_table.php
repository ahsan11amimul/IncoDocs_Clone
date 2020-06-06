<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('purchase_number');
            $table->unsignedInteger('seller_id')->nullable();
            $table->unsignedInteger('buyer_id')->nullable();
            $table->string('key')->nullable();
            $table->date('date')->nullable();
            $table->string('buyer_reference')->nullable();
            $table->date('delivery_date')->nullable();
            $table->unsignedInteger('dispatch_id')->nullable();
            $table->string('shipment_type')->nullable();
            $table->unsignedInteger('loading_id')->nullable();
            $table->unsignedInteger('discharge_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('additional_info')->nullable();
            $table->decimal('total')->nullable()->default(0);
            $table->decimal('discount')->nullable()->default(0);
            $table->decimal('invoice_total')->nullable()->default(0);
            $table->string('bank_detail')->nullable();
            $table->string('place')->nullable();
            $table->date('action_date')->nullable();
            $table->string('signatory_company')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('signature')->nullable();
            $table->string('status')->default('Draft');
           
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
        Schema::dropIfExists('purchases');
    }
   
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('invoice_number')->unique();
            $table->string('key')->nullable();
            $table->unsignedInteger('seller_id')->nullable();
            $table->unsignedInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('consignee_id')->nullable();
            $table->date('date')->nullable();
            $table->string('reference')->nullable();
            $table->string('buyer_reference')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->unsignedInteger('dispatch_id')->nullable();
            $table->string('shipment_type')->nullable();
            $table->string('vessel')->nullable();
            $table->string('voyage_no')->nullable();
            $table->unsignedInteger('loading_id')->nullable();
            $table->unsignedInteger('discharge_id')->nullable();
            $table->string('destination')->nullable();
            $table->string('origin')->nullable();
            $table->string('final_destination')->nullable();
            $table->string('marine')->nullable();
            $table->string('credit')->nullable();

            $table->string('payment_method')->nullable();
            $table->string('additional_info')->nullable();
            $table->decimal('total')->nullable()->default(0);  
            $table->decimal('discount')->default(0)->nullable();
            $table->decimal('invoice_total')->default(0)->nullable();
            $table->string('bank_detail')->nullable();
            $table->string('place')->nullable();
            $table->string('action_date')->nullable();
            $table->string('signatory_company')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('signature')->nullable();
            $table->string('status')->default('Draft');
            $table->boolean('invoice_type')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}

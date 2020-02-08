<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agency_details')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('discount_type');
            $table->unsignedDecimal('price');
            $table->unsignedDecimal('quantity', 15, 2);
            $table->unsignedDecimal('discount', 15, 2)->nullable();
            $table->unsignedDecimal('discount_val');
            $table->unsignedDecimal('tax');
            $table->unsignedDecimal('total');
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
        Schema::dropIfExists('invoice_details');
    }
}

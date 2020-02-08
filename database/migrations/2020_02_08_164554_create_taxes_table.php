<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tax_type_id');
            $table->foreign('tax_type_id')->references('id')->on('tax_types');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->unsignedBigInteger('invoice_item_id')->nullable();
            $table->foreign('invoice_item_id')->references('id')->on('invoice_items')->onDelete('cascade');            
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agency_details');
            $table->string('name');
            $table->unsignedDecimal('amount');
            $table->decimal('percent', 5, 2);
            $table->tinyInteger('compound_tax')->default(0);
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
        Schema::dropIfExists('taxes');
    }
}

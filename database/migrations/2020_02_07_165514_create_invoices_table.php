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
            $table->unsignedBigInteger('invoice_template_id');
            // $table->foreign('invoice_template_id')->references('id')->on('invoice_templates');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id')->references('id')->on('agency_details');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('status');
            $table->string('paid_status');
            $table->unsignedDecimal('tax_per_item');
            $table->unsignedDecimal('discount_per_item');
            $table->text('notes')->nullable();
            $table->string('discount_type')->nullable();
            $table->unsignedDecimal('discount', 15, 2)->nullable();
            $table->unsignedDecimal('discount_val')->nullable();
            $table->unsignedDecimal('sub_total');
            $table->unsignedDecimal('total');
            $table->unsignedDecimal('tax');
            $table->unsignedDecimal('due_amount');
            $table->boolean('sent')->default(false);
            $table->boolean('viewed')->default(false);
            $table->string('unique_hash')->nullable();
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

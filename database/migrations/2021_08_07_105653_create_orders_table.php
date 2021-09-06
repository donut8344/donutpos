<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->double('total_price',10,2);
            $table->integer('tax',10)->default(0);
            $table->integer('vat',10)->default(0);
            $table->unsignedBigInteger('enterprise_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('consumers_id')->nullable();
            $table->unsignedBigInteger('payment_type_id');
            $table->unsignedBigInteger('promotion_id')->nullable();
            
            // $table->foreign('enterprise_id')->references('id')->on('enterprise');
            // $table->foreign('employee_id')->references('id')->on('employee');
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            // $table->foreign('promotion_id')->references('id')->on('promotions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

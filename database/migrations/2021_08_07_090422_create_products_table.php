<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id');
            $table->unsignedBigInteger('product_group_id');
            $table->string('code');
            $table->string('name');
            $table->text('description');
            $table->string('size');
            $table->double('price', 8, 2)->default(0);

            $table->foreign('product_group_id')->references('id')->on('product_groups')->onDelete('cascade');
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}

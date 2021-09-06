<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pm_masters_id');
            $table->unsignedBigInteger('enterprise_id');
            $table->string('code');
            $table->string('desc');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('pm_masters_id')->references('id')->on('promotion_masters')->onDelete('cascade');
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}

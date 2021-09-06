<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) {
            $table->id();
            $table->string('enterprise_code');
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->integer('vat',10)->default(0);
            $table->integer('tax',10)->default(0);
            $table->integer('product_code_length')->default(13)->comment('ความยาวของ bar code สินค้า');
            $table->unsignedBigInteger('create_by_user'); 
            $table->unsignedBigInteger('qty_emp_type_id')->default(1)->comment('ประเภทของจำนวนบุคลากร');
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
        Schema::dropIfExists('enterprise');
    }
}

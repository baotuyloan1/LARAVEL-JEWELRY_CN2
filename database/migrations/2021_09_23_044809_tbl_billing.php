<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_billing', function (Blueprint $table) {
            $table->Increments('billing_id');
            $table->string('billing_name');
            $table->integer('customer_id');
            $table->string('billing_address');
            $table->string('billing_phone');
            $table->string('billing_email');
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
        Schema::dropIfExists('tbl_billing');
    }
}

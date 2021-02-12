<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger("province_id")->index() ;
            // $table->unsignedBigInteger("city_id")->index() ;
            $table->text("address")->nullable();
            // $table->text("postal_code")->nullable();
            $table->string("phone")->nullable();
            // $table->string("national_code")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

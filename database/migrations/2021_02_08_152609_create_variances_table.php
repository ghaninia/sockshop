<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariancesTable extends Migration
{
    public function up()
    {
        Schema::create('variances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->string("title");
            $table->string("tooltip")->nullable();
            $table->float("price", 20, 2);
            $table->timestamps();

            $table->foreign("product_id")->on("products")->onDelete("cascade")->onUpdate("cascade") ;
        });
    }

    public function down()
    {
        Schema::dropIfExists('variances');
    }
}

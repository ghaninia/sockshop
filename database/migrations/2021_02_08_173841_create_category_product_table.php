<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductTable extends Migration
{

    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id") ;
            $table->unsignedBigInteger("product_id") ;

            // $table->foreign("category_id")->on("categories")->onDelete("cascade")->onUpdate("cascade") ;
            // $table->foreign("product_id")->on("products")->onDelete("cascade")->onUpdate("cascade") ;
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}

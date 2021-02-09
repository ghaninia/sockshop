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
            $table->unsignedBigInteger("address_id")->index()  ;
            $table->unsignedInteger("product_id")->index()  ;
            $table->unsignedBigInteger("variance_id")->index()  ;
             //* دریافت قیمت های واریانسی *//
            $table->string("fullname") ;
            $table->string("mobile") ;
            $table->float("price" , 10 , 2 ) ;

            $table->string("transaction_id")->nullable() ;
            $table->string("tracking_code")->nullable();

            $table->string("post_tracking_code")->nullable() ;
            $table->string("post_trackinged_at")->nullable() ;
            $table->timestamps();

            // $table->foreign("product_id")->on("products")->onDelete("cascade")->onUpdate("cadcade") ;
            // $table->foreign("variance_id")->on("variances")->onDelete("cascade")->onUpdate("cadcade") ;
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

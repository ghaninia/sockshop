<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("address_id") ;
            $table->unsignedBigInteger("user_id")->nullable() ;
            $table->enum( "status" ,  Order::STATUS_TYPES ) ;
            $table->integer("total") ;
            $table->float("price")->nullable() ;

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

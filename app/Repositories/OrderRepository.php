<?php
namespace App\Repositories ;

use App\Repositories\Repository;
use App\Models\Order;

class OrderRepository extends Repository
{

    public function model()
    {
        return Order::class;
    }
}

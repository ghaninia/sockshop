<?php

use App\Repositories\Repository;
use App\Models\Product;

class ProductRepository extends Repository
{

    public function model()
    {
        return Product::class;
    }
}

<?php
namespace App\Repositories ;

use App\Models\Variance;
use App\Repositories\Repository;

class VarianceRepository extends Repository
{
    public function model()
    {
        return Variance::class;
    }
}

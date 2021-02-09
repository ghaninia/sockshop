<?php
namespace App\Repositories ;

use App\Models\Admin;
use App\Repositories\Repository;

class AdminRepository extends Repository
{
    public function model()
    {
        return Admin::class;
    }
}

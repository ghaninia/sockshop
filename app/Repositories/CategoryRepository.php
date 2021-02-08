<?php

use App\Repositories\Repository;
use App\Models\Category;

class CategoryRepoistory extends Repository
{

    public function model()
    {
        return Category::class;
    }
}

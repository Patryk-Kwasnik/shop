<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
    protected $category;

    public function __construct() {
       
    }

    public function getAll()
    {
        return DB::table('products_categories')->get();
    }
}
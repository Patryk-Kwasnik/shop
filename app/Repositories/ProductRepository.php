<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product = null) {
         $this->product = $product ?? new Product();
    }

    public function getAll()
    {
        return DB::table('products')->get();
    }
}
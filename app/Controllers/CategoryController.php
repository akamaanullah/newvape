<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Collection;

class CategoryController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $collections = Collection::all();
        $this->render('front.category.index', [
            'page_title' => 'Shop All Vapes, E-Liquids & Disposables | New Vape',
            'page_js' => 'category',
            'products' => $products,
            'collections' => $collections
        ]);
    }
}

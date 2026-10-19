<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Collection;
use App\Models\Product;

class CollectionController extends Controller
{
    /**
     * Display all collections directory or primary collection
     */
    public function index()
    {
        $slug = $_GET['slug'] ?? ($_GET['cat'] ?? ($_GET['collection'] ?? ($_GET['c'] ?? null)));
        return $this->show($slug);
    }

    /**
     * Display a specific collection detail page with products and interactive filters
     */
    public function show($slug = null)
    {
        $slug = $slug ?? ($_GET['slug'] ?? ($_GET['cat'] ?? ($_GET['collection'] ?? ($_GET['c'] ?? 'disposables'))));
        $slug = trim(strtolower($slug));

        // Handle 'all' or 'shop'
        $isAll = ($slug === 'all' || $slug === 'shop' || empty($slug));
        $collection = null;

        if (!$isAll) {
            $collection = Collection::findBySlug($slug);
            if (!$collection && is_numeric($slug)) {
                $collection = Collection::find($slug);
            }
        }

        if (!$collection && !$isAll) {
            // Default fallback to first active or disposables
            $collection = Collection::findBySlug('disposables');
        }

        if (!$collection) {
            $collection = [
                'id' => 0,
                'name' => 'Shop All Vapes',
                'slug' => 'all',
                'short_description' => 'Explore our full selection of disposable vapes, premium e-liquids, nicotine pouches, and hardware devices from verified authentic brands.',
                'meta_title' => 'Shop All Vapes, E-Liquids & Disposables | New Vape',
                'meta_desc' => 'Browse our complete catalog of authentic disposable vapes, e-juices, nicotine pouches, and starter kits with fast same-day shipping.'
            ];
        }

        // Get all active collections for the Shop By filter sidebar
        $allCollections = Collection::all();

        // Target slug for product querying
        $filterSlug = ($collection['slug'] === 'all') ? null : $collection['slug'];

        // Extract active filters from GET request
        $activeBrand = $_GET['b'] ?? ($_GET['brand'] ?? null);
        $minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
        $maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;
        $inStock = !empty($_GET['in_stock']) ? 1 : 0;
        $sort = $_GET['sort'] ?? 'position';
        $search = $_GET['q'] ?? null;
        $quickPill = $_GET['pill'] ?? ($_GET['filter'] ?? 'all');

        $filters = [
            'brand'     => $activeBrand,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'in_stock'  => $inStock,
            'sort'      => $sort,
            'q'         => $search
        ];

        // Fetch filtered products
        $products = Product::getCollectionProducts($filterSlug, $filters);

        // Fetch brands present in this collection with product counts
        $brands = Product::getBrandsForCollection($filterSlug);

        // Fetch min & max price bounds for the dual range slider
        $priceBounds = Product::getPriceBounds($filterSlug);

        // Sub-collections / child categories for quick pills if available
        $childCollections = [];
        if (!empty($collection['id'])) {
            $childCollections = array_filter($allCollections, function($c) use ($collection) {
                return !empty($c['parent_id']) && (int)$c['parent_id'] === (int)$collection['id'];
            });
        }

        // SEO Page Title & Description
        $pageTitle = !empty($collection['meta_title']) 
            ? $collection['meta_title'] 
            : ($collection['name'] . ' - Shop All Top Brands & Puffs | New Vape');

        $this->render('front.collection.detail', [
            'page_title'       => $pageTitle,
            'page_js'          => 'category',
            'collection'       => $collection,
            'allCollections'   => $allCollections,
            'childCollections' => $childCollections,
            'brands'           => $brands,
            'products'         => $products,
            'totalCount'       => count($products),
            'priceBounds'      => $priceBounds,
            'activeFilters'    => $filters,
            'currentSlug'      => $collection['slug'] ?? 'disposables',
            'currentSort'      => $sort,
            'quickPill'        => $quickPill
        ]);
    }
}

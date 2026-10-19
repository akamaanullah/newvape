<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $id = $_GET['id'] ?? 1;
        $product = Product::find($id);
        $relatedProducts = Product::all();

        // Dynamic Product Specifications, Highlights & Content
        $productHighlights = Product::getHighlights($id);
        $productSpecs = Product::getSpecifications($id);
        $productVariants = Product::getVariants($id);
        $productFaqs = Product::getFaqs($id);
        $productReviews = Product::getReviews($id);
        $relatedPosts = Product::getRelatedPosts($id);
        $productImages = Product::getImages($id);

        $this->render('front.product.index', [
            'page_title' => ($product['title'] ?? 'Lost Mary MT35000 Turbo Vape') . ' | New Vape',
            'page_js' => 'product',
            'product' => $product,
            'productImages' => $productImages,
            'relatedProducts' => $relatedProducts,
            'productHighlights' => $productHighlights,
            'productSpecs' => $productSpecs,
            'productVariants' => $productVariants,
            'productFaqs' => $productFaqs,
            'productReviews' => $productReviews,
            'relatedPosts' => $relatedPosts
        ]);
    }
}

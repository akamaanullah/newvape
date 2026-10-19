<?php
namespace App\Controllers;

use App\Core\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $this->render('front.blog.index', [
            'page_title' => 'New Vape Blog | Vaping Guides, Reviews & Industry News',
            'page_js' => 'blog'
        ]);
    }

    public function detail()
    {
        $this->render('front.blog.detail', [
            'page_title' => 'How to Choose Your First Vape: A Beginner Guide | New Vape',
            'page_js' => 'blog'
        ]);
    }
}

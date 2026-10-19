<?php
namespace App\Controllers;

use App\Core\Controller;

class TagController extends Controller
{
    public function index()
    {
        $this->render('front.tag.index', [
            'page_title' => 'Tag Archive | New Vape',
            'page_js' => 'blog'
        ]);
    }
}

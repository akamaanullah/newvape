<?php
namespace App\Controllers;

use App\Core\Controller;

class CategoryController extends Controller
{
    /**
     * Category route index - delegate to CollectionController show
     */
    public function index()
    {
        $collectionController = new CollectionController();
        $slug = $_GET['cat'] ?? ($_GET['slug'] ?? ($_GET['collection'] ?? ($_GET['c'] ?? 'disposables')));
        return $collectionController->show($slug);
    }
}

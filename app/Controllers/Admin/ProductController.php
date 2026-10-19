<?php
namespace App\Controllers\Admin;

use App\Models\Product;
use App\Models\Collection;
use App\Models\Brand;

class ProductController extends AdminController
{
    /**
     * Display all products in catalog
     */
    public function index()
    {
        $products = Product::all();

        $this->render('admin.products.index', [
            'page_title' => 'Products Management',
            'current_admin_page' => 'products',
            'page_script' => 'products.js',
            'products' => $products,
            'success' => get_flash('success'),
            'error' => get_flash('error')
        ]);
    }

    /**
     * Show create product form or process POST creation
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            if (empty($title)) {
                set_flash('error', 'Product title is required.');
                $this->redirect('admin/add-product');
            }

            // Multiple Images Upload Handling
            $uploadedImages = [];
            $targetDir = ROOT_PATH . '/public/assets/images/products/';
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }

            if (!empty($_FILES['product_images']['name'])) {
                $names = (array)$_FILES['product_images']['name'];
                $tmpNames = (array)$_FILES['product_images']['tmp_name'];
                $errors = (array)$_FILES['product_images']['error'];

                foreach ($names as $i => $origName) {
                    if (!empty($origName) && isset($errors[$i]) && $errors[$i] === UPLOAD_ERR_OK && !empty($tmpNames[$i])) {
                        $ext = pathinfo($origName, PATHINFO_EXTENSION);
                        $cleanExt = strtolower($ext ?: 'webp');
                        $fileName = 'prod_' . time() . '_' . bin2hex(random_bytes(4)) . '_' . ($i + 1) . '.' . $cleanExt;
                        if (@move_uploaded_file($tmpNames[$i], $targetDir . $fileName)) {
                            $uploadedImages[] = 'assets/images/products/' . $fileName;
                        }
                    }
                }
            }

            // Single image fallback
            if (empty($uploadedImages) && !empty($_FILES['product_image']['name']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['product_image']['tmp_name'];
                $ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
                $cleanExt = strtolower($ext ?: 'webp');
                $fileName = 'prod_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $cleanExt;
                if (@move_uploaded_file($fileTmp, $targetDir . $fileName)) {
                    $uploadedImages[] = 'assets/images/products/' . $fileName;
                }
            }

            $featuredIndex = isset($_POST['featured_image_index']) ? (int)$_POST['featured_image_index'] : 0;
            $featuredImage = !empty($uploadedImages[$featuredIndex]) ? $uploadedImages[$featuredIndex] : (!empty($uploadedImages[0]) ? $uploadedImages[0] : (!empty($_POST['image']) ? trim($_POST['image']) : 'assets/images/vape-image.webp'));

            // Re-order so featured image is at the top of product_images
            $orderedImages = [];
            if (!empty($uploadedImages)) {
                if (isset($uploadedImages[$featuredIndex])) {
                    $orderedImages[] = $uploadedImages[$featuredIndex];
                }
                foreach ($uploadedImages as $k => $uImg) {
                    if ($k !== $featuredIndex) {
                        $orderedImages[] = $uImg;
                    }
                }
            }

            // Variants parsing
            $variants = [];
            if (!empty($_POST['has_variants']) && !empty($_POST['variants']) && is_array($_POST['variants'])) {
                foreach ($_POST['variants'] as $v) {
                    if (!empty($v['name'])) {
                        $variants[] = [
                            'name' => trim($v['name']),
                            'sku' => trim($v['sku'] ?? ''),
                            'price' => trim($v['price'] ?? $_POST['price'] ?? '0.00'),
                            'stock' => trim($v['stock'] ?? $_POST['stock'] ?? '10')
                        ];
                    }
                }
            }

            $data = [
                'title' => $title,
                'name' => $title,
                'sku' => trim($_POST['sku'] ?? ''),
                'slug' => trim($_POST['slug'] ?? ''),
                'brand' => trim($_POST['brand'] ?? ''),
                'collection' => trim($_POST['collection'] ?? ''),
                'price' => trim($_POST['price'] ?? '0.00'),
                'compare_price' => trim($_POST['compare_price'] ?? ''),
                'stock' => trim($_POST['stock'] ?? $_POST['stock_quantity'] ?? '0'),
                'status' => trim($_POST['status'] ?? 'published'),
                'description' => trim($_POST['description'] ?? ''),
                'short_desc' => trim($_POST['short_desc'] ?? ''),
                'tags' => trim($_POST['tags'] ?? ''),
                'featured_image' => $featuredImage,
                'images' => !empty($orderedImages) ? $orderedImages : $uploadedImages,
                'variants' => $variants,
                'seo_title' => trim($_POST['seo_title'] ?? ''),
                'seo_description' => trim($_POST['seo_description'] ?? '')
            ];

            $newId = Product::create($data);

            if ($newId) {
                set_flash('success', "Product '{$title}' created successfully.");
                $this->redirect('admin/products');
            } else {
                set_flash('error', 'Failed to create product. Please try again.');
                $this->redirect('admin/add-product');
            }
        }

        $collections = Collection::all();
        $brands = Brand::all();

        $this->render('admin.products.add', [
            'page_title' => 'Add New Product',
            'current_admin_page' => 'products',
            'page_script' => 'add-product.js',
            'collections' => $collections,
            'brands' => $brands,
            'error' => get_flash('error'),
            'success' => get_flash('success')
        ]);
    }

    /**
     * Show edit product form or process POST update
     */
    public function edit()
    {
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1;
        $product = Product::find($id);

        if (!$product) {
            set_flash('error', 'Product not found.');
            $this->redirect('admin/products');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            if (empty($title)) {
                set_flash('error', 'Product title cannot be empty.');
                $this->redirect("admin/edit-product?id={$id}");
            }

            // Multiple Images Upload Handling
            $uploadedImages = [];
            $targetDir = ROOT_PATH . '/public/assets/images/products/';
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0777, true);
            }

            if (!empty($_FILES['product_images']['name'])) {
                $names = (array)$_FILES['product_images']['name'];
                $tmpNames = (array)$_FILES['product_images']['tmp_name'];
                $errors = (array)$_FILES['product_images']['error'];

                foreach ($names as $i => $origName) {
                    if (!empty($origName) && isset($errors[$i]) && $errors[$i] === UPLOAD_ERR_OK && !empty($tmpNames[$i])) {
                        $ext = pathinfo($origName, PATHINFO_EXTENSION);
                        $cleanExt = strtolower($ext ?: 'webp');
                        $fileName = 'prod_' . time() . '_' . bin2hex(random_bytes(4)) . '_' . ($i + 1) . '.' . $cleanExt;
                        if (@move_uploaded_file($tmpNames[$i], $targetDir . $fileName)) {
                            $uploadedImages[] = 'assets/images/products/' . $fileName;
                        }
                    }
                }
            }

            // Single image fallback
            if (empty($uploadedImages) && !empty($_FILES['product_image']['name']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['product_image']['tmp_name'];
                $ext = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
                $cleanExt = strtolower($ext ?: 'webp');
                $fileName = 'prod_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $cleanExt;
                if (@move_uploaded_file($fileTmp, $targetDir . $fileName)) {
                    $uploadedImages[] = 'assets/images/products/' . $fileName;
                }
            }

            $featuredIndex = isset($_POST['featured_image_index']) ? (int)$_POST['featured_image_index'] : 0;
            $featuredImage = !empty($uploadedImages[$featuredIndex]) ? $uploadedImages[$featuredIndex] : (!empty($uploadedImages[0]) ? $uploadedImages[0] : (isset($_POST['image']) ? trim($_POST['image']) : $product['featured_image']));

            $orderedImages = [];
            if (!empty($uploadedImages)) {
                if (isset($uploadedImages[$featuredIndex])) {
                    $orderedImages[] = $uploadedImages[$featuredIndex];
                }
                foreach ($uploadedImages as $k => $uImg) {
                    if ($k !== $featuredIndex) {
                        $orderedImages[] = $uImg;
                    }
                }
            }

            // Variants parsing
            $variants = null;
            if (isset($_POST['has_variants'])) {
                $variants = [];
                if (!empty($_POST['variants']) && is_array($_POST['variants'])) {
                    foreach ($_POST['variants'] as $v) {
                        if (!empty($v['name'])) {
                            $variants[] = [
                                'name' => trim($v['name']),
                                'sku' => trim($v['sku'] ?? ''),
                                'price' => trim($v['price'] ?? $_POST['price'] ?? $product['base_price']),
                                'stock' => trim($v['stock'] ?? $_POST['stock'] ?? $product['stock_quantity'])
                            ];
                        }
                    }
                }
            }

            $data = [
                'title' => $title,
                'name' => $title,
                'sku' => trim($_POST['sku'] ?? $product['sku']),
                'slug' => trim($_POST['slug'] ?? $product['slug']),
                'brand' => trim($_POST['brand'] ?? $product['brand']),
                'collection' => trim($_POST['collection'] ?? $product['category']),
                'price' => trim($_POST['price'] ?? $product['base_price']),
                'compare_price' => trim($_POST['compare_price'] ?? $product['compare_price']),
                'stock' => trim($_POST['stock'] ?? $_POST['stock_quantity'] ?? $product['stock_quantity']),
                'status' => trim($_POST['status'] ?? $product['status']),
                'description' => trim($_POST['description'] ?? $product['long_desc']),
                'short_desc' => trim($_POST['short_desc'] ?? $product['short_desc']),
                'tags' => trim($_POST['tags'] ?? $product['tags']),
                'featured_image' => $featuredImage,
                'seo_title' => trim($_POST['seo_title'] ?? $product['seo_title']),
                'seo_description' => trim($_POST['seo_description'] ?? $product['seo_description'])
            ];

            if (!empty($orderedImages)) {
                $data['images'] = $orderedImages;
            } elseif (!empty($uploadedImages)) {
                $data['images'] = $uploadedImages;
            }
            if ($variants !== null) {
                $data['variants'] = $variants;
            }

            $updated = Product::update($id, $data);

            if ($updated) {
                set_flash('success', "Product '{$title}' updated successfully.");
                $this->redirect('admin/products');
            } else {
                set_flash('error', 'Failed to update product.');
                $this->redirect("admin/edit-product?id={$id}");
            }
        }

        $collections = Collection::all();
        $brands = Brand::all();
        $images = Product::getImages($id);
        $variants = Product::getVariants($id);

        $this->render('admin.products.edit', [
            'page_title' => 'Edit Product: ' . $product['title'],
            'current_admin_page' => 'products',
            'page_script' => 'edit-product.js',
            'product' => $product,
            'images' => $images,
            'variants' => $variants,
            'collections' => $collections,
            'brands' => $brands,
            'error' => get_flash('error'),
            'success' => get_flash('success')
        ]);
    }

    /**
     * Delete product
     */
    public function delete()
    {
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
        if ($id > 0) {
            $product = Product::find($id);
            $title = $product['title'] ?? 'Product #' . $id;
            Product::delete($id);
            set_flash('success', "Product '{$title}' was deleted successfully.");
        }
        $this->redirect('admin/products');
    }
}

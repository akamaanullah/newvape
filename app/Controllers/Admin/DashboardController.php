<?php
namespace App\Controllers\Admin;

use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class DashboardController extends AdminController
{
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        $customers = Customer::all();

        $this->render('admin.dashboard.index', [
            'page_title' => 'Dashboard',
            'current_admin_page' => 'dashboard',
            'page_script' => 'dashboard.js',
            'products' => $products,
            'orders' => $orders,
            'customers' => $customers
        ]);
    }
}

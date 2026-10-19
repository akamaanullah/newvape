<?php
namespace App\Controllers\Admin;

use App\Models\Order;

class OrderController extends AdminController
{
    public function index()
    {
        $orders = Order::all();
        $this->render('admin.orders.index', [
            'page_title' => 'Orders',
            'current_admin_page' => 'orders',
            'page_script' => 'orders.js',
            'orders' => $orders
        ]);
    }

    public function detail()
    {
        $id = $_GET['id'] ?? '104820';
        $order = Order::find($id);

        $this->render('admin.orders.detail', [
            'page_title' => 'Order #' . $id,
            'current_admin_page' => 'orders',
            'page_script' => 'order-detail.js',
            'order' => $order
        ]);
    }
}
